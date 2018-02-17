<?php

use Symfony\Component\Yaml\Yaml;

/**
 * Class JN_Config
 */

class JN_Config {

	private $configuration;

	private $database;

	/**
	 * JN_Config constructor.
	 * @throws \Exception
	 */

	public function __construct() {

		if(!file_exists(ROOT_PATH . '/app/config/journalist.yml'))
			throw new Exception('Journalist configuration file doesn\'t exist.');

		$configuration = Yaml::parseFile(ROOT_PATH . '/app/config/journalist.yml');

		if(!isset($configuration['application']))
			throw new Exception('`application` parameter must be present in configuration.');

		$this->configuration = $configuration;

		/**
		 * Database
		 */

		if(!file_exists(ROOT_PATH . '/app/config/database.yml'))
			throw new Exception('Database configuration file doesn\'t exist.');

		$database = Yaml::parseFile(ROOT_PATH . '/app/config/database.yml');

		if(!isset($database['database']))
			throw new Exception('`database` parameter must be present in configuration.');

		$this->database = $database;
	}

	/**
	 * Check if is debug mode configuration present
	 *
	 * @return bool
	 */

	public function isDebugMode() {

		if(!isset($this->configuration['application']['debug']))
			return false;

		$debugMode = $this->configuration['application']['debug'];

		if(is_array($debugMode)) {

			if(in_array($_SERVER['REMOTE_ADDR'], $debugMode))
				return true;

		} else if(is_bool($debugMode))
			return $debugMode;

		return false;
	}

	/**
	 * Get Database credentials
	 *
	 * @return mixed
	 */

	public function getDatabaseCredentials() {

		return $this->database['database'];
	}

}