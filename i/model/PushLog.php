<?php

/**
 * Magma Scientific Model (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

class PushLog extends ModelLog {

	private $request;
	private $requestJSON;

	/**
	 * @param $a
	 * @param mysqli $c
	 */
	public function __construct($a, $c)
	{
		$this->setRequestJSON($a);
		$this->setRequest(json_decode($this->getRequestJSON()));

		$this->pushAll($c);
	}

	/**
	 * @param mysqli $c
	 */
	public function pushAll($c)
	{
		$this->setLog($c);
	}

	/**
	 * @param $c
	 */
	public function setLog($c)
	{
		$this->log = new Log();
		$this->log->fill((array) $this->getRequest());
		$this->log->push($c);
	}

	/**
	 * @return mixed
	 */
	public function getRequest()
	{
		return $this->request;
	}

	/**
	 * @param mixed $request
	 */
	public function setRequest($request)
	{
		$this->request = $request;
	}

	/**
	 * @return mixed
	 */
	public function getRequestJSON()
	{
		return $this->requestJSON;
	}

	/**
	 * @param mixed $requestJSON
	 */
	public function setRequestJSON($requestJSON)
	{
		$this->requestJSON = $requestJSON;
	}

	/**
	 * @return mixed
	 */
	public function getLog()
	{
		return $this->log;
	}

}