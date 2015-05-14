<?php

/**
 * Magma Scientific Push Server v1.6.0 (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

header('Content-Type: application/json; charset=UTF-8;');
require_once('../../var/connection.php');

class Paciente
{

	public $_id;
	public $nome;
	public $sexo;
	public $nascimento;
	public $religiao;
	public $religiaoNote;
	public $etnia;
	public $etniaNote;
	public $escolaridade;
	public $escolaridadeNote;
	public $estadoCivil;
	public $timestamp;

	public function __construct($a) {
		$this->_id = $a;
		$this->nome = $a;
		$this->sexo = $a;
		$this->nascimento = $a;
		$this->religiao = $a;
		$this->religiaoNote = $a;
		$this->etnia = $a;
		$this->etniaNote = $a;
		$this->escolaridade = $a;
		$this->escolaridadeNote = $a;
		$this->estadoCivil = $a;
		$this->timestamp = $a;
	}

}

class Response
{

	public $request;
	private $requestJSON;
	public $paciente;
	public $prontuario;
	public $consulta;

	public function __construct($a)
	{
		$this->setRequestJSON($a);
		$this->setRequest(json_decode($this->getRequestJSON()));
	}

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
	 * @param mixed $a
	 * @param mysqli $c
	 */
	public function setPaciente($a, $c)
	{
		if (!$c->query("INSERT INTO paciente(
			nome,
		    sexo,
		    nascimento,
		    religiao,
		    religiaoNote,
		    etnia,
		    etniaNote,
		    escolaridade,
		    escolaridadeNote,
		    estadoCivil,
		    estadoCivilNote) VALUES ('" .
				$a->nome . "', '" .
				$a->sexo . "', '" .
				$a->nascimento . "', '" .
				$a->religiao . "', '" .
				$a->religiaoNote . "', '" .
				$a->etnia . "', '" .
				$a->etniaNote . "', '" .
				$a->escolaridade . "', '" .
				$a->escolaridadeNote . "', '" .
				$a->estadoCivil . "', '" .
				$a->estadoCivilNote . "')"))
			echo "Insert failed(paciente): (" . $c->errno . ") " . $c->error . "/n";

		$this->paciente = $c->insert_id;

		//echo("paciente_id: " . $this->paciente . "/n");
	}

	/**
	 * @return mixed
	 */
	public function getProntuario()
	{
		return $this->prontuario;
	}

	/**
	 * @param mixed $a
	 * @param mysqli $c
	 */
	public function setProntuario($a, $c)
	{
		if (!$c->query("INSERT INTO prontuario(data, registro, paciente_id) VALUES ('" .
			$a->data . "', '" .
			$a->registro . "', '" .
			$this->getPaciente() . "')"))
			echo "Insert failed(prontuario): (" . $c->errno . ") " . $c->error . "/n";

		$this->prontuario = $c->insert_id;

		//echo("prontuario_id: " . $this->prontuario . "/n");
	}

	/**
	 * @return mixed
	 */
	public function getConsulta()
	{
		return $this->consulta;
	}

	/**
	 * @param mixed $a
	 * @param mysqli $c
	 */
	public function setConsulta($a, $c)
	{
		if (!$c->query("INSERT INTO consulta(data, prontuario_id) VALUES ('" .
			$a->data . "', '" .
			$this->getProntuario() . "')"))
			echo "Insert failed(consulta): (" . $c->errno . ") " . $c->error . "/n";

		$this->consulta = $c->insert_id;

		echo("consulta_id: " . $this->consulta . "/n");
	}

	public function toArray()
	{
		return (array) $this;
	}

	public function toJSON()
	{
		return json_encode($this);
	}

	public function get()
	{
		return $this;
	}

}

$string = '{"prontuario":{"_id":false,"data":"2015-05-14"},"paciente":{"nome":"Eduardo Barros","sexo":"Masculino","nascimento":"1992-11-26","religiao":"Outro","religiaoNote":"Agnóstico","etnia":"Branco","etniaNote":false,"escolaridade":"Superior","escolaridadeNote":false,"estadoCivil":"Solteiro(a)","estadoCivilNote":false}}';
$string2 = '{"prontuario":{"_id":false,"data":"2015-05-14"},"paciente":{"nome":"Eduardo Barros","sexo":"Masculino","nascimento":"1992-11-26","religiao":"Outro","religiaoNote":"Agnóstico","etnia":"Branco","etniaNote":false,"escolaridade":"Superior","escolaridadeNote":false,"estadoCivil":"Solteiro(a)","estadoCivilNote":false},"exameFisico":{"peso":"66","altura":"66","imc":"66","pressaoArterial":"666","circunferenciaAbdominal":"666","circunferenciaCervical":"666"},"antecedentes":{"situacaoAborto":false,"situacaoGestacao":false,"situacaoParidade":false,"tabagismo":false,"hac":false,"hacType":false,"diabetes":false,"diabetesType":false,"hipotireoidismo":false,"hipotireoidismoType":false,"note":false},"uteroMioma":{"us":false,"volumeInterino":false,"ovarioDireito":false,"ovarioEsquerdo":false,"endometro":false,"miomaQuantidade":false,"mioma_1_caracteristicas":false,"mioma_1_submucoso":false,"mioma_1_subseroso":false,"mioma_1_intramural":false,"mioma_2_caracteristicas":false,"mioma_2_submucoso":false,"mioma_2_subseroso":false,"mioma_2_intramural":false,"nd":false},"sangramento":{"pbacInicial":false},"escalas":{"beckInicial":false,"vidaMioma":false},"exames":{"hb":false,"ht":false,"ferro":false,"ferritina":false,"rdw":false,"vcm":false,"vitaminaD3":false,"tsh":false,"gj":false,"ct":false,"ldl":false,"hdl":false,"t4l":false},"conduta":{"conduta":false,"cirurgia":false,"hormonioTerapia":false,"hormonioTerapiaCiclico":false,"hormonioTerapiaContinuo":false,"hormonioTerapiaNome":false,"ainh":false},"resultados":{"pbacFinal":false,"beckFinal":false,"vidaMioma":false}}';

/*$a = new Response($string2);*/
if (!empty($_POST['response'])) {
	$a = new Response($_POST['response']);
	$b = $a->getRequest();

	$c = new Connection();
	$conn = $c->getConnection();

	if (!$b->prontuario->_id) {
		$a->setPaciente($b->paciente, $conn);
		$a->setProntuario($b->prontuario, $conn);
	}

	$test = (array) $a->getRequest()->paciente;
} else {
	$a = new Response('{}');
}

print_r($a->toJSON());

/*
for ($i = count($test), $key = array_keys($test); $i--; )
	if(!empty($test[$key[$i]]))
		echo $test[$key[$i]];
	else
		echo '___!' . $key[$i] . '!___';
*/

/*
$res = $conn->query("SELECT _id FROM paciente");

echo "Reverse order:/n";
for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
	$res->data_seek($row_no);
	$row = $res->fetch_assoc();
	echo $row['_id'] . "/n";
}
*/