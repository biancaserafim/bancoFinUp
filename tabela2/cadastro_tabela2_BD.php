<?php
require_once "../bd/conexaoBD.php";

$descricao = $_POST["descricao"];

$sql = "INSERT INTO tabela2 (descricao) VALUES ('$descricao')";
$conexao->exec($sql);

header("Location: consulta_tabela2.php");
exit;
?>
