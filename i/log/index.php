<?php

/**
 * Magma Scientific Log Server v1.0.0 (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

header('Content-Type: application/json; charset=UTF-8;');
require_once('../var/connection.php');
require_once('../model/ModelLog.php');
require_once('../model/PushLog.php');
require_once('../model/Thing.class.php');
require_once('../model/Log.php');

function __autoload($name) {
	echo "Want to load $name.\n";
	throw new Exception("Unable to load $name.");
}

try {

	$connection = new Connection();

	if ($_POST['log']) {

		$a = $_POST['log'];

		// init log
		$push = new PushLog($a, $connection->getConnection());

		// print JSON
		print_r($push->toJSON());

	}

} catch (Exception $e) {
	echo $e->getMessage(), "\n";
}