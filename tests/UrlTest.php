<?php

namespace Tests;

require __DIR__ . '/../app/includes/JN_Url.php';

class UrlTest extends \PHPUnit_Framework_TestCase {

	public function testIsAdminCheckWorking() {

		// Good one

		$url = new \JN_Url('/admin');

		$this->assertEquals(true, $url->isAdmin());

		// Wrong

		$url = new \JN_Url('/');

		$this->assertEquals(false, $url->isAdmin());

		// Wrong

		$url = new \JN_Url('admin');


		$this->assertEquals(true, $url->isAdmin());

		// Wrong

		$url = new \JN_Url('');

		$this->assertEquals(false, $url->isAdmin());

		// Wrong

		$url = new \JN_Url('/test/case/url');

		$this->assertEquals(false, $url->isAdmin());
	}
}
