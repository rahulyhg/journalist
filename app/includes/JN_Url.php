<?php


class JN_Url {

	private $url;

	/**
	 * JN_Url constructor.
	 */

	public function __construct($url = false) {

		if(!$url)
			$url = isset($_GET['_u']) ? $_GET['_u'] : '/';

		if($url[0] != '/')
			$url = '/' . $url;

		$this->url = $url;
	}

	public function getUrl() {

		return $this->url;
	}

}