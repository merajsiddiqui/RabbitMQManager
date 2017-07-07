<?php

require dirname(__dir__) . "/vendor/autoload.php";

$configuration_file =  dirname(__FILE__)."/config.json";
$configuration = json_decode(file_get_contents($configuration_file), true);

use RabbitMQManager\Config;
use RabbitMQManager\Exchange;
/**
 * Set configuration of RabbitMQ connection
 */
Config::init($configuration);

/**
 * This will create an object of exchange to be used for operation on exchange
 */
$exchange = new Exchange();

/**
 * Get List of all exchanges available
 */
$list = $exchange->getExhangeList();
var_dump($list);

/**
 * Create new exchange
 */
$new_exchange_name = "ads";
$new_exchange_args = [
	"type" => "direct", //Compulsary
	"auto_delete" => false,
	"durable" => true,
	"internal" => false,
	"arguments" => [
		"author" => "meraj",
		"source" => "lib",
	],
];

$result = $exchange->createExchange($new_exchange_name, $new_exchange_args);
var_dump($result);

/**
 * Publishing Message to an exchange
 */
$publish_exchange_name = "ads";
$publish_data = [
	"properties" => [

	],
	"routing_key" => "ads_test",
	"payload" => "Thsi is the  payload to be published",
	"payload_encoding" => "string", //string, base64
];

$published = $exchange->publishMessage($publish_exchange_name, $publish_data);
var_dump($published);

/**
 * Deleting any exchange, delete method takes three arguments
 */
//exchange name to delete
$exchange_name = "ads";
//optional ---- default false, If true it will delete it even if its in use
$delete_forcefully = false;
//optional  ---- default as provided in configuration
$vhost = "something";

$deleted = $exchange->deleteExchange($exchange_name, $delete_forcefully, $vhost);
var_dump($deleted);