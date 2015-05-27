<?php

/**
 * Magma Scientific Model (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

class PushConsulta extends Push {

	/**
	 * @param mysqli $c
	 */
	public function pushAll($c)
	{

		$this->paciente = new Paciente();
		$this->paciente->fill((array) $this->getRequest()->paciente);

		$this->prontuario = new Prontuario($this->paciente->_id);
		$this->prontuario->fill((array) $this->getRequest()->prontuario);

		if (!empty($this->prontuario->_id)) {
			$this->setConsulta($c);

			$this->setAntecedentes($c);
			$this->setConduta($c);
			$this->setEscalas($c);
			$this->setExameFisico($c);
			$this->setExames($c);
			$this->setMioma($c);
			$this->setResultados($c);
			$this->setUltrassom($c);
		}

	}

}