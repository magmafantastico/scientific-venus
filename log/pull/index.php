<?php

/**
 * Magma Scientific Pull Server v1.1.0 (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

header('Content-Type: application/json; charset=UTF-8;');
require_once('../var/connection.php');
require_once('../../i/model/Model.php');
require_once('../../i/model/Thing.class.php');
require_once('../../i/model/Paciente.class.php');
require_once('../../i/model/Prontuario.class.php');
require_once('../../i/model/Consulta.class.php');
require_once('../../i/model/ConsultaThing.class.php');
require_once('../../i/model/Antecedentes.class.php');
require_once('../../i/model/Conduta.class.php');
require_once('../../i/model/Escalas.class.php');
require_once('../../i/model/ExameFisico.class.php');
require_once('../../i/model/Exames.class.php');
require_once('../../i/model/Resultados.class.php');
require_once('../../i/model/Ultrassom.class.php');
require_once('../../i/model/Mioma.class.php');
require_once('../../i/model/Pull.php');

$connection = new Connection();
$c = $connection->getConnection();

$p = new Paciente();
//$p->setQueryName('nome');
//$p->setQueryValue('jo');

if ($r = $p->pull($c)) {
	$a = array();
	for ($i = $r->num_rows; $i--; ) {
		$pull = new Pull($r, $c);
		array_push($a, $pull);
	}
	print_r(json_encode($a));
	//print_r($a);
}