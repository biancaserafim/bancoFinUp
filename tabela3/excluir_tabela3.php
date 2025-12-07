<?php
require_once "../bd/conexaoBD.php";

$id = $_GET["id"];

$sql = "DELETE FROM tabela3 WHERE id = '$id'";
$conexao->exec($sql);

header("Location: consulta_tabela3.php");
exit;
?>
