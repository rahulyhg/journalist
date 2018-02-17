<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

/**
 * Class JN_Database
 */

class JN_Database {

	/** @var EntityManager */

	public $em;

	/**
	 * JN_Database constructor.
	 */

	public function __construct($configuration, $debugMode) {

		$config = Setup::createAnnotationMetadataConfiguration([ __DIR__ . '/models' ], $debugMode);
		$entityManager = EntityManager::create($configuration, $config);

		$this->em = $entityManager;
	}
}