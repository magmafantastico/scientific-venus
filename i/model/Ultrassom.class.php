<?php

/**
 * Magma Scientific Model (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

class Ultrassom extends ConsultaThing {
	public $volumeUterino;
	public $ovarioDireito;
	public $ovarioEsquerdo;
	public $data;
	public $endometro;

	public function fill($a)
	{
		$this->_id = $a['_id'];
		$this->volumeUterino = $a['volumeUterino'];
		$this->ovarioDireito = $a['ovarioDireito'];
		$this->ovarioEsquerdo = $a['ovarioEsquerdo'];
		$this->data= $a['data'];
		$this->endometro = $a['endometro'];
	}
}