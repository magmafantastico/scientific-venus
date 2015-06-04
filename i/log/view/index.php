<?php

/**
 * Magma Scientific Pull Server v1.1.0 (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

header('Content-Type: application/json; charset=UTF-8;');
require_once('../../var/connection.php');
require_once('../../model/ModelLog.php');
require_once('../../model/PullLog.php');
require_once('../../model/Thing.class.php');
require_once('../../model/Log.php');

function __autoload($name) {
	echo "Want to load $name.\n";
	throw new Exception("Unable to load $name.");
}

try {

	$connection = new Connection();
	$c = $connection->getConnection();

	$l = new Log();

	if ($r = $l->pull($c)) {
		$a = array();

		for ($i = $r->num_rows; $i--; ) {
			$pull = new PullLog($r, $c);
			array_push($a, $pull);
		}
		print_r(json_encode($a));
		//print_r($a);
	}


} catch (Exception $e) {
	echo $e->getMessage(), "\n";
}