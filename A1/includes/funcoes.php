<?php

function form_nao_enviado() {
    return $_SERVER['REQUEST_METHOD'] !== 'POST';
}

function login_em_branco() {
    return empty($_POST['matricula']) || empty($_POST['senha']);
}

function peixe_em_branco() {
    return empty($_POST['nome_comum']) || empty($_POST['data_chegada']);
}

function tratar_erros() {
    if (!isset($_GET['code'])) {
        return;
    }

    $code = (int)$_GET['code'];

    switch($code) {
        case 0: 
            $erro = '<h3>Você não tem permissão para acessar a página de destino</h3>';
            break;
        
        case 1:
            $erro = '<h3>Matrícula ou senha inválidos. Tente novamente</h3>';
            break;

        case 2:
            $erro = '<h2>Por favor, preencha todos os campos obrigatórios</h2>';
            break;

        case 3:
            $erro = '<h3>Erro ao executar consulta ao banco de dados. 
                    Tente novamente mais tarde, ou contate o suporte</h3>';
            break;
        
        default:
            $erro = "";
            break;
    }

    echo $erro;
}
