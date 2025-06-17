<?php
session_start(); // inicia a sessão 

require_once "includes/conexao.php";
require_once "seguranca.php";

// conexão com o banco de dados.
$conexao = conectar_banco();

// peixe a ser removido da URL (GET).
$id = $_GET['id'];
$sql = "DELETE FROM tb_peixes WHERE id_peixe = $id";

// executa a consulta SQL.
if (mysqli_query($conexao, $sql)) {
    echo "<script>alert('Peixe removido com sucesso!'); window.location.href='dashboard.php';</script>";
} else {
    // erro na remoção, exibe um alerta e volta para a página anterior.
    echo "<script>alert('Erro ao remover peixe.'); history.back();</script>";
}
?>
