<?php

/**
 * Magma Scientific Model v0.4.0 (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

class Log extends Thing {

	public $agent;
	public $time;
	public $timezone;
	public $ip;

	function __construct()
	{
		$this->setIP();
		$this->setQuery();
	}

	public function setIP()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$this->ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$this->ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$this->ip = $_SERVER['REMOTE_ADDR'];
		}
	}

	public function fill($a)
	{
		$this->_id = $a['_id'];
		$this->agent = $a['agent'];
		$this->time = $a['time'];
		$this->timezone = $a['timezone'];
	}

	public function setQuery()
	{
		$this->setQueryLimit(0);
	}

}