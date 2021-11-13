<?php
    if(!$_POST){ header('location: ../view/cadastro.php'); }
    require_once("../model/funcoes.php");
    require_once("../model/usuario.php");
    try{
        $token = $_POST['token'];
        $senha = $_POST['senha'];
        $email = $_POST['email'];
        if($senha == $_POST['senha2']){
            $reflect = new ReflectionClass('Usuario');
            $usuario = $reflect->newInstanceWithoutConstructor();
            $envio = $usuario->alterarSenhaToken($senha, $token, $email);
            if($envio == 1){
                $response = 1;
            }else{
                $response = 0;
            }
        }else{
            $response = -1;
        }
        echo json_encode($response);
    }catch(Exception $e){
        echo json_encode("0");
    }
?>