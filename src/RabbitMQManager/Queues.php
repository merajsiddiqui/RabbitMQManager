<?php
/**
 * @author Meraj Ahmad Siddiqui <merajsiddiqui@outlook.com>
 * @package RabbitMQManager\Configuration
 * @version 1.0 Initial Version
 * @link merajsiddiqui.github.io/rabbitmq-manager RabbitMQ Manager document
 */

namespace RabbitMQManager;

class Queues extends Request {

	public function getQueuesList($internal_call = false) {
		$result = [];
		$uri = "api/queues";
		$json_data = $this->get($uri);
		$decoded_data = json_decode($json_data, true);
		var_dump($decoded_data);
		die();
		if ($internal_call) {
			return $decoded_data;
		}
		$queue_detail = [];
		foreach ($decoded_data as $queue_data) {
			$queue_detail = [
				"name" => $queue_data["name"],
				"vhost" => $queue_data["vhost"],
				"state" => $queue_data["state"],
			];
			$result[] = $queue_detail;
		}
		return $result;
	}

	public function getQueueDetails($queue_name) {
		$all_queue_data = $this->getQueuesList(true);
		$queue_result = [];
		foreach ($all_queue_data as $queue_data) {
			if ($queue_data["name"] == $queue_name) {
				$queue_result = $queue_data;
			}
		}
		return ($queue_result) ? $queue_result : "No Such queue found";
	}
}
