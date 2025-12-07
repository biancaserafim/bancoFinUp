<?php
require_once "../bd/conexaoBD.php";

$nome  = $_POST["nome"];
$email = $_POST["email"];
$senha = $_POST["senha"];
$cpf   = $_POST["cpf"];
$sexo  = $_POST["sexo"];
$data  = $_POST["nascimento"];

$sql = "INSERT INTO tabela1 
(nome, email, senha, cpf, sexo, data_nascimento)
VALUES 
('$nome', '$email', '$senha', '$cpf', '$sexo', '$data')";

$conexao->exec($sql);

header("Location: ../tabela1/consulta_tabela1.php");
exit;
?>
