<?php
require_once __DIR__ . '/../vendor/autoload.php';

$query = new \NamelessCoder\NumerologLavacharts\ChartQuery($_GET);
$query->setAction(\NamelessCoder\Numerolog\Query::ACTION_GET);
$chart = new \NamelessCoder\NumerologLavacharts\NumerologChart();
$chartQueries = array();

if ($query->getCounter()) {
	$chartQueries[] = $query;
} else {
	$countersQuery = clone $query;
	$countersQuery->setAction(\NamelessCoder\Numerolog\Query::ACTION_COUNTERS);
	$client = new \NamelessCoder\Numerolog\Client();
	$client->setPackage($query->getPackage());
	$client->setToken($query->getToken());
	$counters = $client->query($countersQuery);
	foreach (array_keys($counters['values']) as $index => $counterName) {
		$counterNumber = $index + 1;
		$query = clone $query;
		$query->setCounter($counterName);
		$query->setChartId('chart-' . $counterNumber);
		$chartQueries[] = $query;
	}
}

foreach ($chartQueries as $query) {
	if (!$query->getScriptOnly()) {
		echo $chart->renderChartQuery($query);
		$query->setScriptOnly(TRUE);
	} else {
		echo sprintf(
			'<div id="chart-%s" style="width:%dpx; height:%dpx;"></div>',
			$counterNumber,
			$query->getChartWidth(),
			$query->getChartHeight()
		);
	}
}
