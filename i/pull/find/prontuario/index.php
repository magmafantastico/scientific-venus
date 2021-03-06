<?php

/**
 * Magma Scientific Search Server v0.1.0 (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

header('Content-Type: application/json; charset=UTF-8;');
require_once('../../../var/connection.php');

class Prontuario_Search
{

	public $prontario;

	/**
	 * @return int
	 */
	public function getProntario()
	{
		return $this->prontario;
	}

	/**
	 * @param int $prontario
	 */
	public function setProntario($prontario)
	{
		$this->prontario = $prontario;
	}

	/**
	 * @param mixed $a
	 * @param mysqli $c
	 * @return bool|int
	 */
	public function findProntuario($a, $c)
	{
		$res = $c->query("SELECT _id FROM paciente where _id = " . $a);

		if ($res->num_rows)
			return $res->num_rows;
		else
			return false;
	}

}

if (!empty($_GET['response'])) {
	$s = $_GET['response'];
	$a = new Prontuario_Search($s);
	$c = new Connection();
	$conn = $c->getConnection();

	$a->setProntario($a->findProntuario($a->request->prontuario->_id, $conn));
} else {
	$s = '{}';
}

print_r($a->toJSON());