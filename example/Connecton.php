<?php


require dirname(__dir__) . "/vendor/autoload.php";

$configuration_file =  dirname(__FILE__)."/config.json";
$configuration = json_decode(file_get_contents($configuration_file), true);

use RabbitMQManager\Config;
use RabbitMQManager\Connection;

/**
 * Set configuration of RabbitMQ connection
 */
Config::init($configuration);

/**
 * This will create an object of Connection to be used for operation on connection
 */
$connection = new Connection();

$all_open_connection = $connection->getConnectionList();
var_dump($all_open_connection);