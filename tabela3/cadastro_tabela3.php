<?php
require_once "../bd/conexaoBD.php";

// Pega automaticamente o ÚLTIMO usuário cadastrado
$sqlUsuario = "SELECT id FROM tabela1 ORDER BY id DESC LIMIT 1";
$usuario = $conexao->query($sqlUsuario)->fetch(PDO::FETCH_ASSOC);
$id_usuario = $usuario['id'];
?>

<h2>Cadastro de Transação</h2>

<form action="cadastro_tabela3_BD.php" method="post">

    <!-- Usuário oculto (não aparece no front) -->
    <input type="hidden" name="id_tabela1" value="<?= $id_usuario ?>">

    <label>Tipo:</label>
    <input type="text" name="tipo" placeholder="Ex: Entrada / Saída" required>
    <br><br>

    <label>Descrição:</label>
    <input type="text" name="descricao" placeholder="Ex: Mercado, Aluguel..." required>
    <br><br>

    <label>Valor:</label>
    <input type="number" step="0.01" name="valor" required>
    <br><br>

    <label>Data:</label>
    <input type="date" name="data" required>
    <br><br>

    <button type="submit">Salvar</button>

</form>

<br>
<a href="../consultatransacoes.php">Ver Transações</a>
