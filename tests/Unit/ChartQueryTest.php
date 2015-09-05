<?php
namespace NamelessCoder\NumerologLavacharts\Tests\Unit;

use NamelessCoder\NumerologLavacharts\ChartQuery;

/**
 * Class ChartQueryTest
 */
class ChartQueryTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @param string $propertyName
	 * @param mixed $value
	 * @param mixed $expected
	 * @dataProvider getGetterAndSetterTestValues
	 */
	public function testStandardGetter($propertyName, $value, $expected = NULL) {
		if (!$expected) {
			$expected = $value;
		}
		$query = new ChartQuery();
		$property = new \ReflectionProperty($query, $propertyName);
		$property->setAccessible(TRUE);
		$property->setValue($query, $value);
		$getter = 'get' . ucfirst($propertyName);
		$this->assertEquals($expected, $query->$getter());
	}

	/**
	 * @param string $propertyName
	 * @param mixed $value
	 * @param mixed $expected
	 * @dataProvider getGetterAndSetterTestValues
	 */
	public function testStandardSetter($propertyName, $value, $expected = NULL) {
		$query = new ChartQuery();
		$setter = 'set' . ucfirst($propertyName);
		$query->$setter($value);
		$this->assertAttributeEquals($value, $propertyName, $query);
	}

	/**
	 * @return array
	 */
	public function getGetterAndSetterTestValues() {
		return array(
			'chartWidth' => array('chartWidth', 123),
			'chartHeight' => array('chartHeight', 321),
			'chartId' => array('chartId', 'foobar-chartId'),
			'chartLabel' => array('chartLabel', 'foobar-chartLabel'),
			'chartTimeLabel' => array('chartTimeLabel', 'foobar-chartTimeLabel'),
			'chartValueLabel' => array('chartValueLabel', 'foobar-chartValueLabel'),
			'chartType' => array('chartType', 'foobar-chartType'),
			'chartDateTimeFormat' => array('chartDateTimeFormat', 'foobar-chartDateTimeFormat'),
			'chartAttributes' => array('chartAttributes', array('title' => 1, 'duration' => 1.5))
		);
	}

	/**
	 * @param array $parameters
	 * @param array $expected
	 * @dataProvider getConstrutorParameterTestValues
	 */
	public function testConstructorParameters(array $parameters, array $expected) {
		$query = new ChartQuery($parameters);
		foreach ($expected as $name => $value) {
			$this->assertAttributeEquals($value, $name, $query);
		}
	}

	/**
	 * @return array
	 */
	public function getConstrutorParameterTestValues() {
		return array(
			'associative' => array(
				array(
					'chartWidth' => 123,
					'chartHeight' => 321
				),
				array(
					'chartWidth' => 123,
					'chartHeight' => 321
				)
			),
			'named' => array(
				array(
					'--chartWidth', 123,
					'--chartHeight', 321
				),
				array(
					'chartWidth' => 123,
					'chartHeight' => 321
				)
			)
		);
	}

	/**
	 * @param $attributeName
	 * @param $attributeValue
	 * @param $expectedClass
	 * @dataProvider getChartAttributesConversionTestValues
	 */
	public function testGetChartAttributesConvertsToExpectedObjects($attributeName, $attributeValue, $expectedClass) {
		$query = new ChartQuery();
		$query->setChartAttributes(array(
			$attributeName => $attributeValue
		));
		$converted = $query->getChartAttributes();
		$this->assertInstanceOf($expectedClass, $converted[$attributeName]);
	}

	/**
	 * @return array
	 */
	public function getChartAttributesConversionTestValues() {
		return array(
			array('hAxis', array('title' => 'test'), '\\Khill\\Lavacharts\\Configs\\HorizontalAxis'),
			array('vAxis', array('title' => 'test'), '\\Khill\\Lavacharts\\Configs\\VerticalAxis')
		);
	}

}
