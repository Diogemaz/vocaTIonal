<?php
if(!$_POST){ header('location: ../view/cadastro.php'); }
    session_start();
    require_once "../model/usuario.php";
    require_once "../model/funcoes.php";

    $nomeUser = substr($_POST['nome'], 0, 26);
    $email = $_POST['email'];
    $token = md5($_POST['email']);
    $senha = $_POST['senha'];
    $confSenha = $_POST['confSenha'];
    $usuario = new Usuario();

    if(strlen($senha) >= 8 && $senha == $confSenha)
    {
        try{
            if($nomeUser == "" || $email == "" || $senha == ""){
                $response = -4;
            }else{
                $cadastro = $usuario->cadastrarUsuario($nomeUser, $email, $senha);
                if($cadastro == 1){
                    $response = 1;
                }else{
                    $response = $cadastro;
                }
            }
        }catch (Exception $e){
            $response = -1;
        }
    } else if($senha != $confSenha){
        $response = -2;
    }else{
        $response = -3;
    }

    echo json_encode($response);
?>