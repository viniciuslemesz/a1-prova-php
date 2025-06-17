<?php
require_once "includes/conexao.php";
require_once "seguranca.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$conexao = conectar_banco();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome_comum'], $_POST['data_chegada'])) {

    if (!isset($_SESSION['id_usuario'])) {
        echo "<script>alert('Você precisa estar logado.'); window.location.href='index.php';</script>";
        exit;
    }

    $nome_comum      = $_POST['nome_comum'];
    $nome_cientifico = $_POST['nome_cientifico'] ?? '';
    $especie         = $_POST['especie'] ?? '';
    $habitat         = $_POST['habitat'] ?? '';
    $data_chegada    = $_POST['data_chegada'];
    $id_funcionario  = $_SESSION['id_usuario'];

    $sql = "INSERT INTO tb_peixes (nome_comum, nome_cientifico, especie, habitat, data_chegada, responsavel_cadastro)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conexao, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'sssssi', $nome_comum, $nome_cientifico, $especie, $habitat, $data_chegada, $id_funcionario);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Peixe cadastrado com sucesso!'); window.location.href='dashboard.php';</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar peixe: " . mysqli_error($conexao) . "'); history.back();</script>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Erro ao preparar o cadastro do peixe.'); history.back();</script>";
    }

    mysqli_close($conexao);
    exit;
}

echo "<script>alert('Requisição inválida.'); history.back();</script>";
exit;
?>
