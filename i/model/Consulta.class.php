<?php

/**
 * Magma Scientific Model (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

class Consulta extends Thing
{
	public $prontuario_id;
	public $data;

	/**
	 * @param $a
	 */
	public function __construct($a)
	{
		$this->setProntuarioId($a);
	}

	/**
	 * @return mixed
	 */
	public function getProntuarioId()
	{
		return $this->prontuario_id;
	}

	/**
	 * @param mixed $prontuario_id
	 */
	public function setProntuarioId($prontuario_id)
	{
		$this->prontuario_id = $prontuario_id;
	}

	/**
	 * @param mixed $consulta_id
	 */
}