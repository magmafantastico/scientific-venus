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

	public function setQuery()
	{
		$this->setQueryName('consulta_id');
		$this->setQueryValue($this->consulta_id);
		$this->setQueryLimit(0);
	}
}