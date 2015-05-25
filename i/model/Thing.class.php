<?php

/**
 * Magma Scientific Model v0.4.0 (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

class Thing
{

	public $_id;

	private $queryName;
	private $queryLimit = 10;
	private $queryValue;

	/**
	 * Constrói string sql para utilizar na query do push
	 * @return string
	 */
	private function buildInsertQuery()
	{
		$ok = array();      // object key
		$ov = array();      // object value

		foreach ($this as $key => $value)
			if ($key != '_id') {
				array_push($ok, $key);
				array_push($ov, '"' . $value . '"');
			}

		$n = ' ' . lcfirst(get_class($this)) . ' ';     // table name
		$k = '(';                                       // key content
		$v = '(';                                       // value content

		for ($i = count($ok); $i--; ) {
			$s = ',';
			if ($i < 1) $s = ') ';
			$k .= $ok[$i] . $s;
			$v .= $ov[$i] . $s;
		}

		return 'INSERT INTO' . $n . $k . 'VALUES ' . $v;
	}

	/**
	 * Constrói string sql para utilizar na query do pull
	 * @return bool|string
	 */
	private function buildSelectQuery()
	{
		$qn = $this->getQueryName();        // query name (column name)
		$ql = $this->getQueryLimit();       // query limit
		$qv = $this->getQueryValue();       // query value

		$n = ' ' . lcfirst(get_class($this)) . ' ';     // table name
		$k = '*';                                       // key content

		$sql = 'SELECT ' . $k . ' FROM ' . $n;

		if (!empty($qn)) {
			$cl = ' WHERE ';        // WHERE clause

			// test if value exists to build the WHERE LIKE clause
			if (!empty($qv))
				$cl .= $qn . ' LIKE "%' . $qv . '%"';
			else $cl = '';

			// concat full query
			return  $sql . $cl . ' LIMIT ' . $ql;
		}

		return $sql . ' LIMIT ' . $ql;
	}

	/**
	 * Executa push utilizando a conexão e a string construída
	 * @param mysqli $c
	 */
	public function push($c)
	{
		if($c->query($this->buildInsertQuery())) $this->setId($c->insert_id);
		else echo $c->error;
	}

	/**
	 * Executa pull utilizando a conexão e a string construída
	 * @param mysqli $c
	 * @return bool|mysqli_result
	 */
	public function pull($c)
	{
		$q = $this->buildSelectQuery();
		if ($q)
			if($r = $c->query($q))
				return $r;
	}

	/**
	 * @param array $a
	 */
	public function fill($a) { }

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->_id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id)
	{
		$this->_id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getQueryName()
	{
		return $this->queryName;
	}

	/**
	 * @param mixed $queryName
	 */
	public function setQueryName($queryName)
	{
		$this->queryName = $queryName;
	}

	/**
	 * @return int
	 */
	public function getQueryLimit()
	{
		return $this->queryLimit;
	}

	/**
	 * @param int $queryLimit
	 */
	public function setQueryLimit($queryLimit)
	{
		$this->queryLimit = $queryLimit;
	}

	/**
	 * @return mixed
	 */
	public function getQueryValue()
	{
		return $this->queryValue;
	}

	/**
	 * @param mixed $queryValue
	 */
	public function setQueryValue($queryValue)
	{
		$this->queryValue = $queryValue;
	}

	/**
	 * @return string
	 */
	public function toJSON()
	{
		return json_encode($this);
	}

}