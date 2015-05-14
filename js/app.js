/*!
 * Magma Scientific Client v1.1.0 (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

if (typeof __API_DIR === 'undefined')
	var __API_DIR = '';

$('#btn').click(function() {

	$.ajax({
		data: {response: JSON.stringify(getResponse())},
		error: function(data) {
			console.log(data.responseText);
		},
		method: 'post',
		success: function(data) {
			console.log(data);
		},
		url: __API_DIR +  'i/push/'
	});
});

$('#prontuario_novo').click(function() {
	createProntuario();
});

$('#btn').click(function() {
	$.ajax({
		cache: false,
		dataType: 'json',
		error: function(data) {
			console.log(data.responseText);
		},
		success: function(data) {
			console.log(data);
		},
		url: __API_DIR +  'i/pull/'
	});
});

$('#prontuario_create').click(function() {
	createProntuario();
});

var createProntuario = function() {
	// TMP!!!!! REMOVE THIS AFTER TESTS
	document.getElementById('prontuario__id').value = '';

	$.ajax({
		cache: false,
		data: {response: JSON.stringify(getProntuario())},
		dataType: 'json',
		error: function(data) {
			console.log(data.responseText);
			return false;
		},
		method: 'post',
		success: function(data) {
			if (data.prontuario)
				renderProntuario(data);
			else
				return false;
		},
		url: __API_DIR +  'i/push/prontuario/'
	});
};

var renderProntuario = function(a) {
	var b, c, d, e, f;

	b = a.request;
	c = b.prontuario;
	d = b.paciente;
	e = document.getElementById('p_data');
	f = document.getElementById('prontuario__id');

	e.innerHTML = '';
	f.value = a.prontuario;

	$('#prontuario_edit').hide();

	insereNovoProntuario(e, c, 'prontuario');
	insereNovoPaciente(e, d, 'paciente');

	initConsulta();
};

var initConsulta = function() {
	$('#consulta').show();
};

var insereNovoPaciente = function(a, b) {
	var c = document.createElement('div');
	c.setAttribute('class', 'prontuario flex flex-column');

	var date = new Date(b.nascimento);
	date.setDate(date.getDate() + 1);
	var dateOptions = {
		day: 'numeric',
		month: 'long',
		year: 'numeric'
	};
	var dateString = date.toLocaleDateString('pt-BR', dateOptions);

	c.appendChild(newNode('span', b.nome, 'nome'));
	c.appendChild(newNode('span', b.sexo, 'sexo'));
	c.appendChild(newNode('span', dateString, 'nascimento'));
	c.appendChild(newNode('span', buildNote(b.religiao, b.religiaoNote), 'religiao'));
	c.appendChild(newNode('span', buildNote(b.etnia, b.etniaNote), 'etnia'));
	c.appendChild(newNode('span', buildNote(b.escolaridade, b.escolaridadeNote), 'escolaridade'));
	c.appendChild(newNode('span', buildNote(b.estadoCivil, b.estadoCivilNote), 'estadoCivil'));

	a.insertBefore(c, a.firstChild);
};

var insereNovoProntuario = function(a, b) {
	var c = document.createElement('div');
	c.setAttribute('class', 'prontuario flex flex-column');

	var date = new Date(b.data);
	date.setDate(date.getDate() + 1);
	var dateOptions = {
		day: 'numeric',
		month: 'long',
		year: 'numeric'
	};
	var dateString = date.toLocaleDateString('pt-BR', dateOptions);

	c.appendChild(newNode('span', dateString, 'data'));
	c.appendChild(newNode('span', b.registro, 'registro'));

	a.insertBefore(c, a.firstChild);
};

var newNode = function(a, b, c) {
	var e = document.createElement(a);

	if (c)
		e.setAttribute('class', c);

	if (b)
		if (typeof b === 'object')
			e.appendChild(b);
		else if (typeof b === 'string')
			e.appendChild(document.createTextNode(b));

	return e;
};

var buildNote = function(a, b) {
	if (b)
		return a + ' (' + b + ')';
	else
		return a;
};

var appendObject = function(a, b, g) {
	// get the object
	var c, d;

	c = Object.keys(b);
	d = c.length;

	// create new append
	var e, f;

	e = document.createElement('div');
	e.setAttribute('class', g);

	for (var i = 0; i < d; i++) {
		console.log(b[c[i]]);
		f = document.createElement('span');
		f.appendChild(document.createTextNode(b[c[i]]));
		f.setAttribute('class', g + '_' + c[i]);
		e.appendChild(f);
	}

	a.insertBefore(e, a.firstChild);
};

var findProntuario = function() {
	$.ajax({
		cache: false,
		data: {response: JSON.stringify(getProntuario())},
		dataType: 'json',
		error: function(data) {
			console.log(data.responseText);
		},
		method: 'get',
		success: function(data) {
			console.log((data));
		},
		url: __API_DIR +  'i/pull/find/prontuario/'
	});
};

var getProntuario = function() {
	return {

		prontuario: {
			_id: getTextField('prontuario__id'),
			registro: getTextField('prontuario_registro'),
			data: getPickDate($prontuario_data)
		},
		paciente: {
			nome: getTextField('paciente_nome'),
			sexo: getActiveRadio('paciente_sexo'),
			nascimento: getPickDate($paciente_nascimento),
			religiao: getActiveRadio('paciente_religiao'),
			religiaoNote: getTextField('paciente_religiao_note'),
			etnia: getActiveRadio('paciente_etnia'),
			etniaNote: getTextField('paciente_etnia_note'),
			escolaridade: getActiveRadio('paciente_escolaridade'),
			escolaridadeNote: getTextField('paciente_escolaridade_note'),
			estadoCivil: getActiveRadio('paciente_estadoCivil'),
			estadoCivilNote: getTextField('paciente_estadoCivil_note')
		}

	};
};

var getResponse;
getResponse = function () {
	return {

		prontuario: {
			_id: getTextField('prontuario__id'),
			registro: getTextField('prontuario_registro'),
			data: getPickDate($prontuario_data)
		},
		paciente: {
			nome: getTextField('paciente_nome'),
			sexo: getActiveRadio('paciente_sexo'),
			nascimento: getPickDate($paciente_nascimento),
			religiao: getActiveRadio('paciente_religiao'),
			religiaoNote: getTextField('paciente_religiao_note'),
			etnia: getActiveRadio('paciente_etnia'),
			etniaNote: getTextField('paciente_etnia_note'),
			escolaridade: getActiveRadio('paciente_escolaridade'),
			escolaridadeNote: getTextField('paciente_escolaridade_note'),
			estadoCivil: getActiveRadio('paciente_estadoCivil'),
			estadoCivilNote: getTextField('paciente_estadoCivil_note')
		},
		exameFisico: {
			peso: getTextField('exameFisico_peso'),
			altura: getTextField('exameFisico_altura'),
			imc: getTextField('exameFisico_imc'),
			pressaoArterial: getTextField('exameFisico_pressaoArterial'),
			circunferenciaAbdominal: getTextField('exameFisico_circunferenciaAbdominal'),
			circunferenciaCervical: getTextField('exameFisico_circunferenciaCervical')
		},
		antecedentes: {
			situacaoAborto: toBoolean(getActiveCheckbox('antecedentes_situacao_aborto', true)),
			situacaoGestacao: toBoolean(getActiveCheckbox('antecedentes_situacao_gestaçao', true)),
			situacaoParidade: toBoolean(getActiveCheckbox('antecedentes_situacao_paridade', true)),
			tabagismo: parseBoolean(getActiveRadio('antecedentes_tabagismo')),
			hac: parseBoolean(getActiveRadio('antecedentes_hac')),
			hacType: getActiveRadio('antecedentes_hac_type'),
			diabetes: parseBoolean(getActiveRadio('antecedentes_diabetes')),
			diabetesType: getActiveRadio('antecedentes_diabetes_type'),
			hipotireoidismo: parseBoolean(getActiveRadio('antecedentes_hipotireoidismo')),
			hipotireoidismoType: getActiveRadio('antecedentes_hipotireoidismo_type'),
			note: getTextField('antecedentes_note')
		},
		uteroMioma: {
			us: getTextField('uteroMioma_us'),
			volumeInterino: getTextField('uteroMioma_volumeInterino'),
			ovarioDireito: getTextField('uteroMioma_ovarioDireito'),
			ovarioEsquerdo: getTextField('uteroMioma_ovarioEsquerdo'),
			endometro: getTextField('uteroMioma_endometro'),
			miomaQuantidade: getTextField('uteroMioma_miomaQuantidade'),
			mioma_1_caracteristicas: getTextField('uteroMioma_mioma_1_caracteristicas'),
			mioma_1_submucoso: parseBoolean(getActiveCheckbox('uteroMioma_mioma_1_submucoso', true)),
			mioma_1_subseroso: parseBoolean(getActiveCheckbox('uteroMioma_mioma_1_subseroso', true)),
			mioma_1_intramural: parseBoolean(getActiveCheckbox('uteroMioma_mioma_1_intramural', true)),
			mioma_2_caracteristicas: getTextField('uteroMioma_mioma_2_caracteristicas'),
			mioma_2_submucoso: parseBoolean(getActiveCheckbox('uteroMioma_mioma_2_submucoso', true)),
			mioma_2_subseroso: parseBoolean(getActiveCheckbox('uteroMioma_mioma_2_subseroso', true)),
			mioma_2_intramural: parseBoolean(getActiveCheckbox('uteroMioma_mioma_2_intramural', true)),
			nd: getActiveCheckbox('uteroMioma_nd')
		},
		sangramento: {
			pbacInicial: getTextField('sangramento_pbacInicial')
		},
		escalas: {
			beckInicial: getTextField('escalas_beckInicial'),
			vidaMioma: getTextField('escalas_vidaMioma')
		},
		exames: {
			hb: getTextField('exames_hb'),
			ht: getTextField('exames_ht'),
			ferro: getTextField('exames_ferro'),
			ferritina: getTextField('exames_ferritina'),
			rdw: getTextField('exames_rdw'),
			vcm: getTextField('exames_vcm'),
			vitaminaD3: getTextField('exames_vitaminaD3'),
			tsh: getTextField('exames_tsh'),
			gj: getTextField('exames_gj'),
			ct: getTextField('exames_ct'),
			ldl: getTextField('exames_ldl'),
			hdl: getTextField('exames_hdl'),
			t4l: getTextField('exames_t4l')
		},
		conduta: {
			conduta: getActiveRadio('conduta'),
			cirurgia: getActiveRadio('conduta_cirurgia'),
			hormonioTerapia: getActiveRadio('conduta_hormonioTerapia'),
			hormonioTerapiaCiclico: parseBoolean(getActiveCheckbox('conduta_hormonioterapia_ciclico', true)),
			hormonioTerapiaContinuo: parseBoolean(getActiveCheckbox('conduta_hormonioterapia_continuo', true)),
			hormonioTerapiaNome: getTextField('conduta_hormonioterapia_nome'), // name
			ainh: getTextField('conduta_ainh_nome')
		},
		resultados: {
			pbacFinal: getTextField('resultados_pbacFinal'),
			beckFinal: getTextField('resultados_beckFinal'),
			vidaMioma: getTextField('resultados_vidaMiomaFinal')
		}

	};
};

var getActiveCheckbox = function(a, b) {
	var c, d;

	c = $('input[name=' + a + ']:checked');
	d = [];

	for (var e = c.length; e--; )
		d.push($(c[e]).val());

	if (d.length > 0)
		if (d.length > 1)
			return d;
		else if (b)
			return d[0];
		else
			return d;

	return false;
};

var getActiveRadio = function(a) {
	var b, c;

	b = document.getElementsByName(a);

	for (c = b.length; c--; )
		if (b[c].checked)
			return b[c].value;

	return false;
};

var getTextField = function(a) {
	var b = document.getElementById(a).value;

	if (b)
		return b;

	return false;
};

var toBoolean = function (a) {
	return !!a;
};

var parseBoolean = function (a) {
	return (a === "true");
};

var getPickDate = function (a) {
	return a.pickadate('picker').get('select').obj.toISOString().substr(0, 10);
};

+function ($) {
	'use strict';

	/* Constructor of distinct functions */
	$.fn.distinct = function (options, events) {

		var settings = $.extend({
			prefix: false,
			target: 'body'
		}, options);

		var handle = function() {
			$(settings.target).removeClassLike(settings.prefix);
			$(settings.target).addClass(this.id);
		};

		for (var a = this.length; a--; )
			if (events.constructor === Array)
				for (var b = events.length; b--;)
					this[a].addEventListener(events[b], handle, false);
			else
				this[a].addEventListener(events, handle, false);
	}

}(jQuery);

