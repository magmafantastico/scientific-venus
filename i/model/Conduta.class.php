<?php

/**
 * Magma Scientific Model (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

class Conduta extends ConsultaThing {
	public $conduta;
	public $cirurgia;
	public $hormonioTerapia;
	public $hormonioTerapiaAINH;
	public $hormonioTerapiaCiclico;
	public $hormonioTerapiaContinuo;
	public $hormonioTerapiaNome;
	public $ainh;

	public function fill($a)
	{
		$this->conduta = $a['conduta'];
		$this->cirurgia = $a['cirurgia'];
		$this->hormonioTerapia = $a['hormonioTerapia'];
		$this->hormonioTerapiaAINH = $a['hormonioTerapiaAINH'];
		$this->hormonioTerapiaCiclico = $a['hormonioTerapiaCiclico'];
		$this->hormonioTerapiaContinuo = $a['hormonioTerapiaContinuo'];
		$this->hormonioTerapiaNome = $a['hormonioTerapiaNome'];
		$this->ainh = $a['ainh'];
	}
}