<?php
require_once "includes/conexao.php";


$conexao = conectar_banco();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Funcionários</title>

    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.6/dist/cerulean/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilo.css">
</head>
<body class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary">Cadastrar Funcionário</h1>
        <a href="logout.php" class="btn btn-danger">Sair</a>
    </div>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Novo Funcionário</h2>
        </div>
        <div class="card-body">
            <form action="cadastro_funcionarios.php" method="POST">
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuário</label>
                    <input type="text" name="usuario" id="usuario" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" name="senha" id="senha" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="matricula" class="form-label">Matrícula</label>
                    <input type="text" name="matricula" id="matricula" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
