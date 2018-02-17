<?php

use Doctrine\ORM\Mapping AS ORM;

/**
 * @Entity
 * @Table(name="post")
 */

class Post {

	/**
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */

	public $id;

	/**
	 * @Column(type="string")
	 */

	public $post_type;

	/**
	 * @Column(type="string")
	 */

	public $slug;

	/**
	 * @Column(type="string")
	 */

	public $title;

	/**
	 * @Column(type="string")
	 */

	public $content;
}