<?php


class JN_Response {

	private $statusCode = 200;

	private $statusMessage = 'OK';

	public function setResponse($code, $message) {

		$this->statusCode = $code;

		$this->statusMessage = $message;
	}

	private function setHeader($header, $value) {

		header($header . ': ' . $value);
	}

	/**
	 * Send Http response
	 */

	public function send() {

		header($_SERVER['SERVER_PROTOCOL'] . ' ' . $this->statusCode . ' ' . $this->statusMessage, true, $this->statusCode);
		http_response_code($this->statusCode);
	}

	/**
	 * Send JSON response
	 *
	 * @param $data
	 */

	public function sendJson($data) {

		$this->setHeader('Access-Control-Allow-Origin', '*');
		$this->setHeader('Content-type', 'application/json');

		echo json_encode($data);
	}

}