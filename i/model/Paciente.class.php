<?php

/**
 * Magma Scientific Model (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

class Paciente extends Thing {
	public $nome;
	public $sexo;
	public $nascimento;
	public $religiao;
	public $religiaoNote;
	public $etnia;
	public $etniaNote;
	public $escolaridade;
	public $escolaridadeNote;
	public $estadoCivil;
	public $estadoCivilNote;

	public function fill($a)
	{
		$this->_id = $a['_id'];
		$this->nome = $a['nome'];
		$this->sexo = $a['sexo'];
		$this->nascimento = $a['nascimento'];
		$this->religiao = $a['religiao'];
		$this->religiaoNote = $a['religiaoNote'];
		$this->etnia = $a['etnia'];
		$this->etniaNote = $a['etniaNote'];
		$this->escolaridade = $a['escolaridade'];
		$this->escolaridadeNote = $a['escolaridadeNote'];
		$this->estadoCivil = $a['estadoCivil'];
		$this->estadoCivilNote = $a['estadoCivilNote'];
	}
}