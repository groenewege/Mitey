<?php

$endpoint = $_GET['api_endpoint'];
$key = $_GET['api_key'];
if (!isset($endpoint) || empty($endpoint) || !isset($key) || empty($key))
{
	die('Please provide your api credentials!');
}

require_once 'Mite/Mite.php';
$mite = new Mite\Mite($endpoint, $key);

if (isset($_GET['group_by']) && $_GET['group_by'] == 'day') {
	$query_at = 'this_week';
	$query_group_by = 'day';
	$filter_value = 'at';
	$graph_title = 'This week';
} else {
	$query_at = 'this_month';
	$query_group_by = 'week';
	$filter_value = 'from';
	$graph_title = 'This month';
}

$times = $mite->getGroupedTimes(array($query_group_by, 'project'), array(), array(), array(), array(), null, false,
								$query_at, false, false, null, false, false);

$period = array();
$projects = array();
foreach ($times as $time) {
	$project_id = $time->project_id;
	$project_name = $time->project_name;
	$filters = $time->time_entries_params;
	$from = substr($filters[$filter_value], -5);
	$period[$from] = 1;
	$hours = $time->minutes / 60;
	if (!isset($projects[$project_id])) {
		$projects[$project_id] = array('title' => $project_name);
		$projects[$project_id]['datapoints'] = array();
	}
	$projects[$project_id]['datapoints'][$from]['title'] = $from;
	$projects[$project_id]['datapoints'][$from]['value'] = $hours;
}

ksort($period);

$graph = array();
$graph['title'] = $graph_title;
$graph['datasequences'] = array();
foreach ($projects as $project) {
	$sequence = array('title' => $project['title'], 'datapoints' => array());
	foreach ($period as $key => $value) {
		if (isset($project['datapoints'][$key])) {
			$sequence['datapoints'][] = $project['datapoints'][$key];
		} else {
			$sequence['datapoints'][] = array('title' => $key, 'value' => '0');
		}
	}
	$graph['datasequences'][] = $sequence;
}

header('Content-type: application/json');
echo json_encode(array('graph' => $graph));