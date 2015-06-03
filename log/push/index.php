<?php

/**
 * Magma Scientific Push Server v1.9.5 (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

header('Content-Type: application/json; charset=UTF-8;');
require_once('../var/connection.php');
require_once('../../i/model/Thing.class.php');
require_once('../../i/model/Model.php');
require_once('../../i/model/Paciente.class.php');
require_once('../../i/model/Prontuario.class.php');
require_once('../../i/model/ConsultaThing.class.php');
require_once('../../i/model/Consulta.class.php');
require_once('../../i/model/Antecedentes.class.php');
require_once('../../i/model/Conduta.class.php');
require_once('../../i/model/Escalas.class.php');
require_once('../../i/model/ExameFisico.class.php');
require_once('../../i/model/Exames.class.php');
require_once('../../i/model/Resultados.class.php');
require_once('../../i/model/Ultrassom.class.php');
require_once('../../i/model/Mioma.class.php');
require_once('../../i/model/Push.php');

function __autoload($name) {
	echo "Want to load $name.\n";
	throw new Exception("Unable to load $name.");
}

try {

	$connection = new Connection();

	if ($_COOKIE['response']) {

		$a = $_COOKIE['response'];

		// init push
		$push = new Push($a, $connection->getConnection());

		// print JSON
		print_r($push->toJSON());

	}

} catch (Exception $e) {
	echo $e->getMessage(), "\n";
}
