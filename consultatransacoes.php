<?php
require_once "bd/conexaoBD.php";

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

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Transações - FinUp</title>
    <link rel="icon" href="Images/FinUp.png" type="image/png">
    <link rel="stylesheet" href="consultatran.css">
</head>

<body>

<header class="header">
    <img class="logo" src="Images/FinUp.png" alt="Logo FinUp">
    <nav>
        <ul class="main-nav">
            <li><a href="index.html">Início</a></li>
            <li><a href="consultaextrato.html">Extrato</a></li>
            <li><a class="ativo" href="consultatransacoes.php">Transações</a></li>
        </ul>
    </nav>
</header>

<main class="transacoes">
    <section class="transacoes-section">
        <h1>Suas Transações</h1>
        <p class="descricao-transacoes">Visualize suas movimentações financeiras.</p>

        <div class="filtro-transacoes">
            <a href="tabela3/cadastro_tabela3.php">
                <button class="adicionar-transacao">Adicionar Nova Transação</button>
            </a>
        </div>

        <div class="tabela-container">
            <table class="tabela-transacoes">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuário</th>
                        <th>Tipo</th>
                        <th>Descrição</th>
                        <th>Valor</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $linha) { ?>
                        <tr>
                            <td><?= $linha["id"] ?></td>
                            <td><?= htmlspecialchars($linha["usuario"]) ?></td>
                            <td><?= htmlspecialchars($linha["tipo"]) ?></td>
                            <td><?= htmlspecialchars($linha["descricao"]) ?></td>
                            <td>R$ <?= number_format($linha["valor"], 2, ',', '.') ?></td>
                            <td><?= date('d/m/Y', strtotime($linha["data"])) ?></td>
                            <td>
                                <a href="tabela3/editar_tabela3.php?id=<?= $linha['id'] ?>">Editar</a> |
                                <a href="tabela3/excluir_tabela3.php?id=<?= $linha['id'] ?>">Excluir</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<footer class="rodape">
    <p>Desenvolvido por: Bianca Serafim, Ruan Viana</p>
</footer>

</body>
</html>
