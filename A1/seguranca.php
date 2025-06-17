<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function esta_logado() {
    return isset($_SESSION['id_usuario']);
}

function exigir_login() {
    if (!esta_logado()) {
        echo "<script>alert('Você precisa estar logado.'); window.location.href='index.php';</script>";
        exit;
    }
}
