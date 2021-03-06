<?php

/**
 * Magma Scientific Pull Server v1.1.0 (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

header('Content-Type: application/json; charset=UTF-8;');
require_once('../var/connection.php');
require_once('../model/Model.php');
require_once('../model/Thing.class.php');
require_once('../model/Paciente.class.php');
require_once('../model/Prontuario.class.php');
require_once('../model/Consulta.class.php');
require_once('../model/ConsultaThing.class.php');
require_once('../model/Antecedentes.class.php');
require_once('../model/Conduta.class.php');
require_once('../model/Escalas.class.php');
require_once('../model/ExameFisico.class.php');
require_once('../model/Exames.class.php');
require_once('../model/Resultados.class.php');
require_once('../model/Ultrassom.class.php');
require_once('../model/Mioma.class.php');
require_once('../model/Pull.php');

$connection = new Connection();
$c = $connection->getConnection();

$p = new Paciente();

$p->setQueryName('_id');

// temporariamente, isso está usando o id do prontuário
$p->setQueryValue($_GET['prontuario_id']);

if ($r = $p->pull($c)) {

	$a = array();
	for ($i = $r->num_rows; $i--; ) {
		$pull = new Pull($r, $c);
		array_push($a, $pull);
	}
	print_r(json_encode($a));
	//print_r($a);
}