// removes class with prefix
jQuery.fn.removeClassLike = function (prefix) {
	if (this.attr("class")) {
		var classes = this.attr("class").split(" ").filter(function (c) {
			return c.lastIndexOf(prefix, 0) !== 0;
		});
		return this.attr("class", classes.join(" "));
	}
};

/**
 * APRESENTAÇÃO DA DATA
 */
/*var data = new Date("2015-06-01");
 data.setDate(data.getDate() + 1);
 console.log(data.toLocaleDateString('pt-BR', {
 day: 'numeric',
 month: 'long',
 year: 'numeric'
 }));*/

if (typeof _id !== 'undefined') {
	$.ajax({
		cache: false,
		data: {prontuario_id: _id},
		dataType: 'json',
		error: function(data) {
			console.log(data.responseText);
			return false;
		},
		method: 'get',
		success: function(data) {
			if (data.prontuario)
				renderConsulta(data);
			else
				return false;
		},
		url: __API_DIR +  'i/pull/find/consulta/'
	});
}

var renderConsulta = function(a) {
	var c, d, e, f;

	c = a.prontuario[0];
	d = a.paciente[0];

	e = document.getElementById('p_data');
	f = document.getElementById('prontuario__id');

	g = document.getElementById('c_data');

	e.innerHTML = '';
	f.value = a.prontuario_id;

	$('#prontuario_edit').hide();

	insereNovoProntuario(e, c, 'prontuario');
	insereNovoPaciente(e, d, 'paciente');

	insereNovoResultados(g, a.resultados[0], 'resultados');
	insereNovoConduta(g, a.conduta[0], 'conduta');
	insereNovoExames(g, a.exames[0], 'exames');
	insereNovoEscalas(g, a.escalas[0], 'escalas');
	insereNovoSangramento(g, a.sangramento[0], 'sangramento');
	insereNovoUteroMioma(g, a.uteroMioma[0], 'uteroMioma');
	insereNovoAntecedentes(g, a.antecedentes[0], 'antecedentes');
	insereNovoExameFisico(g, a.exameFisico[0], 'exameFisico');

};

