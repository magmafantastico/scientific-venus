<?php

/**
 * Magma Scientific Model (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

class Model {
	public $antecedentes;
	public $conduta;
	public $consulta;
	public $escalas;
	public $exameFisico;
	public $exames;
	public $mioma;
	public $paciente;
	public $prontuario;
	public $resultados;
	public $ultrassom;

	/**
	 * @return string
	 */
	public function toJSON()
	{
		return json_encode($this);
	}
}