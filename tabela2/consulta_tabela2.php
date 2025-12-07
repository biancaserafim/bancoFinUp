<?php
require_once "../bd/conexaoBD.php";

$sql = "SELECT * FROM tabela2";
$result = $conexao->query($sql);
?>

<h2>Lista da Tabela 2</h2>

<a href="cadastro_tabela2.html">Novo Cadastro</a>
<hr>

<?php
foreach ($result as $linha) {
    echo "ID: " . $linha["id"] . "<br>";
    echo "Descrição: " . $linha["descricao"] . "<br>";

    echo "<a href='editar_tabela2.php?id=" . $linha["id"] . "'>Editar</a> | ";
    echo "<a href='excluir_tabela2.php?id=" . $linha["id"] . "'>Excluir</a>";
    echo "<hr>";
}
?>
