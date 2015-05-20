<?php

/**
 * Magma Scientific Push Server v1.8.0 (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

header('Content-Type: application/json; charset=UTF-8;');
require_once('../../var/connection.php');
require_once('../../model/Thing.class.php');
require_once('../../model/Paciente.class.php');
require_once('../../model/Prontuario.class.php');
require_once('../../model/Response.php');

function __autoload($name) {
	echo "Want to load $name.\n";
	throw new Exception("Unable to load $name.");
}

try {

	$connection = new Connection();
	$c = $connection->getConnection();

	if ($_POST['response']) {

		$a = $_POST['response'];
		$response = new Response($a);

		$r = $response->getRequest();

		// Testa se existe prontuario
		if (!$r->prontuario->_id) {

			// Cria paciente
			$response->paciente = new Paciente();

			$response->paciente->nome = $r->paciente->nome;
			$response->paciente->sexo = $r->paciente->sexo;
			$response->paciente->nascimento = $r->paciente->nascimento;
			$response->paciente->religiao = $r->paciente->religiao;
			$response->paciente->religiaoNote = $r->paciente->religiaoNote;
			$response->paciente->etnia = $r->paciente->etnia;
			$response->paciente->etniaNote = $r->paciente->etniaNote;
			$response->paciente->escolaridade = $r->paciente->escolaridade;
			$response->paciente->escolaridadeNote = $r->paciente->escolaridadeNote;
			$response->paciente->estadoCivil = $r->paciente->estadoCivil;
			$response->paciente->estadoCivilNote = $r->paciente->estadoCivilNote;

			$response->paciente->push($c);

			// Testa _id de paciente
			if ($response->paciente->_id) {

				// Cria prontuario
				$response->prontuario = new Prontuario($response->paciente->_id);

				$response->prontuario->data = $r->prontuario->data;
				$response->prontuario->registro = $r->prontuario->registro;

				$response->prontuario->push($c);
			}

		}

		print_r($response->toJSON());

	} else {
		$response = new ResponseProntuario('{}');
	}

} catch (Exception $e) {
	echo $e->getMessage(), "\n";
}

//print_r($response->toJSON());