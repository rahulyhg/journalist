<?php


class JN_Url {

	private $url;

	private $urlParts;

	/**
	 * JN_Url constructor.
	 */

	public function __construct($url = false) {

		if(!$url)
			$url = isset($_GET['_u']) ? $_GET['_u'] : '/';

		if($url[0] != '/')
			$url = '/' . $url;

		$this->url = $url;

		$this->urlParts = explode('/', $this->url);
	}

	public function isAdmin() {

		if($this->urlParts[1] == 'admin')
			return true;

		return false;
	}

}