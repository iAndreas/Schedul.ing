<?php
require_once 'sessao.php';
if (!GerenciadorSessao::isLoggedIn()) {
    header('Location: form-login.php');
}

?>