var insereNovoAntecedentes = function(a, b, c) {
	var d = document.createElement('div');
	d.setAttribute('class', c + ' green-100 flex flex-column');

	d.appendChild(newNode('span', b.situacaoAborto, 'situacaoAborto'));
	d.appendChild(newNode('span', b.situacaoGestacao, 'situacaoGestacao'));
	d.appendChild(newNode('span', b.situacaoParidade, 'situacaoParidade'));
	d.appendChild(newNode('span', b.tabagismo, 'tabagismo'));
	d.appendChild(newNode('span', b.hac, 'hac'));
	d.appendChild(newNode('span', b.hacType, 'hacType'));
	d.appendChild(newNode('span', b.diabetes, 'diabetes'));
	d.appendChild(newNode('span', b.diabetesType, 'diabetesType'));
	d.appendChild(newNode('span', b.hipotireoidismo, 'hipotireoidismo'));
	d.appendChild(newNode('span', b.hipotireoidismoType, 'hipotireoidismoType'));
	d.appendChild(newNode('span', b.note, 'note'));

	a.insertBefore(d, a.firstChild);
};

var insereNovoConduta = function(a, b, c) {
	var d = document.createElement('div');
	d.setAttribute('class', c + ' flex flex-column');

	d.appendChild(newNode('span', b.conduta, 'conduta'));
	d.appendChild(newNode('span', b.cirurgia, 'cirurgia'));
	d.appendChild(newNode('span', b.hormonioTerapia, 'hormonioTerapia'));
	d.appendChild(newNode('span', b.hormonioTerapiaCiclico, 'hormonioTerapiaCiclico'));
	d.appendChild(newNode('span', b.hormonioTerapiaContinuo, 'hormonioTerapiaContinuo'));
	d.appendChild(newNode('span', b.hormonioTerapiaNome, 'hormonioTerapiaNome'));
	d.appendChild(newNode('span', b.ainh, 'ainh'));

	a.insertBefore(d, a.firstChild);
};

