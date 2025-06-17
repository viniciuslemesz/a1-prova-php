<?php
require_once "includes/conexao.php";
require_once "seguranca.php";

session_start(); // Garante que a sessão foi iniciada

if (!isset($_SESSION['id'])) {
    echo "<script>alert('Você precisa estar logado.'); window.location.href='index.php';</script>";
    exit;
}

$conexao = conectar_banco(); 
$nome_comum = $_POST['nome_comum'];
$nome_cientifico = $_POST['nome_cientifico'];
$especie = $_POST['especie'];
$habitat = $_POST['habitat'];
$data_chegada = $_POST['data_chegada'];

$id_funcionario = $_SESSION['id_usuario'];

$sql = "INSERT INTO tb_peixes (nome_comum, nome_cientifico, especie, habitat, data_chegada, responsavel_cadastro)
        VALUES ('$nome_comum', '$nome_cientifico', '$especie', '$habitat', '$data_chegada', '$id_funcionario')";

if (mysqli_query($conexao, $sql)) {
    echo "<script>alert('Peixe cadastrado com sucesso!'); window.location.href='dashboard.php';</script>";
} else {
    echo "<script>alert('Erro ao cadastrar peixe.'); history.back();</script>";
}
?>
