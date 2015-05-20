<?php

/**
 * Magma Scientific Model v0.4.0 (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

class Thing
{

	public $_id;

	/**
	 * Constrói string sql para utilizar na query do push
	 * @return string
	 */
	private function buildQuery()
	{
		$ok = array();
		$ov = array();

		foreach ($this as $key => $value)
			if ($key != '_id') {
				array_push($ok, $key);
				array_push($ov, '"' . $value . '"');
			}

		$n = ' ' . lcfirst(get_class($this)) . ' ';
		$k = '(';
		$v = '(';

		for ($i = count($ok); $i--; ) {
			$s = ',';
			if ($i < 1) $s = ') ';
			$k .= $ok[$i] . $s;
			$v .= $ov[$i] . $s;
		}

		return 'INSERT INTO' . $n . $k . 'VALUES ' . $v;
	}

	/**
	 * Executa push utilizando a conexão e a string construída
	 * @param mysqli $c
	 */
	public function push($c)
	{
		if($c->query($this->buildQuery())) $this->setId($c->insert_id);
		else echo $c->error;
	}

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
	 * @return string
	 */
	public function toJSON()
	{
		return json_encode($this);
	}

}