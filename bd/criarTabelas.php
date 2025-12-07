<?php
require_once "conexaoBD.php";

/* ============================
   TABELA 1
============================ */
$sql1 = "
CREATE TABLE IF NOT EXISTS tabela1 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
)";
$conexao->exec($sql1);
echo "Tabela 1 criada com sucesso.<br>";

/* ============================
   TABELA 2
============================ */
$sql2 = "
CREATE TABLE IF NOT EXISTS tabela2 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(100) NOT NULL
)";
$conexao->exec($sql2);
echo "Tabela 2 criada com sucesso.<br>";

/* ============================
   TABELA 3 (COM CHAVE ESTRANGEIRA)
============================ */
$sql3 = "
CREATE TABLE IF NOT EXISTS tabela3 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_tabela1 INT NOT NULL,
    campo2 VARCHAR(50) NOT NULL,
    campo3 VARCHAR(100),
    FOREIGN KEY (id_tabela1) REFERENCES tabela1(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)";
$conexao->exec($sql3);
echo "Tabela 3 criada com sucesso.<br>";
?>
