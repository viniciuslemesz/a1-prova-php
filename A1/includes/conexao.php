<?php
// conectar ao banco de dados
function conectar_banco() {

    // $servidor = 'localhost:3307';
    $servidor = 'localhost:3306';
    $usuario    = 'root';
    $senha      = '';
    $banco      = 'bd_aquario'; 

    $conn = mysqli_connect($servidor, $usuario, $senha, $banco);

    if (!$conn) {
        exit("Erro na conexão: " . mysqli_connect_error());
    }

    return $conn;
}

?>
