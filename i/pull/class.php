<?php

class Teste
{
	private $value = 5;

	public function setValue($a)
	{
		$this->value = $a;
	}

	public function getValue()
	{
		return $this->value;
	}
}

$obj = new Teste();