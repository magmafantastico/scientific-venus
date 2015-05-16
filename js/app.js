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

$('#consulta_create').click(function() {

	$.ajax({
		data: {response: JSON.stringify(getResponse())},
		error: function(data) {
			console.log(data.responseText);
		},
		method: 'post',
		success: function(data) {
			console.log(data);
			document.getElementById('prontuario__id').value = data;
			document.forms['carry_id'].submit();
		},
		url: __API_DIR +  'i/push/'
	});

});

var renderProntuario = function(a) {
	var b, c, d, e, f;

	b = a.request;
	c = b.prontuario;
	d = b.paciente;
	e = document.getElementById('p_data');
	f = document.getElementById('prontuario__id');

	e.innerHTML = '';
	f.value = a.prontuario;

	//$('#prontuario_edit').hide();

	insertNewProntuario(e, c, d, 'prontuario');

	initConsulta();
};

var initConsulta = function() {
	/*$('#consulta').show();*/
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

/**
 * Constrói string com condicional se b exsite
 * @param a
 * @param b
 * @returns string
 */
var buildNote;
buildNote = function (a, b) {
	if (b) return a + ' (' + b + ')';
	else return a;
};

/**
 * Localiza boolean para o português
 * @param a
 * @returns string
 */
var toLocaleBool;
toLocaleBool = function (a) {
	if (a == 1) return 'Sim';
	else return 'Não';
};

var buildTypeNote = function(a, b) {
	if (a > 0)
		return toLocaleBool(a) + ' (' + b + ')';
	else return b;
};

/**
 * Cria novo elemento
 * @param a element type
 * @param c class
 * @returns {Element}
 */
var newNode;
newNode = function (a, c) {
	var e = document.createElement(a);
	if (c) e.setAttribute('class', c);
	return e;
};

/**
 * Cria novo elemento com conteudo
 * @param a element type
 * @param b content
 * @param c class
 * @returns {Element}
 */
var newContentNode;
newContentNode = function (a, b, c) {

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

/**
 * Cria um field de informação para o prontuário (nome, sexo, etc)
 * @param a content
 * @param b title
 * @param c class
 * @returns {Element}
 */
var newField;
newField = function (a, b, c) {
	var e = document.createElement('span');
	var className = 'field';
	if (b) className += ' ' + b.toLowerCase().replace(/\s+/g, '').replace(/\.+/g, '');
	if (c) className += ' ' + c;
	e.setAttribute('class', className);

	e.appendChild(newContentNode('span', b, 'title'));
	if (b) e.appendChild(newContentNode('span', a, 'value'));

	return e;
};

/**
 * Renderiza a consulta inteira
 * @param object a consulta
 */
var renderConsulta;
renderConsulta = function (a) {
	console.log(a);
	var c, d, e, f;

	c = a.prontuario[0];
	d = a.paciente[0];

	e = document.getElementById('p_data');
	f = document.getElementById('prontuario__id');

	g = document.getElementById('c_data');

	e.innerHTML = '';
	f.value = a.prontuario_id;

	$('#prontuario_edit').hide();

	insertNewProntuario(e, c, d, 'prontuario');

	insertNewResultados(g, a.resultados[0], 'resultados');
	insertNewConduta(g, a.conduta[0], 'conduta');
	insertNewExames(g, a.exames[0], 'exames');
	insertNewEscalas(g, a.escalas[0], a.sangramento[0], 'escalas');
	/*insertNewSangramento(g, a.sangramento[0], 'sangramento');*/
	insertNewUteroMioma(g, a.uteroMioma[0], 'uteroMioma');
	insertNewAntecedentes(g, a.antecedentes[0], 'antecedentes');
	insertNewExameFisico(g, a.exameFisico[0], 'exameFisico');

};

/**
 * Insere elemento de prontuario no parent
 * @param a parent
 * @param b prontuario
 * @param c paciente
 * @param d class
 */
var insertNewProntuario;
insertNewProntuario = function (a, b, c, d) {

	var dateOptions = {
		day: 'numeric',
		month: 'long',
		year: 'numeric'
	};

	var date = new Date(c.nascimento);
	date.setDate(date.getDate() + 1);
	var paciente_nascimento = date.toLocaleDateString('pt-BR', dateOptions);

	var date = new Date(b.data);
	date.setDate(date.getDate() + 1);
	var prontuario_data = date.toLocaleDateString('pt-BR', dateOptions);

	// renderiza prontuario

	// renderiza coluna A (nome, religiao, etnia, escolaridade, estadoCivil)

	var e = newNode('div', d + ' content-box');

	var ea = newNode('div', 'flexbox flex-column flex-4');
	var eaa = newNode('div', 'flexbox');
	var eab = newNode('div', 'flexbox');

	eaa.appendChild(newField(c.nome, 'nome', 'value-bold value-large'));

	eab.appendChild(newField(buildNote(c.religiao, c.religiaoNote), 'religiao'));
	eab.appendChild(newField(buildNote(c.etnia, c.etniaNote), 'etnia'));
	eab.appendChild(newField(buildNote(c.escolaridade, c.escolaridadeNote), 'escolaridade'));
	eab.appendChild(newField(buildNote(c.estadoCivil, c.estadoCivilNote), 'estado civil'));

	ea.appendChild(eaa);
	ea.appendChild(eab);

	e.appendChild(ea);

	// renderiza coluna B (nome, religiao, etnia, escolaridade, estadoCivil)

	var eb = newNode('div', 'flexbox flex-2');

	var eba = newNode('div', 'flexbox flex-column');
	var ebb = newNode('div', 'flexbox flex-column');

	eba.appendChild(newField(c.sexo, 'sexo', 'value-bold'));
	eba.appendChild(newField(b.registro, 'ambulatório'));

	ebb.appendChild(newField(paciente_nascimento, 'nascimento', 'value-bold'));
	ebb.appendChild(newField(prontuario_data, 'data'));

	eb.appendChild(eba);
	eb.appendChild(ebb);

	e.appendChild(eb);

	a.insertBefore(e, a.firstChild);

};

/**
 * Insere elemento de Exame Físico no parent
 * @param a parent
 * @param b exameFisico
 * @param c class
 */
var insertNewExameFisico;
insertNewExameFisico = function (a, b, c) {
	var e = newNode('div', c + ' content-box');

	var ea = newNode('div', 'flexbox flex-column flex-4');
	var eaa = newNode('div', 'flexbox');
	var eab = newNode('div', 'flexbox');

	eaa.appendChild(newContentNode('h2', 'Exame Físico'));

	eab.appendChild(newField(b.peso, 'peso'));
	eab.appendChild(newField(b.altura, 'altura'));
	eab.appendChild(newField(b.imc, 'imc'));
	eab.appendChild(newField(b.pressaoArterial, 'PA. Arterial'));
	eab.appendChild(newField(b.circunferenciaAbdominal, 'C. Abdominal'));
	eab.appendChild(newField(b.circunferenciaCervical, 'C. Cervical'));

	ea.appendChild(eaa);
	ea.appendChild(eab);

	e.appendChild(ea);

	a.insertBefore(e, a.firstChild);
};

/**
 * Insere elemento de Antecedentes no parent
 * @param a parent
 * @param b antecedentes
 * @param c class
 */
var insertNewAntecedentes;
insertNewAntecedentes = function (a, b, c) {
	var e = newNode('div', c + ' content-box');

	var ea = newNode('div', 'flexbox flex-column flex-4');
	var eaa = newNode('div', 'flexbox');
	var eab = newNode('div', 'flexbox');
	var eac = newNode('div', 'flexbox');

	eaa.appendChild(newContentNode('h2', 'Antecedentes'));

	eab.appendChild(newField(toLocaleBool(b.situacaoAborto), 'Aborto'));
	eab.appendChild(newField(toLocaleBool(b.situacaoGestacao), 'Gestacao'));
	eab.appendChild(newField(toLocaleBool(b.situacaoParidade), 'Paridade'));
	eab.appendChild(newField(toLocaleBool(b.tabagismo), 'tabagismo'));

	eac.appendChild(newField(buildTypeNote(b.hac, b.diabetesType), 'hac'));
	eac.appendChild(newField(buildTypeNote(b.diabetes, b.diabetesType), 'diabetes'));
	eac.appendChild(newField(buildTypeNote(b.hipotireoidismo, b.diabetesType), 'hipotireoidismo'));
	eac.appendChild(newField(b.note, 'outro'));

	ea.appendChild(eaa);
	ea.appendChild(eab);
	ea.appendChild(eac);

	e.appendChild(ea);

	a.insertBefore(e, a.firstChild);
};

/**
 * Insere elemento de UteroMioma no parent
 * @param a parent
 * @param b uteroMioma
 * @param c class
 */
var insertNewUteroMioma;
insertNewUteroMioma = function (a, b, c) {
	var e = newNode('div', c + ' content-box');

	var ea = newNode('div', 'flexbox flex-column flex-4');
	var eaa = newNode('div', 'flexbox');
	var eab = newNode('div', 'flexbox');
	var eac = newNode('div', 'flexbox');
	var ead = newNode('div', 'flexbox');
	var eae = newNode('div', 'flexbox');

	eaa.appendChild(newContentNode('h2', 'Características Útero / Mioma'));

	eab.appendChild(newField(b.us, 'us'));
	eab.appendChild(newField(b.volumeInterino, 'volumeInterino'));
	eab.appendChild(newField(b.ovarioDireito, 'ovarioDireito'));
	eab.appendChild(newField(b.ovarioEsquerdo, 'ovarioEsquerdo'));
	eab.appendChild(newField(b.endometro, 'endometro'));

	eac.appendChild(newField(b.miomaQuantidade, 'miomaQuantidade'));

	ead.appendChild(newField(b.mioma_1_caracteristicas, 'caracteristicas'));
	ead.appendChild(newField(toLocaleBool(b.mioma_1_submucoso), 'submucoso'));
	ead.appendChild(newField(toLocaleBool(b.mioma_1_subseroso), 'subseroso'));
	ead.appendChild(newField(toLocaleBool(b.mioma_1_intramural), 'intramural'));

	eae.appendChild(newField(b.mioma_2_caracteristicas, 'caracteristicas'));
	eae.appendChild(newField(toLocaleBool(b.mioma_2_submucoso), 'submucoso'));
	eae.appendChild(newField(toLocaleBool(b.mioma_2_subseroso), 'subseroso'));
	eae.appendChild(newField(toLocaleBool(b.mioma_2_intramural), 'intramural'));

	ea.appendChild(eaa);
	ea.appendChild(eab);
	ea.appendChild(eac);
	ea.appendChild(ead);
	ea.appendChild(eae);

	e.appendChild(ea);

	a.insertBefore(e, a.firstChild);
};

/**
 * Insere elemento de Sangramento no parent
 * @param a parent
 * @param b sangramento
 * @param c class
 */
var insertNewSangramento;
insertNewSangramento = function (a, b, c) {
	var e = newNode('div', c + ' content-box');

	var ea = newNode('div', 'flexbox flex-column flex-4');
	var eaa = newNode('div', 'flexbox');
	var eab = newNode('div', 'flexbox');

	eaa.appendChild(newContentNode('h2', 'Sangramento'));

	eab.appendChild(newField(b.pbacInicial, 'pbac Inicial'));

	ea.appendChild(eaa);
	ea.appendChild(eab);
	e.appendChild(ea);

	a.insertBefore(e, a.firstChild);
};

/**
 * Insere elemento de Escalas no parent
 * @param a parent
 * @param b escalas
 * @param c sangramento
 * @param d class
 */
var insertNewEscalas;
insertNewEscalas = function (a, b, c, d) {
	var e = newNode('div', d + ' content-box');

	var ea = newNode('div', 'flexbox flex-column flex-4');
	var eaa = newNode('div', 'flexbox');
	var eab = newNode('div', 'flexbox');

	eaa.appendChild(newContentNode('h2', 'Escalas'));
	console.log(b);

	eab.appendChild(newField(c.pbacInicial, 'pbac Inicial'));
	eab.appendChild(newField(b.beckInicial, 'beck Inicial'));
	eab.appendChild(newField(b.vidaMioma, 'vida Mioma'));

	ea.appendChild(eaa);
	ea.appendChild(eab);
	e.appendChild(ea);

	a.insertBefore(e, a.firstChild);
};

/**
 * Insere elemento de Exames no parent
 * @param a parent
 * @param b exameFisico
 * @param c class
 */
var insertNewExames;
insertNewExames = function (a, b, c) {
	var e = newNode('div', c + ' content-box');

	var ea = newNode('div', 'flexbox flex-column flex-4');
	var eaa = newNode('div', 'flexbox');
	var eab = newNode('div', 'flexbox');
	var eac = newNode('div', 'flexbox');
	var ead = newNode('div', 'flexbox');

	eaa.appendChild(newContentNode('h2', 'Exames'));

	eab.appendChild(newField(b.hb, 'hb'));
	eab.appendChild(newField(b.ht, 'ht'));
	eab.appendChild(newField(b.ferro, 'ferro'));
	eab.appendChild(newField(b.ferritina, 'ferritina'));
	eab.appendChild(newField(b.rdw, 'rdw'));
	eab.appendChild(newField(b.vcm, 'vcm'));

	eac.appendChild(newField(b.vitaminaD3, 'vitaminaD3'));
	eac.appendChild(newField(b.tsh, 'tsh'));
	eac.appendChild(newField(b.gj, 'gj'));
	eac.appendChild(newField(b.ct, 'ct'));
	eac.appendChild(newField(b.ldl, 'ldl'));
	eac.appendChild(newField(b.hdl, 'hdl'));

	ead.appendChild(newField(b.t4l, 't4l'));

	ea.appendChild(eaa);
	ea.appendChild(eab);
	ea.appendChild(eac);
	ea.appendChild(ead);
	e.appendChild(ea);

	a.insertBefore(e, a.firstChild);
};

/**
 * Insere elemento de Conduta no parent
 * @param a parent
 * @param b exameFisico
 * @param c class
 */
var insertNewConduta;
insertNewConduta = function (a, b, c) {
	var e = newNode('div', c + ' content-box');

	var ea = newNode('div', 'flexbox flex-column flex-4');
	var eaa = newNode('div', 'flexbox');
	var eab = newNode('div', 'flexbox');

	eaa.appendChild(newContentNode('h2', 'Conduta'));

	eab.appendChild(newField(b.conduta, 'conduta'));

	if (b.cirurgia)
	eab.appendChild(newField(b.cirurgia, 'cirurgia'));
	if (b.hormonioTerapia) {
		eab.appendChild(newField(b.hormonioTerapia, 'hormônio Terapia'));
		eab.appendChild(newField(toLocaleBool(b.hormonioTerapiaCiclico), 'Ciclico'));
		eab.appendChild(newField(toLocaleBool(b.hormonioTerapiaContinuo), 'Continuo'));
		eab.appendChild(newField(b.hormonioTerapiaNome, 'Nome'));
	}
	if (b.ainh)
	eab.appendChild(newField(b.ainh, 'ainh'));

	ea.appendChild(eaa);
	ea.appendChild(eab);

	e.appendChild(ea);

	a.insertBefore(e, a.firstChild);
};

var insertNewResultados = function(a, b, c) {
	var e = newNode('div', c + ' content-box');

	var ea = newNode('div', 'flexbox flex-column flex-4');
	var eaa = newNode('div', 'flexbox');
	var eab = newNode('div', 'flexbox');

	eaa.appendChild(newContentNode('h2', 'Resultados'));

	eab.appendChild(newField(b.pbacFinal, 'pbac Final'));
	eab.appendChild(newField(b.beckFinal, 'beck Final'));
	eab.appendChild(newField(b.vidaMioma, 'vida Mioma'));

	ea.appendChild(eaa);
	ea.appendChild(eab);

	e.appendChild(ea);

	a.insertBefore(e, a.firstChild);
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