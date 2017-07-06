<?php

$configuration = [
	"host" => "192.168.1.34",
	"port" => "15672",
	"vhost" => "/",
	"username" => "linkex",
	"password" => "linkex",
];

require dirname(__dir__) . "/vendor/autoload.php";

use RabbitMQManager\Config;
use RabbitMQManager\Queues;

Config::init($configuration);
$queues = new Queues();

//Get all queue list
$list = $queues->getQueuesList();
var_dump($list);

//get a queue_data

// $queue_data = $queues->getQueueDetails("ads");
// var_dump($queue_data);
