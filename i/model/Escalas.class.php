<?php

/**
 * Magma Scientific Model (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

class Escalas extends ConsultaThing {
	public $pbacInicial;
	public $beckInicial;
	public $vidaMioma;

	public function fill($a)
	{
		$this->_id = $a['_id'];
		$this->pbacInicial = $a['pbacInicial'];
		$this->beckInicial = $a['beckInicial'];
		$this->vidaMioma = $a['vidaMioma'];
	}
}