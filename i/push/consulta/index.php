<?php

/**
 * Magma Scientific Push Server v1.9.0 (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

header('Content-Type: application/json; charset=UTF-8;');
require_once('../../var/connection.php');
require_once('../../model/Thing.class.php');
require_once('../../model/Paciente.class.php');
require_once('../../model/Prontuario.class.php');
require_once('../../model/ConsultaThing.class.php');
require_once('../../model/Consulta.class.php');
require_once('../../model/Antecedentes.class.php');
require_once('../../model/Conduta.class.php');
require_once('../../model/Escalas.class.php');
require_once('../../model/ExameFisico.class.php');
require_once('../../model/Exames.class.php');
require_once('../../model/Resultados.class.php');
require_once('../../model/Sangramento.class.php');
require_once('../../model/UteroMioma.class.php');

function __autoload($name) {
	echo "Want to load $name.\n";
	throw new Exception("Unable to load $name.");
}

class ResponseConsulta {

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

	public function __construct($a)
	{
		$this->consulta = new Consulta($a);

	}

	public function createAll($a)
	{
		$this->antecedentes = new Antecedentes($a);
		$this->conduta = new Conduta($a);
		$this->escalas = new Escalas($a);
		$this->exameFisico = new ExameFisico($a);
		$this->exames = new Exames($a);
		$this->prontuario = new Prontuario($a);
		$this->resultados = new Resultados($a);
		$this->sangramento = new Sangramento($a);
		$this->uteroMioma = new UteroMioma($a);
	}

	public function pushAll($c)
	{
		$this->antecedentes->push($c);
		$this->conduta->push($c);
		$this->escalas->push($c);
		$this->exameFisico->push($c);
		$this->exames->push($c);
		$this->prontuario->push($c);
		$this->resultados->push($c);
		$this->sangramento->push($c);
		$this->uteroMioma->push($c);
	}

}

try {

	$connection = new Connection();
	$c = $connection->getConnection();

	if (!empty($_GET['prontuario_id'])) {
		$i = $_GET['prontuario_id'];

		echo $i;
		$response = new ResponseConsulta($i);

		$response->consulta->data = '2015-05-10';
		$response->consulta->push($c);
		$_id = $response->consulta->_id;

		$response->createAll($_id);

		$response->pushAll($c);

		print_r($response);

		$antecedentes = new Antecedentes($a);
		$conduta = new Conduta($a);
		$escalas = new Escalas($a);
		$exameFisico = new ExameFisico($a);
		$exames = new Exames($a);
		$prontuario = new Prontuario($a);
		$resultados = new Resultados($a);
		$sangramento = new Sangramento($a);
		$uteroMioma = new UteroMioma($a);

	}

} catch (Exception $e) {
	echo $e->getMessage(), "\n";
}
