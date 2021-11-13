<?php
    if(!$_POST){ header('location: ../view/cadastro.php'); }
    require_once("../model/funcoes.php");
    require_once("../model/usuario.php");
    try{
        $email = $_POST['email'];
        $reflect = new ReflectionClass('Usuario');
        $usuario = $reflect->newInstanceWithoutConstructor();
        $envio = $usuario->RecuperacaoSenha($email);
        if($envio == 1){
            ob_start(PHP_OUTPUT_HANDLER_CLEANABLE);
            $emailEnviado = RecuperarSenha($email, $usuario->getNomeUsuario(), $usuario->getTokenRecuperacao());
            ob_end_clean();
            $response = 1;
        }else{
            $response = 0;
        }
        echo json_encode($response);
    }catch(Exception $e){
        echo json_encode("0");
    }
?>