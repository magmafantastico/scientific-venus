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
		$this->setQueryName('paciente_id');
		$this->setQueryValue($a);
		$this->setQueryLimit(1);

		$this->setPacienteId($a);
	}

	public function fill($a)
	{
		$this->_id = $a['_id'];
		$this->data = $a['data'];
		$this->registro = $a['registro'];
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