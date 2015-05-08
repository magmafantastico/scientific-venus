/*!
 * Magma SCI v0.9.0 (http://getvilla.org/)
 * Copyright 2013-2015 Noibe Developers
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

$('#btn').click(function() {
	$('#string').html(getResponse());
});

var getResponse = function() {

	var r = {
		prontuario: {
			_id: getTextField('prontuario__id'),
			data: getTextField('prontuario_data')
		},
		paciente: {
			nome: getTextField('paciente_nome'),
			sexo: getActiveRadio('paciente_sexo'),
			nascimento: getTextField('paciente_nascimento'),
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
			mioma_1_type: getActiveCheckbox('uteroMioma_mioma_1_type'),
			mioma_2_caracteristicas: getTextField('uteroMioma_mioma_2_caracteristicas'),
			mioma_2_type: getActiveCheckbox('uteroMioma_mioma_2_type'),
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
			hormonioTerapiaCiclico: getActiveCheckbox('conduta_hormonioterapia_ciclico'),
			hormonioTerapiaContinuo: getActiveCheckbox('conduta_hormonioterapia_continuo'),
			/*hormonioTerapiaName: getTextField('conduta_hormonioterapia_nome'),*/ // name
			ainh: getTextField('conduta_ainh')
		},
		resultados: {
			pbacFinal: getTextField('resultados_pbacFinal'),
			beckFinal: getTextField('resultados_beckFinal'),
			vidaMioma: getTextField('resultados_vidaMiomaFinal')
		}

	};

	return JSON.stringify(r);

};

var getActiveCheckbox = function(a, b) {
	var c, d;

	c = $('input[name=' + a + ']:checked');
	d = new Array();

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