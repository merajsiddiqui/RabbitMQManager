<?php
/**
 * @author Meraj Ahmad Siddiqui <merajsiddiqui@outlook.com>
 * @package RabbitMQManager\Configuration
 * @version 1.0 Initial Version
 * @link merajsiddiqui.github.io/rabbitmq-manager RabbitMQ Manager document
 */

namespace RabbitMQManager;

class Request extends Config {

	protected $base_url;

	private $login_credential;

	private $curl_options;

	public function __construct() {
		$this->base_url = self::$host . ":" . self::$port;
		$this->login_credential = self::$username . ":" . self::$password;
		$this->curl_options = [
			CURLOPT_CONNECTTIMEOUT => 10,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_USERPWD => $this->login_credential,
		];
		if (!$this->get("")) {
			throw new \Exception("RabbitMQ server down ... or  unable to connect", 1);
		}
	}

	public function get($uri) {
		$url = $this->base_url . "/" . $uri;
		$this->curl_options[CURLOPT_URL] = $url;
		$channel = curl_init();
		curl_setopt_array($channel, $this->curl_options);
		$data = curl_exec($channel);
		$header = curl_getinfo($channel);
		curl_close($channel);
		return $data;
	}

	public function put($uri, $data) {
		$url = $this->base_url . "/" . $uri;
		$this->curl_options[CURLOPT_URL] = $url;
		$this->curl_options[CURLOPT_CUSTOMREQUEST] = "PUT";
		$this->curl_options[CURLOPT_POSTFIELDS] = $data;
		$channel = curl_init();
		curl_setopt_array($channel, $this->curl_options);
		$data = curl_exec($channel);
		return $data;
	}

	public function delete($uri) {
		$url = $this->base_url . "/" . $uri;
		$this->curl_options[CURLOPT_URL] = $url;
		$this->curl_options[CURLOPT_CUSTOMREQUEST] = "DELETE";
		$channel = curl_init();
		curl_setopt_array($channel, $this->curl_options);
		$data = curl_exec($channel);
		return $data;
	}

	public function post($uri, $data) {
		$url = $this->base_url . "/" . $uri;
		$this->curl_options[CURLOPT_URL] = $url;
		$this->curl_options[CURLOPT_POST] = true;
		$this->curl_options[CURLOPT_POSTFIELDS] = $data;
		$channel = curl_init();
		curl_setopt_array($channel, $this->curl_options);
		$data = curl_exec($channel);
		return $data;
	}
}