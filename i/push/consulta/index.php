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

	private $request;
	private $requestJSON;

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
		$this->setRequestJSON($a);
		$this->setRequest(json_decode($this->getRequestJSON()));
		$this->consulta = new Consulta($this->getRequest()->prontuario->_id);
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

	public function createAll($a)
	{
		$this->antecedentes = new Antecedentes($a);
		$this->conduta = new Conduta($a);
		$this->escalas = new Escalas($a);
		$this->exameFisico = new ExameFisico($a);
		$this->exames = new Exames($a);
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
		$this->resultados->push($c);
		$this->sangramento->push($c);
		$this->uteroMioma->push($c);
	}

	public function toJSON()
	{
		return json_encode($this);
	}

}

try {

	$connection = new Connection();
	$c = $connection->getConnection();

	if (!empty($_POST['response'])) {
		//$a = $_GET['prontuario_id'];
		$a = '{"prontuario":{"_id":"200","registro":"666","data":"2015-06-18"},"paciente":{"nome":"Maria Antonieta","sexo":false,"nascimento":"2002-04-09","religiao":"Testemunha de Jeová","religiaoNote":"_b1000","etnia":"Negro","etniaNote":"_a2000","escolaridade":"Fundamental","escolaridadeNote":"_a3000","estadoCivil":"Solteiro(a)","estadoCivilNote":"_z40"},"exameFisico":{"peso":"60","altura":"180","imc":"18","pressaoArterial":"54","circunferenciaAbdominal":"54","circunferenciaCervical":"54"},"antecedentes":{"situacaoAborto":"9","situacaoGestacao":"9","situacaoParidade":"1","tabagismo":true,"hac":true,"hacType":"Descompensado","diabetes":true,"diabetesType":"Compensado","hipotireoidismo":true,"hipotireoidismoType":"Compensado","note":"aborteira"},"uteroMioma":{"us":false,"volumeInterino":"650","ovarioDireito":"650","ovarioEsquerdo":"650","endometro":"65","miomaQuantidade":"2","mioma_1_caracteristicas":"65","mioma_1_submucoso":true,"mioma_1_subseroso":false,"mioma_1_intramural":false,"mioma_2_caracteristicas":"50","mioma_2_submucoso":false,"mioma_2_subseroso":true,"mioma_2_intramural":false,"nd":false},"sangramento":{"pbacInicial":"65"},"escalas":{"beckInicial":"65","vidaMioma":"65"},"exames":{"hb":"65","ht":"65","ferro":"65","ferritina":"65","rdw":"6","vcm":"5","vitaminaD3":"65","tsh":"65","gj":"65","ct":"65","ldl":false,"hdl":"65","t4l":"65"},"conduta":{"conduta":"Hormônio Terapia","cirurgia":false,"hormonioTerapia":"A.C.Os","hormonioTerapiaCiclico":true,"hormonioTerapiaContinuo":true,"hormonioTerapiaNome":"asdfa","ainh":false},"resultados":{"pbacFinal":"650","beckFinal":"650","vidaMioma":"650"}}';

		// Preenche consulta
		$response = new ResponseConsulta($a);

		$r = $response->getRequest();

		$response->consulta->data = $r->prontuario->data;
		$response->consulta->push($c);

		// Preenche itens da consulta
		$response->createAll($response->consulta->_id);

		$response->antecedentes;

		$response->antecedentes->situacaoAborto = $r->antecedentes->situacaoAborto;
		$response->antecedentes->situacaoGestacao = $r->antecedentes->situacaoGestacao;
		$response->antecedentes->situacaoParidade = $r->antecedentes->situacaoParidade;
		$response->antecedentes->tabagismo = $r->antecedentes->tabagismo;
		$response->antecedentes->hac = $r->antecedentes->hac;
		$response->antecedentes->hacType = $r->antecedentes->hacType;
		$response->antecedentes->diabetes = $r->antecedentes->diabetes;
		$response->antecedentes->diabetesType = $r->antecedentes->diabetesType;
		$response->antecedentes->hipotireoidismo = $r->antecedentes->hipotireoidismo;
		$response->antecedentes->hipotireoidismoType = $r->antecedentes->hipotireoidismoType;
		$response->antecedentes->note = $r->antecedentes->note;

		$response->conduta->conduta = $r->conduta->conduta;
		$response->conduta->cirurgia = $r->conduta->cirurgia;
		$response->conduta->hormonioTerapia = $r->conduta->hormonioTerapia;
		$response->conduta->hormonioTerapiaCiclico = $r->conduta->hormonioTerapiaCiclico;
		$response->conduta->hormonioTerapiaContinuo = $r->conduta->hormonioTerapiaContinuo;
		$response->conduta->hormonioTerapiaNome = $r->conduta->hormonioTerapiaNome;
		$response->conduta->ainh = $r->conduta->ainh;

		$response->escalas->beckInicial = $r->escalas->beckInicial;
		$response->escalas->vidaMioma = $r->escalas->vidaMioma;

		$response->exameFisico->peso = $r->exameFisico->peso;
		$response->exameFisico->altura = $r->exameFisico->altura;
		$response->exameFisico->imc = $r->exameFisico->imc;
		$response->exameFisico->pressaoArterial = $r->exameFisico->pressaoArterial;
		$response->exameFisico->circunferenciaAbdominal = $r->exameFisico->circunferenciaAbdominal;
		$response->exameFisico->circunferenciaCervical = $r->exameFisico->circunferenciaCervical;

		$response->exames->hb = $r->exames->hb;
		$response->exames->ht = $r->exames->ht;
		$response->exames->ferro = $r->exames->ferro;
		$response->exames->ferritina = $r->exames->ferritina;
		$response->exames->rdw = $r->exames->rdw;
		$response->exames->vcm = $r->exames->vcm;
		$response->exames->vitaminaD3 = $r->exames->vitaminaD3;
		$response->exames->tsh = $r->exames->tsh;
		$response->exames->gj = $r->exames->gj;
		$response->exames->ct = $r->exames->ct;
		$response->exames->ldl = $r->exames->ldl;
		$response->exames->hdl = $r->exames->hdl;
		$response->exames->t4l = $r->exames->t4l;

		$response->resultados->pbacFinal = $r->resultados->pbacFinal;
		$response->resultados->beckFinal = $r->resultados->beckFinal;
		$response->resultados->vidaMioma = $r->resultados->vidaMioma;

		$response->sangramento->pbacInicial = $r->sangramento->pbacInicial;

		$response->uteroMioma->us = $r->uteroMioma->us;
		$response->uteroMioma->volumeInterino = $r->uteroMioma->volumeInterino;
		$response->uteroMioma->ovarioDireito = $r->uteroMioma->ovarioDireito;
		$response->uteroMioma->ovarioEsquerdo = $r->uteroMioma->ovarioEsquerdo;
		$response->uteroMioma->endometro = $r->uteroMioma->endometro;
		$response->uteroMioma->miomaQuantidade = $r->uteroMioma->miomaQuantidade;
		$response->uteroMioma->mioma_1_caracteristicas = $r->uteroMioma->mioma_1_caracteristicas;
		$response->uteroMioma->mioma_1_submucoso = $r->uteroMioma->mioma_1_submucoso;
		$response->uteroMioma->mioma_1_subseroso = $r->uteroMioma->mioma_1_subseroso;
		$response->uteroMioma->mioma_1_intramural = $r->uteroMioma->mioma_1_intramural;
		$response->uteroMioma->mioma_2_caracteristicas = $r->uteroMioma->mioma_2_caracteristicas;
		$response->uteroMioma->mioma_2_submucoso = $r->uteroMioma->mioma_2_submucoso;
		$response->uteroMioma->mioma_2_subseroso = $r->uteroMioma->mioma_2_subseroso;
		$response->uteroMioma->mioma_2_intramural = $r->uteroMioma->mioma_2_intramural;
		$response->uteroMioma->nd = $r->uteroMioma->nd;

		// Realiza push de todos os itens da consulta
		$response->pushAll($c);

		// Print JSON
		print_r($response->toJSON());
	}

} catch (Exception $e) {
	echo $e->getMessage(), "\n";
}
