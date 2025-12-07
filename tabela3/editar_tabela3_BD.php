<?php
require_once "../bd/conexaoBD.php";

$id = $_POST['id'];
$id_tabela1 = $_POST['id_tabela1'];
$tipo = $_POST['tipo'];
$descricao = $_POST['descricao'];
$valor = $_POST['valor'];
$data = $_POST['data'];

$sql = "
UPDATE tabela3 SET
    id_tabela1 = :id_tabela1,
    tipo = :tipo,
    descricao = :descricao,
    valor = :valor,
    data = :data
WHERE id = :id
";

$stmt = $conexao->prepare($sql);

$stmt->bindParam(':id_tabela1', $id_tabela1);
$stmt->bindParam(':tipo', $tipo);
$stmt->bindParam(':descricao', $descricao);
$stmt->bindParam(':valor', $valor);
$stmt->bindParam(':data', $data);
$stmt->bindParam(':id', $id);

$stmt->execute();

header("Location: ../consultatransacoes.php");
exit;
