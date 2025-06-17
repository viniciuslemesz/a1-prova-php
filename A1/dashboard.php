<?php
require_once "includes/conexao.php";
require_once "seguranca.php";

$conexao = conectar_banco();

$sql = "SELECT * FROM tb_peixes";
$resultado = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.6/dist/cerulean/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="estilo.css">
</head>
<body class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary">Peixes Cadastrados</h1>
        <a href="logout.php" class="btn btn-danger">Sair</a>
    </div>

    <div class="table-responsive mb-5">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Nome Comum</th>
                    <th>Nome Científico</th>
                    <th>Espécie</th>
                    <th>Habitat</th>
                    <th>Data de Chegada</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($peixe = mysqli_fetch_assoc($resultado)) { ?>
                    <tr>
                        <td><?= $peixe['id_peixe'] ?></td>
                        <td><?= $peixe['nome_comum'] ?></td>
                        <td><?= $peixe['nome_cientifico'] ?></td>
                        <td><?= $peixe['especie'] ?></td>
                        <td><?= $peixe['habitat'] ?></td>
                        <td><?= $peixe['data_chegada'] ?></td>
                        <td>
                            <a href="remover.php?id=<?= $peixe['id_peixe'] ?>" class="btn btn-sm btn-outline-danger">Remover</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Cadastrar Novo Peixe</h2>
        </div>
        <div class="card-body">
            <form action="cadastrar.php" method="POST">
                <div class="mb-3">
                    <label for="nome_comum" class="form-label">Nome Comum</label>
                    <input type="text" name="nome_comum" id="nome_comum" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="nome_cientifico" class="form-label">Nome Científico</label>
                    <input type="text" name="nome_cientifico" id="nome_cientifico" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="especie" class="form-label">Espécie</label>
                    <input type="text" name="especie" id="especie" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="habitat" class="form-label">Habitat</label>
                    <input type="text" name="habitat" id="habitat" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="data_chegada" class="form-label">Data de Chegada</label>
                    <input type="date" name="data_chegada" id="data_chegada" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </form>
        </div>
    </div>

    <!-- JavaScript do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
