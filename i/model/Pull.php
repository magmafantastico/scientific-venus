<?php

/**
 * Magma Scientific Model (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

class Pull extends Model {

	public function __construct($r, $c)
	{
		$this->paciente = new Paciente();
		$this->paciente->fill(mysqli_fetch_assoc($r));

		$this->prontuario = new Prontuario($this->paciente->_id);
		$this->prontuario->fill(mysqli_fetch_assoc($this->prontuario->pull($c)));

		$this->consulta = new Consulta($this->prontuario->_id);
		$this->consulta->fill(mysqli_fetch_assoc($this->consulta->pull($c)));

		$id = $this->consulta->_id;

		$this->antecedentes = new Antecedentes($id);
		$this->antecedentes->fill(mysqli_fetch_assoc($this->antecedentes->pull($c)));

		$this->conduta = new Conduta($id);
		$this->conduta->fill(mysqli_fetch_assoc($this->conduta->pull($c)));

		$this->escalas = new Escalas($id);
		$this->escalas->fill(mysqli_fetch_assoc($this->escalas->pull($c)));

		$this->exameFisico = new ExameFisico($id);
		$this->exameFisico->fill(mysqli_fetch_assoc($this->exameFisico->pull($c)));

		$this->exames = new Exames($id);
		$this->exames->fill(mysqli_fetch_assoc($this->exames->pull($c)));

		$this->mioma = array();
		$mioma = new Mioma($id);
		if ($r = $mioma->pull($c))
			for ($i = $r->num_rows; $i--; ) {
				$m = new Mioma($id);
				$m->fill(mysqli_fetch_assoc($r));
				array_push($this->mioma, $m);
			}

		$this->resultados = new Resultados($id);
		$this->resultados->fill(mysqli_fetch_assoc($this->resultados->pull($c)));

		$this->ultrassom = new Ultrassom($id);
		$this->ultrassom->fill(mysqli_fetch_assoc($this->ultrassom->pull($c)));
	}

}