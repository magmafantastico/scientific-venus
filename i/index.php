<?php

header('Content-Type: text/html; charset=utf-8');

/*$a = '{"prontuario":{"_id":"111","data":"2015-05-15"},"paciente":{"nome":"Dudu","sexo":"Masculino","nascimento":"2015-11-26","religiao":"Outro","religiaoNote":"agnostico","etnia":"Branco","etniaNote":false,"escolaridade":"Superior","escolaridadeNote":false,"estadoCivil":"Solteiro(a)","estadoCivilNote":false},"exameFisico":{"peso":"72.00","altura":"1.74","imc":"1.50","pressaoArterial":"12.5","circunferenciaAbdominal":"60","circunferenciaCervical":"69.5"},"antecedentes":{"situacaoAborto":false,"situacaoGestacao":false,"situacaoParidade":true,"tabagismo":false,"hac":"true","hacType":"Descompensado","diabetes":"true","diabetesType":"Compensado","hipotireoidismo":"false","hipotireoidismoTYpe":false,"note":"Isso é apenas um teste"},"uteroMioma":{"us":false,"volumeInterino":false,"ovarioDireito":false,"ovarioEsquerdo":false,"endometro":false,"miomaQuantidade":false,"mioma_1_caracteristicas":false,"mioma_1_type":false,"mioma_2_caracteristicas":false,"mioma_2_type":false,"nd":false},"sangramento":{"pbacInicial":false},"escalas":{"beckInicial":false,"vidaMioma":false},"exames":{"ht":false,"ferro":false,"ferritina":false,"rdw":false,"vcm":false,"vitaminaD3":false,"tsh":false,"gj":false,"ct":false,"ldl":false,"hdl":false,"t4l":false},"conduta":{"conduta":false,"cirurgia":false,"hormonioTerapia":false,"hormonioTerapiaCiclico":false,"hormonioTerapiaContinuo":false,"ainh":false},"resultados":{"pbacFinal":false,"beckFinal":false,"vidaMioma":false}}';*/
$a = $_POST['response'];
$b = json_decode($a);

$mysqli = new mysqli("localhost", "root", "sux", "scientific_venus");

if ($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
} else {
	echo "connection ok! /n/n";
}

if (!$mysqli->query("INSERT INTO paciente(
	nome,
    sexo,
    nascimento,
    religiao,
    religiaoNote,
    etnia,
    etniaNote,
    escolaridade,
    escolaridadeNote,
    estadoCivil,
    estadoCivilNote) VALUES ('" .
	$b->paciente->nome . "', '" .
	$b->paciente->sexo . "', '" .
	$b->paciente->nascimento . "', '" .
	$b->paciente->religiao . "', '" .
	$b->paciente->religiaoNote . "', '" .
	$b->paciente->etnia . "', '" .
	$b->paciente->etniaNote . "', '" .
	$b->paciente->escolaridade . "', '" .
	$b->paciente->escolaridadeNote . "', '" .
	$b->paciente->estadoCivil . "', '" .
	$b->paciente->estadoCivilNote . "')"))
	echo "Insert failed: (" . $mysqli->errno . ") " . $mysqli->error . "/n";

$paciente_id = $mysqli->insert_id;

echo("Last inserted record has id: " . $paciente_id . "/n");

if (!$mysqli->query("INSERT INTO prontuario(data, paciente_id) VALUES ('" .
	$b->prontuario->data . "', '" .
	$paciente_id . "')"))
	echo "Insert failed: (" . $mysqli->errno . ") " . $mysqli->error . "/n";

$prontuario_id = $mysqli->insert_id;

echo("Last inserted record has id: " . $prontuario_id . "/n");

if (!$mysqli->query("INSERT INTO consulta(data, prontuario_id) VALUES ('" .
	$b->prontuario->data . "', '" .
	$prontuario_id . "')"))
	echo "Insert failed: (" . $mysqli->errno . ") " . $mysqli->error . "/n";

$consulta_id = $mysqli->insert_id;

echo("Last inserted record has id: " . $prontuario_id . "/n");

if (!$mysqli->query("INSERT INTO exameFisico(
	consulta_id,
    peso,
    altura,
    imc,
    pressaoArterial,
    circunferenciaAbdominal,
    circunferenciaCervical) VALUES (" .
	$consulta_id . ", " .
	$b->exameFisico->peso . ", " .
	$b->exameFisico->altura . ", " .
	$b->exameFisico->imc . ", " .
	$b->exameFisico->pressaoArterial . ", " .
	$b->exameFisico->circunferenciaAbdominal . ", " .
	$b->exameFisico->circunferenciaCervical . ")"))
	echo "Insert failed: (" . $mysqli->errno . ") " . $mysqli->error . "/n";

if (!$mysqli->query("INSERT INTO antecedentes(
	consulta_id,
	situacaoAborto,
    situacaoGestacao,
    situacaoParidade,
    tabagismo,
    hac,
    hacType,
    diabetes,
    diabetesType,
    hipotireoidismo,
    hipotireoidismoType,
    note) VALUES ('" .
	$consulta_id . "', '" .
	$b->antecedentes->situacaoAborto . "', '" .
	$b->antecedentes->situacaoGestacao . "', '" .
	$b->antecedentes->situacaoParidade . "', '" .
	$b->antecedentes->tabagismo . "', '" .
	$b->antecedentes->hac . "', '" .
	$b->antecedentes->hacType . "', '" .
	$b->antecedentes->diabetes . "', '" .
	$b->antecedentes->diabetesType . "', '" .
	$b->antecedentes->hipotireoidismo . "', '" .
	$b->antecedentes->hipotireoidismoType . "', '" .
	$b->antecedentes->note . "')"))
	echo "Insert failed: (" . $mysqli->errno . ") " . $mysqli->error . "/n";

