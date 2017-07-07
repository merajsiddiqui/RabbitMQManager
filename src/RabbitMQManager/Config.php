<?php
/**
 * @author Meraj Ahmad Siddiqui <merajsiddiqui@outlook.com>
 * @package RabbitMQManager\Configuration
 * @version 1.0 Initial Version
 * @link merajsiddiqui.github.io/rabbitmq-manager RabbitMQ Manager document
 */

namespace RabbitMQManager;

class Config {

	/**
	 * Host address
	 * @var string
	 */
	protected static $host = "127.0.0.1";

	/**
	 * Port
	 * @var int
	 */
	protected static $port = 15672;

	/**
	 * Vhost rabbitmq
	 * @var string
	 */
	protected static $vhost = "/";

	/**
	 * Username
	 * @var string
	 */
	protected static $username = "guest";
	

	/**
	 * Password
	 * @var string
	 */
	protected static $password = "guest";

	public static function init($configuration_deatils = []) {
		$configuration_deatils_data_type = gettype($configuration_deatils);
		if ("array" == $configuration_deatils_data_type) {
			foreach ($configuration_deatils as $key => $value) {
				if (isset(self::$$key)) {
					self::$$key = $value;
				} else {
					throw new \Exception("Unknown parameter $key", 1);
				}
			}
			if (self::$vhost == "/") {
				self::$vhost = urlencode(self::$vhost);
			}
		} else {
			throw new \Exception("Configuratin array expected", 1);
		}
	}

}
