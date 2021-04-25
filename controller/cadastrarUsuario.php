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
            $cadastro = $usuario->cadastrarUsuario($nomeUser, $email, $senha);
            if($cadastro == 1){
                $user = $usuario->login($email, $senha);
                $_SESSION['user'] = serialize($usuario);
                $response = 1;
            }else{
                $response = $cadastro;
            }
        }catch (Exception $e){
            $response = -1;
        }
    } else {
        $response = -2;
    }

    echo json_encode($response);
?>