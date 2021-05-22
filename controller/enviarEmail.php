<?php
if(!$_POST){ header('location: ../view/cadastro.php'); }
    session_start();
    require_once "../model/usuario.php";
    require_once "../model/funcoes.php";

    $nomeUser = $_POST['nome'];
    $email = $_POST['email'];
    $token = md5($_POST['email']);
    verificarEmail($email, $nomeUser, $token);
?>