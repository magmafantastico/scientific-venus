<?php

/**
 * Magma Scientific Connection Server v1.5.0 (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

class Connection
{

	public $connection;

	private $_HOSTNAME = "localhost";

	/**
	 * BLUEHOST REMOTE
	 */

	/*private $_USER = "empreen1_magma";
	private $_PASSWD = "o6NRAoNk@0[!bV";
	private $_SCHEMA = "empreen1_scientific_venus";*/

	/**
	 * BLUEHOST REMOTE LOG
	 */

	/*private $_USER = "empreen1_magma";
	private $_PASSWD = "o6NRAoNk@0[!bV";
	private $_SCHEMA = "empreen1_scientific_venus_log";*/

	/**
	 * BLUEHOST REMOTE TEST
	 */

	/*private $_USER = "empreen1_magma";
	private $_PASSWD = "o6NRAoNk@0[!bV";
	private $_SCHEMA = "empreen1_scientific_venus_remote";*/

	/**
	 * HOME
	 */

	private $_USER = "root";
	private $_PASSWD = "sux";
	private $_SCHEMA = "scientific_venus";

	public function __construct() {

		$conn = new mysqli($this->_HOSTNAME, $this->_USER, $this->_PASSWD, $this->_SCHEMA);

		if ($conn->connect_errno)
			echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
		else
			if (!$conn->query("SET time_zone = '-06:00';"))
				echo "time_zone not setted: (" . $conn->errno . ") " . $conn->error . "/n";
			else
				$this->connection = $conn;

	}

	public function getConnection() {
		return $this->connection;
	}

}