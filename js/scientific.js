/*!
 * Magma Scientific Client Functions v1.7.0 (http://getvilla.org/)
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

var buildTypeNote = function (a, b) {
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