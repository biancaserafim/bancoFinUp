<?php
require_once "../bd/conexaoBD.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];
    $descricao = $_POST["descricao"];

    $sql = "UPDATE tabela2 SET descricao = '$descricao' WHERE id = '$id'";
    $conexao->exec($sql);

    header("Location: consulta_tabela2.php");
    exit;

} else {

    $id = $_GET["id"];

    $sql = "SELECT * FROM tabela2 WHERE id = '$id'";
    $result = $conexao->query($sql)->fetch();
}
?>

<form method="post">
    <input type="hidden" name="id" value="<?= $result['id'] ?>">

    Descrição:
    <input type="text" name="descricao" value="<?= $result['descricao'] ?>"><br><br>

    <button type="submit">Atualizar</button>
</form>
