/*!
 * Magma Scientific Client Functions v1.8.5 (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

if (typeof __API_DIR === 'undefined')
	var __API_DIR = '';

$('#btn').click(function () {

	document.cookie = "response=" + JSON.stringify(getResponse());

	document.getElementById('prontuario__id').value = '';

	$.ajax({
		error: function (data) {
			console.log(data.responseText);
		},
		method: 'post',
		success: function (data) {
			document.getElementById('prontuario__id').value = data.prontuario._id;
		},
		url: __API_DIR + 'i/push/'
	});

});

// Adaptaçao da funçao acima
$('#consulta_create').click(function () {
	pushResponse(true, true, false);
});

function submitProntuario() {
	document.forms['carry_id'].submit();
}

function pushResponse(cookies, submit, log) {
	var d, id, r, u;

	document.getElementById('prontuario__id').value = '';

	d = false;
	r = JSON.stringify(getResponse());
	u = __API_DIR + 'i/push/';

	if (cookies) setCookies('response', r);
	else d = {
		response: r
	};

	if (log) u = __API_DIR + 'log/push/';

	$.ajax({
		data: d,
		error: function (data) {
			console.log(data.responseText);
		},
		method: 'post',
		success: function (data) {
			if (data.prontuario._id) {
				document.getElementById('prontuario__id').value = data.prontuario._id;
				if (submit)
					submitProntuario();
			}
		},
		url: u
	});
}

function t() {
	console.log(getResponse());
}

/**
 * Atualiza Cookies
 * @param a atributo
 * @param c content
 */
function setCookies(a, c) {
	var b = a + "=" + c;
	console.log(b);
	document.cookie = b;
}

function setResponse() {
	console.log('oiasd');
}

var sexoInput = document.getElementsByName('paciente_sexo');
for (var i = sexoInput.length; i--;)
	sexoInput[i].addEventListener('blur', setResponse, false);

function getResponse() {
	return {

		antecedentes: {
			situacaoAborto: getTextField('antecedentes_situacao_aborto'),
			situacaoGestacao: getTextField('antecedentes_situacao_gestaçao'),
			situacaoParidade: getTextField('antecedentes_situacao_paridade'),
			tabagismo: parseBoolean(getActiveRadio('antecedentes_tabagismo')),
			hac: numberToBoolean(getActiveRadio('antecedentes_hac')),
			hacType: getActiveRadio('antecedentes_hac_type'),
			diabetes: numberToBoolean(getActiveRadio('antecedentes_diabetes')),
			diabetesType: getActiveRadio('antecedentes_diabetes_type'),
			hipotireoidismo: numberToBoolean(getActiveRadio('antecedentes_hipotireoidismo')),
			hipotireoidismoType: getActiveRadio('antecedentes_hipotireoidismo_type'),
			note: getTextField('antecedentes_note')
		},
		conduta: {
			conduta: getActiveRadio('conduta'),
			cirurgia: getActiveRadio('conduta_cirurgia'),
			hormonioTerapia: getActiveRadio('conduta_hormonioTerapia'),
			hormonioTerapiaAINH: getTextField('conduta_hormonioterapia_ainh'),
			hormonioTerapiaCiclico: parseBoolean(getActiveCheckbox('conduta_hormonioterapia_ciclico', true)),
			hormonioTerapiaContinuo: parseBoolean(getActiveCheckbox('conduta_hormonioterapia_continuo', true)),
			hormonioTerapiaNome: getTextField('conduta_hormonioterapia_nome'),
			ainh: getTextField('conduta_ainh_nome')
		},
		exameFisico: {
			peso: getTextField('exameFisico_peso'),
			altura: getTextField('exameFisico_altura'),
			imc: getTextField('exameFisico_imc'),
			pressaoArterial: getTextField('exameFisico_pressaoArterial'),
			circunferenciaAbdominal: getTextField('exameFisico_circunferenciaAbdominal'),
			circunferenciaCervical: getTextField('exameFisico_circunferenciaCervical')
		},
		escalas: {
			beckInicial: getTextField('escalas_beckInicial'),
			pbacInicial: getTextField('sangramento_pbacInicial'),
			vidaMioma: getTextField('escalas_vidaMioma')
		},
		exames: {
			hb: getTextField('exames_hb'),
			ht: getTextField('exames_ht'),
			vcm: getTextField('exames_vcm'),
			rdw: getTextField('exames_rdw'),
			ferro: getTextField('exames_ferro'),
			ferritina: getTextField('exames_ferritina'),
			vitaminaD3: getTextField('exames_vitaminaD3'),
			gj: getTextField('exames_gj'),
			ct: getTextField('exames_ct'),
			ldl: getTextField('exames_ldl'),
			hdl: getTextField('exames_hdl'),
			tsh: getTextField('exames_tsh'),
			t4l: getTextField('exames_t4l'),
			tgl: getTextField('exames_tgl'),
			colo: getTextField('exames_colo'),
			lombar: getTextField('exames_lombar')
		},
		mioma: getMiomas(),
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
		prontuario: {
			_id: getTextField('prontuario__id'),
			registro: getTextField('prontuario_registro'),
			data: getPickDate($prontuario_data)
		},
		resultados: {
			pbacFinal: getTextField('resultados_pbacFinal'),
			beckFinal: getTextField('resultados_beckFinal'),
			vidaMioma: getTextField('resultados_vidaMiomaFinal')
		},
		ultrassom: {
			volumeUterino: getTextField('ultrassom_volumeUterino'),
			ovarioDireito: getTextField('ultrassom_ovarioDireito'),
			ovarioEsquerdo: getTextField('ultrassom_ovarioEsquerdo'),
			endometro: getTextField('ultrassom_endometro'),
			nd: getActiveCheckbox('ultrassom_nd')
		}

	};
}


