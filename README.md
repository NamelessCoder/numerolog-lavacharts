Numero-log: Lavacharts
======================

[![Build Status](https://img.shields.io/travis/NamelessCoder/numerolog-lavacharts.svg?style=flat-square&label=package)](https://travis-ci.org/NamelessCoder/numerolog-lavacharts) [![Coverage Status](https://img.shields.io/coveralls/NamelessCoder/numerolog-lavacharts/master.svg?style=flat-square)](https://coveralls.io/r/NamelessCoder/numerolog-lavacharts)

Thin client to access Numerolog counters and render then as graphs using the Lavacharts
library (https://github.com/kevinkhill/lavacharts) which in turn uses Google's powerful
Charts package (https://developers.google.com/chart/interactive/docs). The client pulls
values from a Numerolog package using a token, then renders the data sets as a nice
chart. All graph types and options of Google Charts are supported.

Being Javascript based, this charting package is obviously limited to browser-based use.

Installation
------------

Use composer:

```bash
composer require namelesscoder/numerolog-lavacharts
```

Usage
-----

Then either integrate from anywhere by calling methods manually with an array as input:

```php
$query = new \NamelessCoder\NumerologLavacharts\ChartQuery($_GET);
$chart = new \NamelessCoder\NumerologLavacharts\NumerologChart();
echo $chart->renderChartQuery($query);
```

Alternatively, do the same but configure the ChartQuery manually:

```php
$query = new \NamelessCoder\NumerologLavacharts\ChartQuery();
$query->setChartLabel('My special chart');
$query->setChartHeight(400);
$query->setChartWidth(800);
$chart = new \NamelessCoder\NumerologLavacharts\NumerologChart();
echo $chart->renderChartQuery($query);
```

The output will include both the `<div>` that will contain the graph as well as every
dependency required by Google Charts to render the graph. Graph data is converted to a
JavaScript array that is embedded in the HTML.

Integration
-----------

To render the graphs anywhere *other* than on the host that generates the chart - which
you may for example want to do if you are using the public Numerolog end-point - simply
load the response body of the HTTP request and output it in your own HTML document.
The example below is the extremely basic implementation of that principle:

```php
<html>
<head>My chart document</head>
<body>
<?php file_get_contents('http://numerolog....'); ?>
</body>
</html>
```

Since the default output already contains both `<script>` tag and `<div>` there's nothing
more you need to do before the chart is displayed. Change the URL parameters to affect
how the chart itself is rendered - see below!

Public implementation
---------------------

A publicly available graph rendering is available from:

```plain
http://numerolog.namelesscoder.net/chart.php
```

It accepts plain old `GET` parameters:

```plain
{url}?package={package}&token={token}&action=get&counter={counter}
```

And native parameters for basic chart configuration:

```plain
{url}?chartWidth=120&chartHeight=400&chartLabel=Number%20of%20carcrashes
```

And the special `chartAttributes` (which correspond to Google Chart configurations):

```plain
{url}?chartAttributes[pointSize]=10&chartAttributes[vAxis][title]=Year
```

And they all must be specified together. Required arguments are:

* `package`
* `counter`
* `token`
* `action` (only `get` is supported)

Plus the following references for other arguments:

* [A full list of every natively supported parameter](https://github.com/NamelessCoder/numerolog-lavacharts/blob/master/src/ChartQuery.php)
* [A full list of Google Chart configuration options](https://developers.google.com/chart/interactive/docs/)

Note that the Google Chart options you can use will always depend on the type of
chart you are rendering.
