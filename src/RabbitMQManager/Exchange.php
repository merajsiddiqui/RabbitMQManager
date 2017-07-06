<?php
/**
 * @author Meraj Ahmad Siddiqui <merajsiddiqui@outlook.com>
 * @package RabbitMQManager\Configuration
 * @version 1.0 Initial Version
 * @link merajsiddiqui.github.io/rabbitmq-manager RabbitMQ Manager document
 */

namespace RabbitMQManager;

class Exchange extends Request {

	protected $uri = "api/exchanges";

	public function getExhangeList() {
		$exchange_json_data = $this->get($this->uri);
		$decoded_data = json_decode($exchange_json_data, true);
		if (count($decoded_data) < 1) {
			return "No exchange found";
		}
		$exchange_result = [];
		foreach ($decoded_data as $exchange_data) {
			unset($exchange_data["message_stats"]);
			unset($exchange_data["arguments"]);
			$exchange_result[] = $exchange_data;
		}
		return $exchange_result;
	}

	public function deleteExchange($exchange, $force = false, $vhost = "") {
		if (!trim($vhost)) {
			$vhost = Config::$vhost;
		}

		$uri = $this->uri . "/$vhost/$exchange";

		if (!$force) {
			$uri = $uri . "?if-unused=true";
		}

		$delete_result = $this->delete($uri);
		return ($delete_result) ?: "Successfully deleted";
	}

	public function createExchange($exchange, $exchange_arg, $vhost = "") {
		if (!trim($vhost)) {
			$vhost = Config::$vhost;
		}
		$uri = $this->uri . "/$vhost/$exchange";
		$exchange_data = json_encode($exchange_arg);
		$exchange_result = $this->put($uri, $exchange_data);
		return ($exchange_result) ?: "Exchange Successfully created";
	}

	public function publishMessage($exchange, $message = [], $vhost = "") {
		if (!trim($vhost)) {
			$vhost = Config::$vhost;
		}
		$uri = $this->uri . "/$vhost/$exchange/publish";
		$publish_data = json_encode($message);
		$publish_result = $this->post($uri, $publish_data);
		return ($publish_result) ?: "No Queues bind to this exchange ";
	}
}