/**
 * Renderiza a consulta inteira
 * @param object a consulta
 */
var renderConsulta;
renderConsulta = function (a) {
	var c, d, e, f, g;

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
	//insertNewCondutaExames(g, a.conduta[0], a.exames[0], 'conduta');
	insertNewConduta(g, a.conduta[0], 'conduta');
	insertNewExames(g, a.exames[0], 'exames');
	insertNewEscalas(g, a.escalas[0], 'escalas');
	insertNewMioma(g, a.mioma, 'mioma');
	insertNewUltrassom(g, a.ultrassom[0], 'ultrassom');
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

	// usar 'long' para apresentar nome do mês
	var dateOptions = {
		day: 'numeric',
		month: 'numeric',
		year: 'numeric'
	};

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

	ebb.appendChild(newField(getAge(c.nascimento) + ' anos', 'idade', 'value-bold'));
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

	eab.appendChild(newField(b.peso, 'peso', '', 'kg'));
	eab.appendChild(newField(b.altura, 'altura', '', 'cm'));
	eab.appendChild(newField(b.imc, 'imc'));
	eab.appendChild(newField(b.pressaoArterial, 'PA. ARTERIAL', '', 'mmHg'));
	eab.appendChild(newField(b.circunferenciaAbdominal, 'C. Abdominal', '', 'cm'));
	eab.appendChild(newField(b.circunferenciaCervical, 'C. Cervical', '', 'cm'));

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

	eab.appendChild(newField(b.situacaoGestacao, 'Gestacao'));
	eab.appendChild(newField(b.situacaoParidade, 'Paridade'));
	eab.appendChild(newField(b.situacaoAborto, 'Aborto'));
	if (numberToBoolean(b.tabagismo))
		eab.appendChild(newField(toLocaleBool(b.tabagismo), 'tabagismo'));

	if (numberToBoolean(b.hac))
		eac.appendChild(newField(buildTypeNote(b.hac, b.hacType), 'hac'));
	if (numberToBoolean(b.diabetes))
		eac.appendChild(newField(buildTypeNote(b.diabetes, b.diabetesType), 'diabetes'));
	if (numberToBoolean(b.hipotireoidismo))
		eac.appendChild(newField(buildTypeNote(b.hipotireoidismo, b.hipotireoidismoType), 'hipotireoidismo'));
	eac.appendChild(newField(b.note, 'outro'));

	ea.appendChild(eaa);
	ea.appendChild(eab);
	ea.appendChild(eac);

	e.appendChild(ea);

	a.insertBefore(e, a.firstChild);
};

/**
 * Insere elemento de ultrassom no parent
 * @param a parent
 * @param b ultrassom
 * @param c class
 */
var insertNewUltrassom;
insertNewUltrassom = function (a, b, c) {
	var e = newNode('div', c + ' content-box');

	var ea = newNode('div', 'flexbox flex-column flex-4');
	var eaa = newNode('div', 'flexbox');
	var eab = newNode('div', 'flexbox');

	eaa.appendChild(newContentNode('h2', 'Características Útero / Mioma'));

	eab.appendChild(newField(b.volumeUterino, 'volume Uterino'));
	eab.appendChild(newField(b.ovarioDireito, 'ovario Direito'));
	eab.appendChild(newField(b.ovarioEsquerdo, 'ovario Esquerdo'));
	eab.appendChild(newField(b.endometro, 'endometro'));

	ea.appendChild(eaa);
	ea.appendChild(eab);

	e.appendChild(ea);

	a.insertBefore(e, a.firstChild);
};

/**
 * Insere elemento de ultrassom no parent
 * @param a parent
 * @param b ultrassom
 * @param c class
 */
var insertNewMioma;
insertNewMioma = function (a, b, c) {
	var e, f;

	e = newNode('div', c + ' content-box flex-column');
	f = b.length;

	for (var i = 0; i < f; i++) {
		var ea = newNode('div', 'flexbox');
		var eaa = newNode('div', 'flexbox');

		eaa.appendChild(newField(b[i].medida, 'medida'));
		eaa.appendChild(newField(b[i].tipo, 'tipo'));

		ea.appendChild(eaa);
		e.appendChild(ea);
	}

	a.insertBefore(e, a.firstChild);
};

/**
 * Insere elemento de Escalas no parent
 * @param a parent
 * @param b escalas
 * @param c class
 */
