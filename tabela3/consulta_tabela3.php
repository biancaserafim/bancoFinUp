<?php
require_once "../bd/conexaoBD.php";

$sql = "
SELECT 
    tabela3.id,
    tabela1.nome AS usuario,
    tabela3.tipo,
    tabela3.descricao,
    tabela3.valor,
    tabela3.data
FROM tabela3
INNER JOIN tabela1 ON tabela3.id_tabela1 = tabela1.id
";

$result = $conexao->query($sql);
?>

<h2>Lista de Transações</h2>

<a href="cadastro_tabela3.php">Nova Transação</a>
<hr>

<?php foreach ($result as $linha) { ?>

    <b>ID:</b> <?= $linha["id"] ?><br>
    <b>Usuário:</b> <?= $linha["usuario"] ?><br>
    <b>Tipo:</b> <?= $linha["tipo"] ?><br>
    <b>Descrição:</b> <?= $linha["descricao"] ?><br>
    <b>Valor:</b> R$ <?= number_format($linha["valor"], 2, ',', '.') ?><br>
    <b>Data:</b> <?= date('d/m/Y', strtotime($linha["data"])) ?><br>

    <a href="editar_tabela3.php?id=<?= $linha['id'] ?>">Editar</a> |
    <a href="excluir_tabela3.php?id=<?= $linha['id'] ?>">Excluir</a>

    <hr>

<?php } ?>
