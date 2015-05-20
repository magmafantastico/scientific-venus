<?php

/**
 * Magma Scientific Pull Server v0.5.0 (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

header('Content-Type: application/json; charset=UTF-8;');
require_once('../var/connection.php');

class Data {

	private $conn;
	public $objectList = array(
		'antecedentes',
		'conduta',
		'consulta',
		'escalas',
		'exameFisico',
		'exames',
		'paciente',
		'prontuario',
		'resultados',
		'sangramento',
		'uteroMioma');

	public $antecedentes;
	public $conduta;
	public $consulta;
	public $escalas;
	public $exameFisico;
	public $exames;
	public $paciente;
	public $prontuario;
	public $resultados;
	public $sangramento;
	public $uteroMioma;

	public function __construct()
	{
		$a = new Connection();
		$this->conn = $a->getConnection();

		if ($this->conn->connect_errno)
			echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;

		self::getData();
	}

	private function getData()
	{
		$this->antecedentes = $this->getDataArray('antecedentes', $this->conn);
		$this->conduta = $this->getDataArray('conduta', $this->conn);
		$this->consulta = $this->getDataArray('consulta', $this->conn);
		$this->escalas = $this->getDataArray('escalas', $this->conn);
		$this->exameFisico = $this->getDataArray('exameFisico', $this->conn);
		$this->exames = $this->getDataArray('exames', $this->conn);
		$this->paciente = $this->getDataArray('paciente', $this->conn);
		$this->prontuario = $this->getDataArray('prontuario', $this->conn);
		$this->resultados = $this->getDataArray('resultados', $this->conn);
		$this->sangramento = $this->getDataArray('sangramento', $this->conn);
		$this->uteroMioma = $this->getDataArray('uteroMioma', $this->conn);
	}

	private function getDataArray($a, $b)
	{
		if ($c = $b->query("SELECT * FROM " . $a)) {
			$d = array();

			while ($e = mysqli_fetch_assoc($c))
				array_push($d, $e);

			$c->close();

			return $d;
		}
	}

	public function toJSON()
	{
		return json_encode($this);
	}

}

$obj = new Data();
echo $obj->toJSON();