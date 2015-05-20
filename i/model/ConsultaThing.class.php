<?php

/**
 * Magma Scientific Model (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

class ConsultaThing extends Thing {

	public $consulta_id;

	/**
	 * @param $a
	 */
	public function __construct($a)
	{
		$this->setConsultaId($a);
	}

	/**
	 * @param mixed $consulta_id
	 */
	public function setConsultaId($consulta_id)
	{
		$this->consulta_id = $consulta_id;
	}

}