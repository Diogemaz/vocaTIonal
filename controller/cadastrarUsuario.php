<?php
if(!$_POST){ header('location: ../view/cadastro.php'); }
    session_start();
    require_once "../model/usuario.php";

    $nomeUser = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confSenha = $_POST['confSenha'];
    $usuario = new Usuario();

    if($senha == $confSenha)
    {
        try{
            $user = $usuario->cadastrarUsuario($nomeUser, $email, $senha, 0);
            $_SESSION['user'] = serialize($user);
            $response = 1;
        }catch (Exception $e){
            $response = 0;
        }
    } else {
        $response = -1;
    }

    echo json_encode($response);
?>