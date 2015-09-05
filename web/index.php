<?php
require_once __DIR__ . '/../vendor/autoload.php';

$query = new \NamelessCoder\NumerologLavacharts\ChartQuery($_GET);
$chart = new \NamelessCoder\NumerologLavacharts\NumerologChart();
echo $chart->renderGraphQuery($query);
