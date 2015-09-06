<?php
namespace NamelessCoder\NumerologLavacharts;

use Khill\Lavacharts\Configs\DataTable;
use Khill\Lavacharts\Formats\Format;
use Khill\Lavacharts\Lavacharts;
use NamelessCoder\Numerolog\Client;
use NamelessCoder\Numerolog\Query;

/**
 * Class Chart
 */
class NumerologChart extends Lavacharts {

	/**
	 * @param ChartQuery $query
	 * @return string
	 */
	public function renderChartQuery(ChartQuery $query) {
		if (Query::ACTION_GET !== $query->getAction()) {
			throw new \RuntimeException('NumerologChart only accepts the Numerolog `get` command');
		}
		$client = new Client();
		$response = $client->query($query);
		$chartType = $query->getChartType();
		$chartLabel = $query->getChartLabel();
		$chartTitle = $chartLabel . ':' . $query->getCounter();
		$chartAttributes = $query->getChartAttributes();

		$table = $this->fillWithResponseData($response['values'], $query);
		$chart = $this->$chartType($chartLabel)
			->title($chartTitle);
		if (!empty($chartAttributes)) {
			$chart->setOptions($chartAttributes);
		}
		$chart->datatable($table);
		if ($query->getScriptOnly()) {
			return $this->render($chartType, $chartLabel, $query->getChartId());
		}
		return $this->render($chartType, $chartLabel, $query->getChartId(), array(
			'width' => $query->getChartWidth(),
			'height' => $query->getChartHeight()
		));
	}

	/**
	 * @param array $data
	 * @param GraphQuery $query
	 * @return DataTable
	 */
	protected function fillWithResponseData(array $data, ChartQuery $query) {
		$dateTimeFormat = $query->getChartDatetimeFormat();
		$table = $this->DataTable();
		$table->setTimeZone(date_default_timezone_get());
		$table->setDateTimeFormat($dateTimeFormat);
		$table->addDateColumn($query->getChartTimeLabel());
		$table->addNumberColumn($query->getChartValueLabel());
		foreach ($data as $coordinates) {
			$table->addRow(array(
				date($dateTimeFormat, $coordinates['time']),
				$coordinates['value']
			));
		}
		return $table;
	}

}
