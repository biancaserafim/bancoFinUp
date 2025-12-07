<?php
require_once "../bd/conexaoBD.php";

$id = $_GET['id'];

$sql = "SELECT * FROM tabela3 WHERE id = $id";
$stmt = $conexao->query($sql);
$dados = $stmt->fetch(PDO::FETCH_ASSOC);

$sqlUsuarios = "SELECT * FROM tabela1";
$usuarios = $conexao->query($sqlUsuarios);
?>

<h2>Editar Transação</h2>

<form action="editar_tabela3_BD.php" method="post">

    <input type="hidden" name="id" value="<?= $dados['id'] ?>">

    <label>Usuário:</label>
    <select name="id_tabela1" required>
        <?php foreach ($usuarios as $u) { ?>
            <option value="<?= $u['id'] ?>"
                <?= $u['id'] == $dados['id_tabela1'] ? 'selected' : '' ?>>
                <?= $u['nome'] ?>
            </option>
        <?php } ?>
    </select>
    <br><br>

    <label>Tipo:</label>
    <input type="text" name="tipo" value="<?= $dados['tipo'] ?>" required>
    <br><br>

    <label>Descrição:</label>
    <input type="text" name="descricao" value="<?= $dados['descricao'] ?>" required>
    <br><br>

    <label>Valor:</label>
    <input type="number" step="0.01" name="valor" value="<?= $dados['valor'] ?>" required>
    <br><br>

    <label>Data:</label>
    <input type="date" name="data" value="<?= $dados['data'] ?>" required>
    <br><br>

    <button type="submit">Atualizar</button>

</form>
