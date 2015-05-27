<?php

/**
 * Magma Scientific Push Server v1.9.5 (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

header('Content-Type: application/json; charset=UTF-8;');
require_once('../../var/connection.php');
require_once('../../model/Thing.class.php');
require_once('../../model/Model.php');
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
require_once('../../model/Ultrassom.class.php');
require_once('../../model/Mioma.class.php');
require_once('../../model/Push.php');
require_once('../../model/PushConsulta.php');

function __autoload($name) {
	echo "Want to load $name.\n";
	throw new Exception("Unable to load $name.");
}

try {

	$connection = new Connection();

	if ($_COOKIE['response']) {

		$a = $_COOKIE['response'];

		// init push
		$push = new PushConsulta($a, $connection->getConnection());

		// print JSON
		print_r($push->toJSON());

	}

} catch (Exception $e) {
	echo $e->getMessage(), "\n";
}