var insertNewEscalas;
insertNewEscalas = function (a, b, c) {
	var e = newNode('div', c + ' content-box');

	var ea = newNode('div', 'flexbox flex-column flex-4');
	var eaa = newNode('div', 'flexbox');
	var eab = newNode('div', 'flexbox');

	eaa.appendChild(newContentNode('h2', 'Escalas'));

	eab.appendChild(newField(b.pbacInicial, 'pbac Inicial'));
	eab.appendChild(newField(b.beckInicial, 'beck Inicial'));
	eab.appendChild(newField(b.vidaMioma, 'vida x Mioma'));

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

	var ea = newNode('div', 'flexbox flex-column');
	var eaa = newNode('div', 'flexbox');
	var eab = newNode('div', 'flexbox');
	var eaba = newNode('div', 'flexbox flex-column');
	var eabb = newNode('div', 'flexbox flex-column');
	var eabc = newNode('div', 'flexbox flex-column');
	var eabd = newNode('div', 'flexbox flex-column');
	var eabe = newNode('div', 'flexbox flex-column');
	var eabf = newNode('div', 'flexbox flex-column');

	eaa.appendChild(newContentNode('h2', 'Exames Iniciais'));

	eaba.appendChild(newField(b.hb, 'Hb', 'defaultcase', 'g/dL'));
	eaba.appendChild(newField(b.ht, 'Ht', 'defaultcase', '%'));
	eaba.appendChild(newField(b.vcm, 'vcm', 'ft'));

	eabb.appendChild(newField(b.rdw, 'rdw', false, '%'));
	eabb.appendChild(newField(b.ferro, 'ferro', false, 'μg/dL'));
	eabb.appendChild(newField(b.ferritina, 'ferritina', false, 'ng/dL'));

	eabc.appendChild(newField(b.vitaminaD3, 'Vitamina D3', false, 'ng/dL'));
	eabc.appendChild(newField(b.gj, 'GJ', false, 'mg/dL'));
	eabc.appendChild(newField(b.ct, 'CT', false, 'mg/dL'));

	eabd.appendChild(newField(b.ldl, 'LDL', false, 'mg/dL'));
	eabd.appendChild(newField(b.hdl, 'HDL', false, 'mg/dL'));
	eabd.appendChild(newField(b.tsh, 'TSH', false, 'mU/L'));

	eabe.appendChild(newField(b.t4l, 'T4L', 'defaultcase', 'ng/dL'));
	eabe.appendChild(newField(b.tgl, 'TGL', false, ''));

	eabf.appendChild(newField(b.colo, 'COLO', false, ''));
	eabf.appendChild(newField(b.lombar, 'LOMBAR', false, ''));
	eabf.appendChild(newEmptyField());

	eab.appendChild(eaba);
	eab.appendChild(eabb);
	eab.appendChild(eabc);
	eab.appendChild(eabd);
	eab.appendChild(eabe);
	eab.appendChild(eabf);

	ea.appendChild(eaa);
	ea.appendChild(eab);
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
		eab.appendChild(newField(b.hormonioTerapiaAINH, 'ainh'));
	}
	if (b.ainh)
		eab.appendChild(newField(b.ainh, 'ainh'));

	ea.appendChild(eaa);
	ea.appendChild(eab);

	e.appendChild(ea);

	a.insertBefore(e, a.firstChild);
};

/**
 * Insere elemento de Resultados no parent
 * @param a parent
 * @param b resultados
 * @param c class
 */
var insertNewResultados;
insertNewResultados = function (a, b, c) {
	var e = newNode('div', c + ' content-box');

	var ea = newNode('div', 'flexbox flex-column flex-4');
	var eaa = newNode('div', 'flexbox');
	var eab = newNode('div', 'flexbox');

	eaa.appendChild(newContentNode('h2', 'Resultados'));

	eab.appendChild(newField(b.pbacFinal, 'pbac Final'));
	eab.appendChild(newField(b.beckFinal, 'beck Final'));
	eab.appendChild(newField(b.vidaMioma, 'vida x Mioma'));

	ea.appendChild(eaa);
	ea.appendChild(eab);

	e.appendChild(ea);

	a.insertBefore(e, a.firstChild);
};


var appendObject = function (a, b, g) {
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

if (typeof _id !== 'undefined') {
	$.ajax({
		cache: false,
		data: {prontuario_id: _id},
		dataType: 'json',
		error: function (data) {
			console.log(data.responseText);
			return false;
		},
		method: 'get',
		success: function (data) {
			if (data.prontuario)
				renderConsulta(data);
			else
				return false;
		},
		url: __API_DIR + 'i/pull/find/consulta/'
	});
}

function getLog() {
	return {
		agent: window.navigator.userAgent,
		time: new Date().toISOString(),
		timezone: new Date().getTimezoneOffset() / 60
	};
}

function doLog() {
	$.ajax({
		data: {
			log: JSON.stringify(getLog())
		},
		method: 'post',
		url: __API_DIR + 'i/log/'
	});
}

window.addEventListener('load', doLog);