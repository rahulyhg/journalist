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

require __DIR__ . '/includes/JN_Core.php';


/**
 * Create CMS instance
 */

$JN_Core = new JN_Core();

$JN_Core->getPageData();

$JN_Core->resolveTemplate();

echo $JN_Core->getContent();