if (!$mysqli->query("INSERT INTO uteroMioma(
	consulta_id,
	us,
    volumeInterino,
    ovarioDireito,
    ovarioEsquerdo,
    endometro,
    miomaQuantidade,
    mioma_1_caracteristicas,
    mioma_1_submucoso,
    mioma_1_subseroso,
    mioma_1_intramural,
    mioma_2_caracteristicas,
    mioma_2_submucoso,
    mioma_2_subseroso,
    mioma_2_intramural,
    nd) VALUES ('" .
	$consulta_id . "', '" .
	$b->uteroMioma->us . "', '" .
	$b->uteroMioma->volumeInterino . "', '" .
	$b->uteroMioma->ovarioDireito . "', '" .
	$b->uteroMioma->ovarioEsquerdo . "', '" .
	$b->uteroMioma->endometro . "', '" .
	$b->uteroMioma->miomaQuantidade . "', '" .
	$b->uteroMioma->mioma_1_caracteristicas . "', '" .
	$b->uteroMioma->mioma_1_submucoso . "', '" .
	$b->uteroMioma->mioma_1_subseroso . "', '" .
	$b->uteroMioma->mioma_1_intramural . "', '" .
	$b->uteroMioma->mioma_2_caracteristicas . "', '" .
	$b->uteroMioma->mioma_2_submucoso . "', '" .
	$b->uteroMioma->mioma_2_subseroso . "', '" .
	$b->uteroMioma->mioma_2_intramural . "', '" .
	$b->uteroMioma->nd . "')"))
	echo "Insert failed: (" . $mysqli->errno . ") " . $mysqli->error . "/n";

if (!$mysqli->query("INSERT INTO sangramento(
	consulta_id,
    pbacInicial) VALUES ('" .
	$consulta_id . "', '" .
	$b->sangramento->pbacInicial . "')"))
	echo "Insert failed: (" . $mysqli->errno . ") " . $mysqli->error . "/n";

if (!$mysqli->query("INSERT INTO escalas(
	consulta_id,
    beckInicial,
    vidaMioma) VALUES ('" .
	$consulta_id . "', '" .
	$b->escalas->beckInicial . "', '" .
	$b->escalas->vidaMioma . "')"))
	echo "Insert failed: (" . $mysqli->errno . ") " . $mysqli->error . "/n";

if (!$mysqli->query("INSERT INTO exames(
	consulta_id,
	hb,
    ht,
    ferro,
    ferritina,
    rdw,
    vcm,
    vitaminaD3,
    tsh,
    gj,
    ct,
    ldl,
    hdl,
    t4l) VALUES ('" .
	$consulta_id . "', '" .
	$b->exames->hb . "', '" .
	$b->exames->ht . "', '" .
	$b->exames->ferro . "', '" .
	$b->exames->ferritina . "', '" .
	$b->exames->rdw . "', '" .
	$b->exames->vcm . "', '" .
	$b->exames->vitaminaD3 . "', '" .
	$b->exames->tsh . "', '" .
	$b->exames->gj . "', '" .
	$b->exames->ct . "', '" .
	$b->exames->ldl . "', '" .
	$b->exames->hdl . "', '" .
	$b->exames->t4l . "')"))
	echo "Insert failed: (" . $mysqli->errno . ") " . $mysqli->error . "/n";

if (!$mysqli->query("INSERT INTO conduta(
	consulta_id,
	conduta,
    cirurgia,
    hormonioTerapia,
    hormonioTerapiaCiclico,
    hormonioTerapiaContinuo,
    hormonioTerapiaNome,
    ainh) VALUES ('" .
	$consulta_id . "', '" .
	$b->conduta->conduta . "', '" .
	$b->conduta->cirurgia . "', '" .
	$b->conduta->hormonioTerapia . "', '" .
	$b->conduta->hormonioTerapiaCiclico . "', '" .
	$b->conduta->hormonioTerapiaContinuo . "', '" .
	$b->conduta->hormonioTerapiaNome . "', '" .
	$b->conduta->ainh . "')"))
	echo "Insert failed: (" . $mysqli->errno . ") " . $mysqli->error . "/n";

if (!$mysqli->query("INSERT INTO resultados(
	consulta_id,
    pbacFinal,
    beckFinal,
    vidaMioma) VALUES ('" .
	$consulta_id . "', '" .
	$b->resultados->pbacFinal . "', '" .
	$b->resultados->beckFinal . "', '" .
	$b->resultados->vidaMioma . "')"))
	echo "Insert failed: (" . $mysqli->errno . ") " . $mysqli->error . "/n";

$res = $mysqli->query("SELECT _id FROM paciente");

echo "Reverse order:/n";
for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
	$res->data_seek($row_no);
	$row = $res->fetch_assoc();
	echo $row['_id'] . "/n";
}