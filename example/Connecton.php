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