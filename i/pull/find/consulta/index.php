<?php

/**
 * Magma Scientific Search Server v0.1.0 (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

header('Content-Type: application/json; charset=UTF-8;');
require_once('../../../var/connection.php');

class ConsultaSearch {

	public $request;
	private $requestJSON;

	public $consulta_id;
	public $prontuario_id;
	public $paciente_id;

	public $prontuario;
	public $paciente;
	public $conduta;
	public $resultados;
	public $consulta;
	public $sangramento;
	public $exames;
	public $exameFisico;
	public $escalas;
	public $antecedentes;
	public $uteroMioma;

	private $objectList = array(
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

	public function __construct($a)
	{
		$this->setRequestJSON($a);
		$this->setRequest(json_decode($this->getRequestJSON()));
	}

	/**
	 * @return mixed
	 */
	public function getConsultaId()
	{
		return $this->consulta_id;
	}

	/**
	 * @param mixed $consulta_id
	 */
	public function setConsultaId($consulta_id)
	{
		$this->consulta_id = $consulta_id;
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

	/**
	 * @return mixed
	 */
	public function getRequest()
	{
		return $this->request;
	}

	/**
	 * @param mixed $request
	 */
	public function setRequest($request)
	{
		$this->request = $request;
	}

	/**
	 * @return mixed
	 */
	public function getRequestJSON()
	{
		return $this->requestJSON;
	}

	/**
	 * @param mixed $requestJSON
	 */
	public function setRequestJSON($requestJSON)
	{
		$this->requestJSON = $requestJSON;
	}

	/**
	 * @param mixed $a
	 * @param mysqli $c
	 */
	public function findProntuario($a, $c)
	{
		$sql = "SELECT _id, paciente_id FROM prontuario where _id = " . $a;
		$res = $c->query($sql);

		if ($res->num_rows) {
			$r = mysqli_fetch_assoc($res);
			$this->setProntuarioId($r['_id']);
			$this->setPacienteId($r['paciente_id']);
		}
	}

	/**
	 * @param mysqli $c
	 */
	public function getProntuarioData($c)
	{
		$this->paciente = $this->getProntuarioDataArray('paciente', $this->getPacienteId(), $c);
		$this->prontuario = $this->getProntuarioDataArray('prontuario', $this->getProntuarioId(), $c);
	}

	/**
	 * @param $a
	 * @param $b
	 * @param $c
	 * @return array
	 */
	public function getProntuarioDataArray($a, $b, $c)
	{
		$sql = "SELECT * FROM" . " " . $a . " WHERE _id = " . $b;

		if ($d = $c->query($sql)) {

			$e = array();

			while ($f = mysqli_fetch_assoc($d))
				array_push($e, $f);

			$d->close();

			return $e;
		}
	}

	/**
	 * @param $a
	 * @param $c
	 */
	public function findConsulta($a, $c)
	{
		$sql = "SELECT _id, prontuario_id FROM consulta WHERE prontuario_id = " . $a;
		$res = $c->query($sql);

		if ($res->num_rows) {
			$r = mysqli_fetch_assoc($res);
			$this->setConsultaId($r['_id']);
			$this->setProntuarioId($r['prontuario_id']);
		}
	}

	/**
	 * @param mixed $a
	 * @param mysqli $c
	 */
	public function getData($a, $c)
	{
		$this->antecedentes = $this->getDataArray('antecedentes', $a, $c);
		$this->conduta = $this->getDataArray('conduta', $a, $c);
		$this->consulta = $this->getDataArray('consulta', $a, $c);
		$this->escalas = $this->getDataArray('escalas', $a, $c);
		$this->exameFisico = $this->getDataArray('exameFisico', $a, $c);
		$this->exames = $this->getDataArray('exames', $a, $c);
		$this->resultados = $this->getDataArray('resultados', $a, $c);
		$this->sangramento = $this->getDataArray('sangramento', $a, $c);
		$this->uteroMioma = $this->getDataArray('uteroMioma', $a, $c);
	}

	/**
	 * @param mixed $a
	 * @param $b
	 * @param mysqli $c
	 * @return array
	 */
	public function getDataArray($a, $b, $c)
	{
		$sql = "SELECT * FROM" . " " . $a . " WHERE consulta_id = " . $b;
		if ($d = $c->query($sql)) {

			$e = array();

			while ($f = mysqli_fetch_assoc($d))
				array_push($e, $f);

			$d->close();

			return $e;
		}
	}

	public function toJSON()
	{
		return json_encode($this);
	}

}

if (!empty($_GET['prontuario_id'])) {

	$s = $_GET['prontuario_id'];
	$connection = new Connection();
	$c = $connection->getConnection();

	$a = new ConsultaSearch($s);

	$a->findProntuario($a->request, $c);
	if (($a->getProntuarioId()))
		$a->getProntuarioData($c);

	$a->findConsulta($a->getProntuarioId(), $c);
	if ($a->getProntuarioId())
		$a->getData($a->getConsultaId(), $c);

} else {
	$s = '{}';
}

print_r($a->toJSON());