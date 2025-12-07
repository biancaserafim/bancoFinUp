<?php
require_once "../bd/conexaoBD.php";

$id = $_GET["id"];

$sql = "DELETE FROM tabela2 WHERE id = '$id'";
$conexao->exec($sql);

header("Location: consulta_tabela2.php");
exit;
?>
