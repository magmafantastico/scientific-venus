<?php

/**
 * Magma Scientific Model (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

class Prontuario extends Thing {

	public $paciente_id;
	public $data;
	public $registro;

	public function __construct($a)
	{
		$this->setPacienteId($a);
	}

	/**
	 * @return mixed
	 */
	public function getPacienteId()
	{
		return $this->paciente_id;
	}

	/**
	 * @param mixed $paciente_id
	 */
	public function setPacienteId($paciente_id)
	{
		$this->paciente_id = $paciente_id;
	}

}