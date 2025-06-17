<?php

session_start(); // iniciando a sessão

require_once 'includes/funcoes.php'; // caminho p 'funcoes.php' dentro da pasta 'includes'
require_once 'includes/conexao.php';

if (function_exists('tratar_erros')) {
    tratar_erros();
}

// verificar se o formulário foi enviado via GET sem dados POST
if (!isset($_POST['usuario']) || !isset($_POST['senha']) || !isset($_POST['matricula'])) {
    header('location:index.php?code=0'); // voolta p a 'index' quando formulario nao enviado
    exit;
}

$usuario   = $_POST['usuario'];
$senha     = $_POST['senha'];
$matricula = $_POST['matricula'];

// verifica se há campos em branco
if (empty($usuario) || empty($senha) || empty($matricula)) {
    header('location:index.php?code=2'); // volta p a 'index' quando campo em branco
    exit;
}

$conn = conectar_banco(); // conexao com o banco de dados atraves 'funcoes.php'

// verificar o funcionário com usuário, senha e matrícula
$query = "SELECT id, usuario, senha, matricula, email FROM tb_funcionarios WHERE usuario = ? AND senha = ? AND matricula = ?";

$stmt = mysqli_prepare($conn, $query);

if (!$stmt) {
    header('location:index.php?code=3'); // volta p 'index' quando erro de preparar consulta
    exit;
}

// associa os parâmetros à consulta preparada
mysqli_stmt_bind_param($stmt, 'sss', $usuario, $senha, $matricula); // 'sss' para três strings

// executa a consulta
if (!mysqli_execute($stmt)) {
    header('location:index.php?code=4'); // volta p 'index' quando erro de execução
    exit;
}

// o statement registra o número de linhas afetadas
mysqli_stmt_store_result($stmt);

// armazena número de linhas afetadas pelo statement
$linhas = mysqli_stmt_num_rows($stmt);

// linhas <= 0  == usuário, senha ou matrícula invalidos
if ($linhas <= 0) {
    header('location:index.php?code=1'); // volta p 'index' quando dados invalidos
    exit;
}

// associando resultado do select às variáveis
mysqli_stmt_bind_result($stmt, $id, $usuario, $senha, $matricula_db, $email);
mysqli_stmt_fetch($stmt); // guarda os valores do select nas variáveis

$_SESSION['id']        = $id;
$_SESSION['usuario']   = $usuario;
$_SESSION['senha']     = $senha;
$_SESSION['matricula'] = $matricula_db; // armazena a matrícula recuperada do banco
$_SESSION['email']     = $email;

header('location:dashboard.php'); // direcionado para dashboard após o login bem-sucedido

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$conexao = conectar_banco();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario'], $_POST['senha'])) {

    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $sql = "SELECT id, senha FROM tb_funcionarios WHERE usuario = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 's', $usuario);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) === 1) {
        mysqli_stmt_bind_result($stmt, $id_usuario, $senha_banco);
        mysqli_stmt_fetch($stmt);

        if ($senha === $senha_banco) {
            $_SESSION['id_usuario'] = $id_usuario;
            $_SESSION['usuario'] = $usuario;

            echo "<script>alert('Login efetuado com sucesso!'); window.location.href='dashboard.php';</script>";
            exit;
        } else {
            echo "<script>alert('Senha incorreta.'); history.back();</script>";
        }
    } else {
        echo "<script>alert('Usuário não encontrado.'); history.back();</script>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    exit;
}
?>
