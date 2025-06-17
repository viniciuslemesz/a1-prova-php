# a1-prova-php
Prova A1 de php professor Jason

TEMA: AQUARIO
RESUMO: CADASTRO DE FUNCIONARIOS E CADASTRO DE ESPECIE DE PEIXES;
usuario: vinicius / jean (criar);
senha: vinicius123 / jean123;
matricula: 001 / 004 ;

----------------
PRECISO COLOCAR


2 - SELECT * FROM itens WHERE usuario_id = ?;


// Recuperar o ID do peixe da URL
$id_peixe = $_GET['id'];

// Recuperar o ID do usuário logado
$id_usuario = $_SESSION['id_usuario'];

// Verificar se o peixe pertence ao usuário logado
$query = "SELECT responsavel_cadastro FROM tb_peixes WHERE id_peixe = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $id_peixe);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

// Se o peixe não existe
if (mysqli_stmt_num_rows($stmt) == 0) {
    echo "<script>alert('Peixe não encontrado.'); window.location.href='dashboard.php';</script>";
    exit;
}

// Verificar se o responsável pelo cadastro do peixe é o usuário logado
mysqli_stmt_bind_result($stmt, $responsavel_cadastro);
mysqli_stmt_fetch($stmt);

// Se o responsável pelo peixe não for o usuário logado, redireciona
if ($responsavel_cadastro != $id_usuario) {
    echo "<script>alert('Você não tem permissão para editar esse peixe.'); window.location.href='dashboard.php';</script>";
    exit;
}

// Caso contrário, permite a edição
