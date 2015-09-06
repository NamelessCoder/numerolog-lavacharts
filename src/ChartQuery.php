<?php
namespace NamelessCoder\NumerologLavacharts;

use Khill\Lavacharts\Configs\HorizontalAxis;
use Khill\Lavacharts\Configs\VerticalAxis;
use NamelessCoder\Numerolog\Query;

/**
 * Class ChartQuery
 */
class ChartQuery extends Query {

	/**
	 * @var integer
	 */
	protected $chartWidth = 480;

	/**
	 * @var integer
	 */
	protected $chartHeight = 270;

	/**
	 * @var string
	 */
	protected $chartId = 'chart';

	/**
	 * @var string
	 */
	protected $chartLabel = 'Numerolog counter';

	/**
	 * @var string
	 */
	protected $chartTimeLabel = 'Time';

	/**
	 * @var string
	 */
	protected $chartValueLabel = 'Value';

	/**
	 * @var string
	 */
	protected $chartType = 'LineChart';

	/**
	 * @var string
	 */
	protected $chartDateTimeFormat = 'Y-n-j H:i:s';

	/**
	 * @var integer
	 */
	protected $count = 20;

	/**
	 * @var boolean
	 */
	protected $scriptOnly = FALSE;

	/**
	 * @var array
	 */
	protected $chartAttributes = array();

	/**
	 * @return integer
	 */
	public function getChartWidth() {
		return $this->chartWidth;
	}

	/**
	 * @param integer $chartWidth
	 * @return void
	 */
	public function setChartWidth($chartWidth) {
		$this->chartWidth = $chartWidth;
	}

	/**
	 * @return integer
	 */
	public function getChartHeight() {
		return $this->chartHeight;
	}

	/**
	 * @param integer $chartHeight
	 * @return void
	 */
	public function setChartHeight($chartHeight) {
		$this->chartHeight = $chartHeight;
	}

	/**
	 * @return string
	 */
	public function getChartId() {
		return $this->chartId;
	}

	/**
	 * @param string $chartId
	 * @return void
	 */
	public function setChartId($chartId) {
		$this->chartId = $chartId;
	}

	/**
	 * @return string
	 */
	public function getChartLabel() {
		return $this->chartLabel;
	}

	/**
	 * @param string $chartLabel
	 * @return void
	 */
	public function setChartLabel($chartLabel) {
		$this->chartLabel = $chartLabel;
	}

	/**
	 * @return string
	 */
	public function getChartTimeLabel() {
		return $this->chartTimeLabel;
	}

	/**
	 * @param string $chartTimeLabel
	 * @return void
	 */
	public function setChartTimeLabel($chartTimeLabel) {
		$this->chartTimeLabel = $chartTimeLabel;
	}

	/**
	 * @return string
	 */
	public function getChartValueLabel() {
		return $this->chartValueLabel;
	}

	/**
	 * @param string $chartValueLabel
	 * @return void
	 */
	public function setChartValueLabel($chartValueLabel) {
		$this->chartValueLabel = $chartValueLabel;
	}

	/**
	 * @return string
	 */
	public function getChartType() {
		return $this->chartType;
	}

	/**
	 * @param string $chartType
	 * @return void
	 */
	public function setChartType($chartType) {
		$this->chartType = $chartType;
	}

	/**
	 * @return string
	 */
	public function getChartDateTimeFormat() {
		return $this->chartDateTimeFormat;
	}

	/**
	 * @param string $chartDateTimeFormat
	 * @return void
	 */
	public function setChartDateTimeFormat($chartDateTimeFormat) {
		$this->chartDateTimeFormat = $chartDateTimeFormat;
	}

	/**
	 * @return boolean
	 */
	public function getScriptOnly() {
		return $this->scriptOnly;
	}

	/**
	 * @param boolean $scriptOnly
	 * @return void
	 */
	public function setScriptOnly($scriptOnly) {
		$this->scriptOnly = $scriptOnly;
	}

	/**
	 * @return array
	 */
	public function getChartAttributes() {
		$attributes = $this->chartAttributes;
		if (isset($attributes['hAxis'])) {
			$attributes['hAxis'] = new HorizontalAxis($attributes['hAxis']);
		}
		if (isset($attributes['vAxis'])) {
			$attributes['vAxis'] = new VerticalAxis($attributes['vAxis']);
		}
		foreach ($attributes as $name => $value) {
			if (is_scalar($value)) {
				if (preg_match('/^[0-9]+$/', (string) $value)) {
					$attributes[$name] = (integer) $value;
				} elseif (preg_match('/[0-9]+\.[0-9]+/', (string) $value)) {
					$attributes[$name] = (float) $value;
				}
			}
		}
		return (array) $attributes;
	}

	/**
	 * @param array $chartAttributes
	 * @return void
	 */
	public function setChartAttributes(array $chartAttributes) {
		$this->chartAttributes = $chartAttributes;
	}

}
