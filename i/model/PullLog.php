<?php

/**
 * Magma Scientific Model (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

class PullLog extends ModelLog {

	public function __construct($r, $c)
	{
		$this->log = new Log();
		$this->log->fill(mysqli_fetch_assoc($r));
	}

}