<?php
if(!$_POST){ header('location: ../view/cadastro.php'); }
    session_start();
    require_once "../model/usuario.php";
    require_once "../model/funcoes.php";

    $nomeUser = $_POST['nome'];
    $email = $_POST['email'];
    $token = md5($_POST['email']);
    $senha = $_POST['senha'];
    $confSenha = $_POST['confSenha'];
    $usuario = new Usuario();

    if($senha == $confSenha)
    {
        try{
            $emailConf = verificarEmail($email, $nomeUser, $token);
            if($emailConf = 1){
                $cadastro = $usuario->cadastrarUsuario($nomeUser, $email, $senha);
            }else{
                $cadastro = 0;
            }
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

    echo json_encode(["retorno" => $response]);
?>