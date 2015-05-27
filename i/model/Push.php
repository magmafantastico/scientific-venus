<?php

/**
 * Magma Scientific Model (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

class Push extends Model {

	private $request;
	private $requestJSON;

	/**
	 * @param $a
	 * @param mysqli $c
	 */
	public function __construct($a, $c)
	{
		$this->setRequestJSON($a);
		$this->setRequest(json_decode($this->getRequestJSON()));

		$this->pushAll($c);
	}

	/**
	 * @param mysqli $c
	 */
	public function pushAll($c)
	{
		$this->setPaciente($c);
		$this->setProntuario($c);
		$this->setConsulta($c);

		$this->setAntecedentes($c);
		$this->setConduta($c);
		$this->setEscalas($c);
		$this->setExameFisico($c);
		$this->setExames($c);
		$this->setMioma($c);
		$this->setResultados($c);
		$this->setUltrassom($c);
	}

	/**
	 * @param $c
	 */
	public function setPaciente($c)
	{
		$this->paciente = new Paciente();
		$this->paciente->fill((array) $this->getRequest()->paciente);
		$this->paciente->push($c);
	}

	/**
	 * @param $c
	 */
	public function setProntuario($c)
	{
		$this->prontuario = new Prontuario($this->paciente->_id);
		$this->prontuario->fill((array) $this->getRequest()->prontuario);
		$this->prontuario->push($c);
	}

	/**
	 * @param $c
	 */
	public function setConsulta($c)
	{
		$this->consulta = new Consulta($this->prontuario->_id);
		$this->consulta->fill((array) $this->getRequest()->prontuario);
		$this->consulta->push($c);
	}

	/**
	 * @param mysqli $c
	 */
	public function setAntecedentes($c)
	{
		$this->antecedentes = new Antecedentes($this->consulta->_id);
		$this->antecedentes->fill((array) $this->getRequest()->antecedentes);
		$this->antecedentes->push($c);
	}

	/**
	 * @param mysqli $c
	 */
	public function setConduta($c)
	{
		$this->conduta = new Conduta($this->consulta->_id);
		$this->conduta->fill((array) $this->getRequest()->conduta);
		$this->conduta->push($c);
	}

	/**
	 * @param mysqli $c
	 */
	public function setEscalas($c)
	{
		$this->escalas = new Escalas($this->consulta->_id);
		$this->escalas->fill((array) $this->getRequest()->escalas);
		$this->escalas->push($c);
	}

	/**
	 * @param mysqli $c
	 */
	public function setExameFisico($c)
	{
		$this->exameFisico = new ExameFisico($this->consulta->_id);
		$this->exameFisico->fill((array) $this->getRequest()->exameFisico);
		$this->exameFisico->push($c);
	}

	/**
	 * @param mysqli $c
	 */
	public function setExames($c)
	{
		$this->exames = new Exames($this->consulta->_id);
		$this->exames->fill((array) $this->getRequest()->exames);
		$this->exames->push($c);
	}

	/**
	 * @param mysqli $c
	 */
	public function setMioma($c)
	{
		$this->mioma = array();
		for ($i = count($this->getRequest()->mioma); $i--; ) {
			$mioma = new Mioma($this->consulta->_id);
			$mioma->fill((array) $this->getRequest()->mioma[$i]);
			$mioma->push($c);
			array_push($this->mioma, $mioma);
		}
	}

	/**
	 * @param mysqli $c
	 */
	public function setResultados($c)
	{
		$this->resultados = new Resultados($this->consulta->_id);
		$this->resultados->fill((array) $this->getRequest()->resultados);
		$this->resultados->push($c);
	}

	/**
	 * @param mysqli $c
	 */
	public function setUltrassom($c)
	{
		$this->ultrassom = new Ultrassom($this->consulta->_id);
		$this->ultrassom->fill((array) $this->getRequest()->ultrassom);
		$this->ultrassom->push($c);
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