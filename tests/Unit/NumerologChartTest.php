<?php
namespace NamelessCoder\NumerologLavacharts\Tests\Unit;

use NamelessCoder\NumerologLavacharts\NumerologChart;
use NamelessCoder\Numerolog\Client;

/**
 * Class NumerologChartTest
 */
class NumerologChartTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @test
	 */
	public function testGetNumerologClientReturnsClientInstance() {
		$subject = new NumerologChart();
		$method = new \ReflectionMethod($subject, 'getNumerologClient');
		$method->setAccessible(TRUE);
		$client = $method->invoke($subject);
		$this->assertInstanceOf(Client::class, $client);
	}

}
