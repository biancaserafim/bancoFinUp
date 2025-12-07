<?php
require_once "../bd/conexaoBD.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];
    $nome = $_POST["nome"];

    $sql = "UPDATE tabela1 SET nome = '$nome' WHERE id = '$id'";
    $conexao->exec($sql);

    header("Location: consulta_tabela1.php");
    exit;

} else {

    $id = $_GET["id"];

    $sql = "SELECT * FROM tabela1 WHERE id = '$id'";
    $result = $conexao->query($sql)->fetch();
}
?>

<form method="post">
    <input type="hidden" name="id" value="<?= $result['id'] ?>">

    Nome:
    <input type="text" name="nome" value="<?= $result['nome'] ?>"><br><br>

    <button type="submit">Atualizar</button>
</form>
