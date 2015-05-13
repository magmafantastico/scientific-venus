<?php

class Connection
{

	public $connection;

	/**
	 * BLUEHOST REMOTE
	 */

	/*private $_HOSTNAME = "localhost";
	private $_USER = "empreen1_magma";
	private $_PASSWD = "o6NRAoNk@0[!bV";
	private $_SCHEMA = "empreen1_scientific_venus";*/


	/**
	 * HOME
	 */

	private $_HOSTNAME = "localhost";
	private $_USER = "root";
	private $_PASSWD = "sux";
	private $_SCHEMA = "scientific_venus";

	public function __construct() {

		$conn = new mysqli($this->_HOSTNAME, $this->_USER, $this->_PASSWD, $this->_SCHEMA);

		if ($conn->connect_errno)
			echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
		else
			if (!$conn->query("SET @@session.time_zone = '+00:00';"))
				echo "time_zone not setted: (" . $conn->errno . ") " . $conn->error . "/n";
			else
				$this->connection = $conn;

	}

	public function getConnection() {
		return $this->connection;
	}

}