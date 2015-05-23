<?php
/**
 * Magma Scientific Model (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

class Response {

	private $request;
	private $requestJSON;

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
	 * @param $a
	 */
	public function __construct($a)
	{
		$this->setRequestJSON($a);
		$this->setRequest(json_decode($this->getRequestJSON()));
	}

	/**
	 * @param mysqli $c
	 */
	public function pushAll($c)
	{
		$this->antecedentes->push($c);
		$this->conduta->push($c);
		$this->escalas->push($c);
		$this->exameFisico->push($c);
		$this->exames->push($c);
		$this->resultados->push($c);
		$this->ultrassom->push($c);
	}

	/**
	 * @param $a
	 */
	public function createAll($a)
	{
		$this->antecedentes = new Antecedentes($a);
		$this->conduta = new Conduta($a);
		$this->escalas = new Escalas($a);
		$this->exameFisico = new ExameFisico($a);
		$this->exames = new Exames($a);
		$this->resultados = new Resultados($a);
		$this->ultrassom = new Ultrassom($a);
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
	 * @return mixed
	 */
	public function getPaciente()
	{
		return $this->paciente;
	}

	/**
	 * @return mixed
	 */
	public function getProntuario()
	{
		return $this->prontuario;
	}

	/**
	 * @return mixed
	 */
	public function getConsulta()
	{
		return $this->consulta;
	}

	public function toJSON()
	{
		return json_encode($this);
	}

}