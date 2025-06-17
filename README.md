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


// Conexão com o banco de dados
$conexao = conectar_banco();

// Dados do peixe
$nome_comum = $_POST['nome_comum'];
$nome_cientifico = $_POST['nome_cientifico'] ?? '';
$especie = $_POST['especie'] ?? '';
$habitat = $_POST['habitat'] ?? '';
$data_chegada = $_POST['data_chegada'];
$id_funcionario = $_SESSION['id_usuario'];  // Usando o ID do usuário logado

// Inserção do peixe no banco de dados
$sql = "INSERT INTO tb_peixes (nome_comum, nome_cientifico, especie, habitat, data_chegada)
        VALUES (?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conexao, $sql);

if ($stmt) {
    // Bind dos parâmetros
    mysqli_stmt_bind_param($stmt, 'sssss', $nome_comum, $nome_cientifico, $especie, $habitat, $data_chegada);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Peixe cadastrado com sucesso!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar peixe: " . mysqli_error($conexao) . "'); history.back();</script>";
    }

    // Fechando o statement
    mysqli_stmt_close($stmt);
} else {
    echo "<script>alert('Erro ao preparar o cadastro do peixe.'); history.back();</script>";
}

mysqli_close($conexao);

