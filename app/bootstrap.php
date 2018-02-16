<?php

define('ROOT_PATH', __DIR__ . '/../');

/**
 * Check for installed vendor packages
 */

if(!file_exists(ROOT_PATH . '/vendor/autoload.php'))
	throw new Exception('Run `composer install` before running the application.');

/**
 * Include vendor packages
 */

require ROOT_PATH . '/vendor/autoload.php';

/**
 * Include Core pack
 */

require __DIR__ . '/includes/core.php';


/**
 * Create CMS instance
 */

$JN_Core = new JN_Core();