<?php

/**
 * Class JN_Core
 */

class JN_Core {

	public $request;

	public $url;

	public $response;

	/**
	 * JN_Core constructor.
	 */

	public function __construct() {

		$this->request = new JN_Request();

		$this->url = new JN_Url();

		$this->template = new JN_Template('default');
	}

}