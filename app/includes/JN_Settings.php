<?php


class JN_Settings {

	private $settings = [];

	/**
	 * JN_Settings constructor.
	 *
	 * @param $options
	 */

	public function __construct($options) {

		foreach($options as $option) {

			$this->settings[$option->name] = $option->value;
		}
	}

	/**
	 * Get settings key
	 *
	 * @param $name
	 *
	 * @return mixed|null
	 */

	public function get($name) {

		return isset($this->settings[$name]) ? $this->settings[$name] : null;
	}

}