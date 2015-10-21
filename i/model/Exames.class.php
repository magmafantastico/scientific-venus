<?php

/**
 * Magma Scientific Model (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

class Exames extends ConsultaThing {
	public $hb;
	public $ht;
	public $vcm;
	public $rdw;
	public $ferro;
	public $ferritina;
	public $vitaminaD3;
	public $gj;
	public $ct;
	public $ldl;
	public $hdl;
	public $tsh;
	public $t4l;
	public $tgl;
	public $colo;
	public $lombar;

	public function fill($a)
	{
		$this->_id = $a['_id'];
		$this->hb = $a['hb'];
		$this->ht = $a['ht'];
		$this->vcm = $a['vcm'];
		$this->rdw = $a['rdw'];
		$this->ferro = $a['ferro'];
		$this->ferritina = $a['ferritina'];
		$this->vitaminaD3 = $a['vitaminaD3'];
		$this->gj = $a['gj'];
		$this->ct = $a['ct'];
		$this->ldl = $a['ldl'];
		$this->hdl = $a['hdl'];
		$this->tsh = $a['tsh'];
		$this->t4l = $a['t4l'];
		$this->tgl = $a['tgl'];
		$this->colo = $a['colo'];
		$this->lombar = $a['lombar'];
	}
}