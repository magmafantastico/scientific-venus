<?php

/**
 * Magma Scientific Model (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

class Resultados extends ConsultaThing {
	public $pbacFinal;
	public $beckFinal;
	public $vidaMioma;

	public function fill($a)
	{
		$this->_id = $a['_id'];
		$this->pbacFinal = $a['pbacFinal'];
		$this->beckFinal = $a['beckFinal'];
		$this->vidaMioma = $a['vidaMioma'];
	}
}