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
require_once('../model/Response.php');

/**
 * Class Pull (receive paciente)
 */
class Pull extends Model {

	public function __construct($r)
	{
		$this->paciente = new Paciente();
		$this->paciente->fill($r);

		print_r($this->paciente);
	}

}

$connection = new Connection();
$c = $connection->getConnection();

$p = new Paciente();
$p->setQueryName('nome');
$p->setQueryValue('jo');

if ($r = $p->pull($c)) {
	$a = array();
	for ($i = $r->num_rows; $i--; ) {
		$pull = new Pull(mysqli_fetch_assoc($r));
		array_push($a, $pull);
	}
	//print_r($a);
}