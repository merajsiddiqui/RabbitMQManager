<?php
/**
 * @author Meraj Ahmad Siddiqui <merajsiddiqui@outlook.com>
 * @package RabbitMQManager\Configuration
 * @version 1.0 Initial Version
 * @link merajsiddiqui.github.io/rabbitmq-manager RabbitMQ Manager document
 */

namespace RabbitMQManager;

class Connection extends Request {

	private $uri = "api/connections";

	public function getConnectionList() {
		$open_connection_list = $this->get($this->uri);
		return $open_connection_list;
	}

	public function deleteConnection($connection, $reason = '') {
		$uri = $this->$uri . "/$connection/channels";
		$deleted = $this->delete($uri);
		return ($deleted) ?: "Sucessfully Deleted";
	}

	public function getChannelsList($connection) {
		$uri = $this->$uri . "/$connection";
		$channels_list = $this->get($uri);
		return ($channels_list) ?: "No Channels available";
	}
}