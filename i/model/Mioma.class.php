<?php

/**
 * Magma Scientific Model (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

class Mioma extends ConsultaThing {
	public $medida;
	public $tipo;

	public function fill($a)
	{
		$this->_id = $a['_id'];
		$this->medida = $a['medida'];
		$this->tipo = $a['tipo'];
	}
}