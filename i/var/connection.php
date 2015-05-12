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
		$this->connection = new mysqli($this->_HOSTNAME, $this->_USER, $this->_PASSWD, $this->_SCHEMA);
	}

	public function getConnection() {
		return $this->connection;
	}

}