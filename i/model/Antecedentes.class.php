<?php

/**
 * Magma Scientific Model (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

class Antecedentes extends ConsultaThing {
	public $situacaoAborto;
	public $situacaoGestacao;
	public $situacaoParidade;
	public $tabagismo;
	public $hac;
	public $hacType;
	public $diabetes;
	public $diabetesType;
	public $hipotireoidismo;
	public $hipotireoidismoType;
	public $note;

	public function fill($a)
	{
		$this->_id = $a['_id'];
		$this->situacaoAborto = $a['situacaoAborto'];
		$this->situacaoGestacao = $a['situacaoGestacao'];
		$this->situacaoParidade = $a['situacaoParidade'];
		$this->tabagismo = $a['tabagismo'];
		$this->hac = $a['hac'];
		$this->hacType = $a['hacType'];
		$this->diabetes = $a['diabetes'];
		$this->diabetesType = $a['diabetesType'];
		$this->hipotireoidismo = $a['hipotireoidismo'];
		$this->hipotireoidismoType = $a['hipotireoidismoType'];
		$this->note = $a['note'];
	}
}