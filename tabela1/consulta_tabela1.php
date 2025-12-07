<?php
require_once "../bd/conexaoBD.php";

$sql = "SELECT * FROM tabela1";
$result = $conexao->query($sql);
?>

<h2>Lista de Usuários</h2>

<a href="cadastro_tabela1.html">Novo Cadastro</a>
<hr>

<?php
foreach ($result as $linha) {

    echo "<b>ID:</b> " . $linha["id"] . "<br>";
    echo "<b>Nome:</b> " . $linha["nome"] . "<br>";
    echo "<b>Email:</b> " . $linha["email"] . "<br>";
    echo "<b>CPF:</b> " . $linha["cpf"] . "<br>";
    echo "<b>Sexo:</b> " . $linha["sexo"] . "<br>";
    echo "<b>Data de Nascimento:</b> " . $linha["data_nascimento"] . "<br>";

    echo "<a href='editar_tabela1.php?id=" . $linha["id"] . "'>Editar</a> | ";
    echo "<a href='excluir_tabela1.php?id=" . $linha["id"] . "'>Excluir</a>";

    echo "<hr>";
}
?>
