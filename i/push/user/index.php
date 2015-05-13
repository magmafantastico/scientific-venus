<?php

/**
 * Magma Scientific Push Server v1.1.1 (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

header('Content-Type: application/json');
require_once('../../var/connection.php');

class A
{

	private $name;
	private $value;
	
	public function __construct($a, $b)
	{
		$this->setName($a);
		$this->setValue($b);
	}

	/**
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * @param mixed $value
	 */
	public function setValue($value)
	{
		$this->value = $value;
	}

}

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

	private $request;
	public $requestJSON;
	private $paciente;
	private $prontuario;
	private $consulta;

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
		if (!$c->query("INSERT INTO prontuario(data, paciente_id) VALUES ('" .
			$a->data . "', '" .
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

		//echo("consulta_id: " . $this->consulta . "/n");
	}

}

$string = '{"prontuario":{"_id":false,"data":"2015-05-14"},"paciente":{"nome":"Eduardo Barros","sexo":"Masculino","nascimento":"1992-11-26","religiao":"Outro","religiaoNote":"Agnóstico","etnia":"Branco","etniaNote":false,"escolaridade":"Superior","escolaridadeNote":false,"estadoCivil":"Solteiro(a)","estadoCivilNote":false}}';

$a = new Response($string);
$b = $a->getRequest();

$c = new Connection();
$conn = $c->getConnection();

print_r($a->getRequest());

$a->setPaciente($b->paciente, $conn);
$a->setProntuario($b->prontuario, $conn);
$a->setConsulta($b->prontuario, $conn);

$res = $conn->query("SELECT _id FROM paciente");

echo "Reverse order:/n";
for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
	$res->data_seek($row_no);
	$row = $res->fetch_assoc();
	echo $row['_id'] . "/n";
}