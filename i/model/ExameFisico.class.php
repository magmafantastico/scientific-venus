<?php

/**
 * Magma Scientific Model (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

class ExameFisico extends ConsultaThing {
	public $peso;
	public $altura;
	public $imc;
	public $pressaoArterial;
	public $circunferenciaAbdominal;
	public $circunferenciaCervical;

	public function fill($a)
	{
		$this->_id = $a['_id'];
		$this->peso = $a['peso'];
		$this->altura = $a['altura'];
		$this->imc = $a['imc'];
		$this->pressaoArterial = $a['pressaoArterial'];
		$this->circunferenciaAbdominal = $a['circunferenciaAbdominal'];
		$this->circunferenciaCervical = $a['circunferenciaCervical'];
	}
}