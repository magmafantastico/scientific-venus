/*!
 * Magma Scientific Client Functions v1.8.5 (http://getvilla.org/)
 * Copyright 2014-2015 Magma Fantastico
 * Licensed under MIT (https://github.com/noibe/villa/blob/master/LICENSE)
 */

var getActiveCheckbox = function (a, b) {
	var c, d;

	c = $('input[name=' + a + ']:checked');
	d = [];

	for (var e = c.length; e--;)
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

var getActiveRadio = function (a) {
	var b, c;

	b = document.getElementsByName(a);

	for (c = b.length; c--;)
		if (b[c].checked)
			return b[c].value;

	return false;
};

var getTextField = function (a) {
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

var toNumber = function (a) {
	if (!isNaN(a)) {
		return parseInt(a);
	}
	return false;
};

var numberToBoolean = function (a) {
	return toNumber(a) > 0;
};

/**
 * Localiza boolean para o português
 * @param a
 * @returns string
 */
var toLocaleBool;
toLocaleBool = function (a) {
	if (a == 1) return 'Sim';
	else return '';
};

var getPickDate = function (a) {
	return a.pickadate('picker').get('select').obj.toISOString().substr(0, 10);
};

var getAge;
getAge = function (a) {
	var b, c, d;
	a = new Date(a);
	b = new Date();
	c = b.getFullYear() - a.getFullYear();
	d = b.getMonth() - a.getMonth();
	if (d < 0 || (d === 0 && b.getDate() < a.getDate()))
		c--;
	return c;
};

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

var buildTypeNote = function (a, b) {
	if (a > 0)
		if (b)
			return toLocaleBool(a) + ' (' + b + ')';
	else return toLocaleBool(a);
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
newField = function (a, b, c, d) {
	var e = document.createElement('span');
	var className = 'field';
	//if (b) className += ' ' + b.toLowerCase().replace(/\s+/g, '').replace(/\.+/g, '');
	if (c) className += ' ' + c;
	e.setAttribute('class', className);

	var ea = newNode('span', 'content');
	ea.appendChild(newContentNode('span', a, 'value'));
	if (d) ea.appendChild(newContentNode('span', d, 'holder'));

	e.appendChild(newContentNode('span', b, 'title'));
	if (b) e.appendChild(ea);

	return e;
};

/**
 * Cria um field de informação para o prontuário (nome, sexo, etc)
 * @param a content
 * @param b title
 * @param c class
 * @returns {Element}
 */
var newEmptyField;
newEmptyField = function (c) {
	var e = document.createElement('span');
	var className = 'field empty';
	if (c) className += ' ' + c;
	e.setAttribute('class', className);

	e.appendChild(newContentNode('span', '-', 'title'));
	e.appendChild(newContentNode('span', '', 'content'));

	return e;
};

/**
 * FUNÇOES DE MIOMA
 */

/**
 * Cria elemento radio para elemento de Mioma
 * @param a num
 * @param b typeName
 * @return radio element
 */
var newMiomaFieldRadio;
newMiomaFieldRadio = function (a, b) {
	var e = newNode('span', 'field row');

	var ea = newNode('input');
	ea.type = 'radio';
	ea.id = 'mioma_type_' + a + '_' + b;
	ea.name = 'mioma_type_' + a;
	ea.value = b;

	var eb = newContentNode('label', b);
	eb.htmlFor = ea.id;

	e.appendChild(ea);
	e.appendChild(eb);

	return e;
};

/**
 * Cria novo elemento de Mioma
 * @param a num
 * @return mioma element
 */
var newMiomaField;
newMiomaField = function (a) {
	var e = newNode('div', 'mioma');

	var ea = newNode('div', 'mioma-length');

	var eaa = newNode('span', 'field flex-column');

	var eaaa = newNode('span', 'helper');

	var eaaaa = newNode('input');
	eaaaa.type = 'text';
	eaaaa.id = 'mioma_medida_' + a;
	eaaaa.name = 'mioma_medida_' + a;
	eaaaa.placeholder = 'Mioma ' + a;

	var eaaab = newContentNode('span', 'mm');

	eaaa.appendChild(eaaaa);
	eaaa.appendChild(eaaab);

	var eaab = newContentNode('label', 'medida');
	eaab.htmlFor = eaaaa.id;

	eaa.appendChild(eaab);
	eaa.appendChild(eaaa);

	ea.appendChild(eaa);

	var eb = newNode('div', 'mioma-type flex flex-wrap');

	// Para adicionar novo tipo, é só adicionar novo append de radio em um novo field
	var eba = newMiomaFieldRadio(a, 'Intramural');
	var ebb = newMiomaFieldRadio(a, 'Submucoso');
	var ebc = newMiomaFieldRadio(a, 'Subseroso');

	eb.appendChild(eba);
	eb.appendChild(ebb);
	eb.appendChild(ebc);

	e.appendChild(ea);
	e.appendChild(eb);

	return e;
};

/**
 * Obtem value da input 'medida' do elemento Mioma
 * @param a mioma element
 * @return value | bool
 */
var getMiomaLength;
getMiomaLength = function(a) {
	var b = a.getElementsByClassName('mioma-length')[0].getElementsByTagName('input')[0].value;
	if (b)return b;
	return false;
};

/**
 * Obtem value da input 'tipo' do elemento Mioma
 * @param a mioma element
 * @return value | bool
 */
var getMiomaType;
getMiomaType = function(a) {
	var b = a.getElementsByClassName('mioma-type')[0].getElementsByTagName('input');

	for (var i = b.length; i--; )
		if (b[i].checked)
			return b[i].value;

	return false;
};

/**
 * Obtem objeto de respostas do elemento Mioma
 * @param a mioma element
 * @return object
 */
var getMioma;
getMioma = function(a) {
	return {
		medida: getMiomaLength(a),
		tipo: getMiomaType(a)
	};
};

/**
 * Obtem array de objetos de respostas de todos elementos Mioma
 * @param a mioma element
 * @return object
 */
var getMiomas;
getMiomas = function() {
	var a, b;

	a = document.getElementsByClassName('mioma');
	b = [];

	for (var i = a.length; i--; ) {
		b.push(getMioma(a[i]));
	}

	return b;
};

/**
 * Cria novo elemento de Mioma
 */
var createMioma;
createMioma = function(a, b) {
	var n = b.length;

	a.insertBefore(newMiomaField(n + 1), b[n]);
};

/**
 * Remove último elemento de Mioma
 */
var removeMioma;
removeMioma = function(a, b) {
	var n = b.length;

	if (n >= 0)
		a.removeChild(b[n - 1]);
};

/**
 * Controla número de elementos de Mioma baseado em 'n'
 * @param n num
 */
var controlMioma;
controlMioma = function(n) {
	var a, b, bn, i;

	a = document.getElementById('dynf');
	b = a.getElementsByClassName('mioma');
	bn = b.length;

	if (n > bn)
		for (i = n - bn; i--; )
			createMioma(a, b);
	else if (n < bn)
		for (i = bn - n; i--; )
			removeMioma(a, b);
};

/**
 * Trata valor de input que recebe número de elementos do Mioma
 */
var numberMioma;
numberMioma = function() {
	if (!isNaN(this.value)) {
		var n = parseInt(this.value);

		if (n >= 0)
			controlMioma(n);
	}
};

/**
 * Executa a formula para retornar o IMC
 * @param a peso (kg)
 * @param b altura (m)
 * return imc
 */
var calcIMC;
calcIMC = function(a, b) {
	pushResponse(true, false, true);
	return parseFloat(a / Math.pow(b, 2)).toFixed(2);
};

/**
 * Faz alteração do valor do campo IMC baseado na função calcIMC(a, b)
 * Recebe eventTarget
 */
var getIMC;
getIMC = function() {
	var a = document.getElementById('exameFisico_peso').value;
	var b = document.getElementById('exameFisico_altura').value;

	if (!isNaN(a) || !isNaN(b)) {
		a = parseInt(a);
		b = parseInt(b);

		c = calcIMC(a, b / 100);

		if ((c < 18.49) || (c > 25))
			if ((c < 17) || (c > 30))
				this.className = 'font-red-900';
			else this.className = 'font-red';
		else this.className = 'font-green';

		this.value = c;
	}
};

/**
 * Faz o processo de distinct se o valor de b for superior a 0
 * @param a super parent
 * @param b value
 * @param c className
 */
var doDistinctRadio;
doDistinctRadio = function(a, b, c) {
	var n;
	if (!isNaN(b)) {
		n = parseInt(b);

		if (n > 0)
			a.classList.add(c);
		else a.classList.remove(c);
	}
};

/**
 * Obtem o super parent e o valor do radio
 */
var distinctRadio;
distinctRadio = function(a) {
	var b, c;
	b = a.target.parentNode.parentNode;
	c = a.target.c;
	doDistinctRadio(b, a.target.value, c);
};

/**
 * Recebe lista de itens e adiciona o eventListener e também verifica se radios estão ativos
 * @param a nodeList
 * @param c className
 */
var addDistinctRadio;
addDistinctRadio = function(a, c) {
	var b;
	for (var i = a.length; i--; ) {
		a[i].addEventListener('change', distinctRadio);
		a[i].c = c;
		if (a[i].checked) {
			b = a[i].parentNode.parentNode;
			doDistinctRadio(b, a[i].value, c);
		}
	}
};

/**
 * EXTERNAL FUNCTIONS
 */

// villa distinct
+function ($) {
	'use strict';

	/* Constructor of distinct functions */
	$.fn.distinct = function (options, events) {

		var settings = $.extend({
			prefix: false,
			target: 'body'
		}, options);

		var handle = function () {
			$(settings.target).removeClassLike(settings.prefix);
			$(settings.target).addClass(this.id);
		};

		for (var a = this.length; a--;)
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