var insereNovoEscalas = function(a, b, c) {
	var d = document.createElement('div');
	d.setAttribute('class', c + ' grey-50 flex flex-column');

	d.appendChild(newNode('span', b.beckInicial, 'beckInicial'));
	d.appendChild(newNode('span', b.vidaMioma, 'vidaMioma'));

	a.insertBefore(d, a.firstChild);
};

var insereNovoExameFisico = function(a, b, c) {
	var d = document.createElement('div');
	d.setAttribute('class', c + ' flex flex-column');

	d.appendChild(newNode('span', b.peso, 'peso'));
	d.appendChild(newNode('span', b.altura, 'altura'));
	d.appendChild(newNode('span', b.imc, 'imc'));
	d.appendChild(newNode('span', b.pressaoArterial, 'pressaoArterial'));
	d.appendChild(newNode('span', b.circunferenciaAbdominal, 'circunferenciaAbdominal'));
	d.appendChild(newNode('span', b.circunferenciaCervical, 'circunferenciaCervical'));

	a.insertBefore(d, a.firstChild);
};

var insereNovoExames = function(a, b, c) {
	var d = document.createElement('div');
	d.setAttribute('class', c + ' green-100 flex flex-column');

	d.appendChild(newNode('span', b.hb, 'hb'));
	d.appendChild(newNode('span', b.ht, 'ht'));
	d.appendChild(newNode('span', b.ferro, 'ferro'));
	d.appendChild(newNode('span', b.ferritina, 'ferritina'));
	d.appendChild(newNode('span', b.rdw, 'rdw'));
	d.appendChild(newNode('span', b.vcm, 'vcm'));
	d.appendChild(newNode('span', b.vitaminaD3, 'vitaminaD3'));
	d.appendChild(newNode('span', b.tsh, 'tsh'));
	d.appendChild(newNode('span', b.gj, 'gj'));
	d.appendChild(newNode('span', b.ct, 'ct'));
	d.appendChild(newNode('span', b.ldl, 'ldl'));
	d.appendChild(newNode('span', b.hdl, 'hdl'));
	d.appendChild(newNode('span', b.t4l, 't4l'));

	a.insertBefore(d, a.firstChild);
};

