<?php

header('Content-Type: text/html; charset=utf-8');

$a = '{"prontuario":{"_id":"111","data":"2015-05-15"},"paciente":{"nome":"Dudu","sexo":"Masculino","nascimento":"2015-11-26","religiao":"Outro","religiaoNote":"agnostico","etnia":"Branco","etniaNote":false,"escolaridade":"Superior","escolaridadeNote":false,"estadoCivil":"Solteiro(a)","estadoCivilNote":false},"exameFisico":{"peso":"72.00","altura":"1.74","imc":"1.50","pressaoArterial":"12.5","circunferenciaAbdominal":"60","circunferenciaCervical":"69.5"},"antecedentes":{"situacaoAborto":false,"situacaoGestacao":false,"situacaoParidade":true,"tabagismo":false,"hac":"true","hacType":"Descompensado","diabetes":"true","diabetesType":"Compensado","hipotireoidismo":"false","hipotireoidismoTYpe":false,"note":"Isso é apenas um teste"},"uteroMioma":{"us":false,"volumeInterino":false,"ovarioDireito":false,"ovarioEsquerdo":false,"endometro":false,"miomaQuantidade":false,"mioma_1_caracteristicas":false,"mioma_1_type":false,"mioma_2_caracteristicas":false,"mioma_2_type":false,"nd":false},"sangramento":{"pbacInicial":false},"escalas":{"beckInicial":false,"vidaMioma":false},"exames":{"ht":false,"ferro":false,"ferritina":false,"rdw":false,"vcm":false,"vitaminaD3":false,"tsh":false,"gj":false,"ct":false,"ldl":false,"hdl":false,"t4l":false},"conduta":{"conduta":false,"cirurgia":false,"hormonioTerapia":false,"hormonioTerapiaCiclico":false,"hormonioTerapiaContinuo":false,"ainh":false},"resultados":{"pbacFinal":false,"beckFinal":false,"vidaMioma":false}}';
$b = json_decode($a);
echo gettype($b);
echo "<br/>";
echo $b->paciente->nome;
echo "<br/>";
echo "<br/>";

$mysqli = new mysqli("localhost", "root", "sux", "scientific_venus");

if ($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
} else {
	echo "connection ok! <br/><br/>";
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
	echo "Insert failed: (" . $mysqli->errno . ") " . $mysqli->error . "<br/>";

$paciente_id = $mysqli->insert_id;

echo("Last inserted record has id: " . $paciente_id . "<br/>");

if (!$mysqli->query("INSERT INTO prontuario(data, paciente_id) VALUES ('" .
	$b->prontuario->data . "', '" .
	$paciente_id . "')"))
	echo "Insert failed: (" . $mysqli->errno . ") " . $mysqli->error . "<br/>";

$prontuario_id = $mysqli->insert_id;

echo("Last inserted record has id: " . $prontuario_id . "<br/>");

if (!$mysqli->query("INSERT INTO exameFisico(
	prontuario_id,
    peso,
    altura,
    imc,
    pressaoArterial,
    circunferenciaAbdominal,
    circunferenciaCervical) VALUES (" .
	$prontuario_id . ", " .
	$b->exameFisico->peso . ", " .
	$b->exameFisico->altura . ", " .
	$b->exameFisico->imc . ", " .
	$b->exameFisico->pressaoArterial . ", " .
	$b->exameFisico->circunferenciaAbdominal . ", " .
	$b->exameFisico->circunferenciaCervical . ")"))
	echo "Insert failed: (" . $mysqli->errno . ") " . $mysqli->error . "<br/>";

if (!$mysqli->query("INSERT INTO antecedentes(
	prontuario_id,
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
	$prontuario_id . "', '" .
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
	echo "Insert failed: (" . $mysqli->errno . ") " . $mysqli->error . "<br/>";

$res = $mysqli->query("SELECT _id FROM paciente");

echo "Reverse order:<br/>";
for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
	$res->data_seek($row_no);
	$row = $res->fetch_assoc();
	echo $row['_id'] . "<br/>";
}

?>