<?php

use Doctrine\ORM\Mapping AS ORM;

/**
 * @Entity
 * @Table(name="setting")
 */

class Setting {

	/**
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */

	public $id;

	/**
	 * @Column(type="string")
	 */

	public $name;

	/**
	 * @Column(type="string")
	 */

	public $value;

	/**
	 * @Column(type="datetime")
	 */

	public $updated_at;
}