<?php

/**
 * Magma Scientific Model (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

class ModelLog {
	public $log;

	/**
	 * @return string
	 */
	public function toJSON()
	{
		return json_encode($this);
	}
}