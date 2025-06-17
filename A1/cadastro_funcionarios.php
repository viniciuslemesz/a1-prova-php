<?php
require_once "includes/conexao.php";

$conexao = conectar_banco();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario'], $_POST['senha'], $_POST['matricula'], $_POST['email'])) {

    $usuario   = $_POST['usuario'];
    $senha     = $_POST['senha'];
    $matricula = $_POST['matricula'];
    $email     = $_POST['email'];

    $sql = "INSERT INTO tb_funcionarios (usuario, senha, matricula, email) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssss', $usuario, $senha, $matricula, $email);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Funcionário cadastrado com sucesso!'); window.location.href='index.php';</script>";
        } else {
            if (mysqli_errno($conexao) == 1062) {
                echo "<script>alert('Erro: Matrícula já cadastrada.'); history.back();</script>";
            } else {
                echo "<script>alert('Erro ao cadastrar funcionário: " . mysqli_error($conexao) . "'); history.back();</script>";
            }
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Erro ao preparar o cadastro do funcionário.'); history.back();</script>";
    }

    mysqli_close($conexao);
    exit;
}

echo "<script>alert('Requisição inválida.'); history.back();</script>";
exit;
?>
