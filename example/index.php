<?php

require dirname(__dir__) . "/vendor/autoload.php";

use RabbitMQManager\Config;
use RabbitMQManager\Queues;

$configuration_file =  dirname(__FILE__)."/config.json";
$configuration = json_decode(file_get_contents($configuration_file), true);

Config::init($configuration);
$queues = new Queues();

//Get all queue list
$list = $queues->getQueuesList();
var_dump($list);

//get a queue_data

// $queue_data = $queues->getQueueDetails("ads");
// var_dump($queue_data);
