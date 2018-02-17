<?php


class JN_Request {

	private $request;

	public function __construct() {

		$this->request = $_REQUEST;
	}

}