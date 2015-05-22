<?php

/**
 * Magma Scientific Push Server v1.9.0 (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

header('Content-Type: application/json; charset=UTF-8;');
require_once('../var/connection.php');
require_once('../model/Thing.class.php');
require_once('../model/Paciente.class.php');
require_once('../model/Prontuario.class.php');
require_once('../model/ConsultaThing.class.php');
require_once('../model/Consulta.class.php');
require_once('../model/Antecedentes.class.php');
require_once('../model/Conduta.class.php');
require_once('../model/Escalas.class.php');
require_once('../model/ExameFisico.class.php');
require_once('../model/Exames.class.php');
require_once('../model/Resultados.class.php');
require_once('../model/ultrassom.class.php');
require_once('../model/Response.php');

function __autoload($name) {
	echo "Want to load $name.\n";
	throw new Exception("Unable to load $name.");
}

try {

	$connection = new Connection();
	$c = $connection->getConnection();

	if ($_POST['response']) {

		$a = $_POST['response'];

		// Preenche consulta
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

				// Testa _id de prontuario
				if ($response->prontuario->_id) {

					// Cria consulta
					$response->consulta = new Consulta($response->prontuario->_id);

					$response->consulta->data = $r->prontuario->data;
					$response->consulta->push($c);

					// Preenche itens da consulta
					$response->createAll($response->consulta->_id);

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

					$response->escalas->pbacInicial = $r->escalas->pbacInicial;
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
					$response->exames->vcm = $r->exames->vcm;
					$response->exames->rdw = $r->exames->rdw;
					$response->exames->ferro = $r->exames->ferro;
					$response->exames->ferritina = $r->exames->ferritina;
					$response->exames->vitaminaD3 = $r->exames->vitaminaD3;
					$response->exames->gj = $r->exames->gj;
					$response->exames->ct = $r->exames->ct;
					$response->exames->ldl = $r->exames->ldl;
					$response->exames->hdl = $r->exames->hdl;
					$response->exames->tsh = $r->exames->tsh;
					$response->exames->t4l = $r->exames->t4l;

					$response->resultados->pbacFinal = $r->resultados->pbacFinal;
					$response->resultados->beckFinal = $r->resultados->beckFinal;
					$response->resultados->vidaMioma = $r->resultados->vidaMioma;

					$response->ultrassom->volumeInterino = $r->ultrassom->volumeInterino;
					$response->ultrassom->ovarioDireito = $r->ultrassom->ovarioDireito;
					$response->ultrassom->ovarioEsquerdo = $r->ultrassom->ovarioEsquerdo;
					$response->ultrassom->endometro = $r->ultrassom->endometro;
					$response->ultrassom->nd = $r->ultrassom->nd;

					// Realiza push de todos os itens da consulta
					$response->pushAll($c);
				}
			}

		}

		// Print JSON
		print_r($response->toJSON());

	}

} catch (Exception $e) {
	echo $e->getMessage(), "\n";
}
