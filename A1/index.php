<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aquario Lemes</title>
    
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.6/dist/cerulean/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="estilo.css">
</head>
<body class="container">

    <h1>Aquario Lemes</h1>
    <h2>Para prosseguir, efetue o login</h2>

    <?php
        require_once 'includes/funcoes.php';

        if (function_exists('tratar_erros')) {
            tratar_erros();
        }
    ?>

    <form action="verificar.php" method="post">
        <p>
            <label for="usuario">Usuário:</label><br>
            <input type="text" name="usuario" id="usuario" class="form-control" required>
        </p>

        <p>
            <label for="senha">Senha:</label><br>
            <input type="password" name="senha" id="senha" class="form-control" required>
        </p>

        <p>
            <label for="matricula">Número da Matrícula:</label><br>
            <input type="text" name="matricula" id="matricula" class="form-control" required>
        </p>

        <button type="submit" class="btn btn-success">Entrar</button>
    </form>

    <!-- JavaScript do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