var insereNovoResultados = function(a, b, c) {
	var d = document.createElement('div');
	d.setAttribute('class', c + ' indigo-100 flex flex-column');

	d.appendChild(newNode('span', b.pbacFinal, 'pbacFinal'));
	d.appendChild(newNode('span', b.beckFinal, 'beckFinal'));
	d.appendChild(newNode('span', b.vidaMioma, 'vidaMioma'));

	a.insertBefore(d, a.firstChild);
};

var insereNovoSangramento = function(a, b, c) {
	var d = document.createElement('div');
	d.setAttribute('class', c + ' flex flex-column');

	d.appendChild(newNode('span', b.pbacInicial, 'pbacInicial'));

	a.insertBefore(d, a.firstChild);
};

var insereNovoUteroMioma = function(a, b, c) {
	var d = document.createElement('div');
	d.setAttribute('class', c + ' flex flex-column');

	d.appendChild(newNode('span', b.us, 'us'));
	d.appendChild(newNode('span', b.volumeInterino, 'volumeInterino'));
	d.appendChild(newNode('span', b.ovarioDireito, 'ovarioDireito'));
	d.appendChild(newNode('span', b.ovarioEsquerdo, 'ovarioEsquerdo'));
	d.appendChild(newNode('span', b.endometro, 'endometro'));
	d.appendChild(newNode('span', b.miomaQuantidade, 'miomaQuantidade'));
	d.appendChild(newNode('span', b.mioma_1_caracteristicas, 'mioma_1_caracteristicas'));
	d.appendChild(newNode('span', b.mioma_1_submucoso, 'mioma_1_submucoso'));
	d.appendChild(newNode('span', b.mioma_1_subseroso, 'mioma_1_subseroso'));
	d.appendChild(newNode('span', b.mioma_1_intramural, 'mioma_1_intramural'));
	d.appendChild(newNode('span', b.mioma_2_caracteristicas, 'mioma_2_caracteristicas'));
	d.appendChild(newNode('span', b.mioma_2_submucoso, 'mioma_2_submucoso'));
	d.appendChild(newNode('span', b.mioma_2_subseroso, 'mioma_2_subseroso'));
	d.appendChild(newNode('span', b.mioma_2_intramural, 'mioma_2_intramural'));

	a.insertBefore(d, a.firstChild);
};