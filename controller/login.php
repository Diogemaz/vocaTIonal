<?php
if(!($_POST)){ header('location: ../view/entra.php'); }
    session_start();
    require_once "../model/usuario.php";

    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $usuario = new Usuario;

    try{
        $user = $usuario->login($email, $senha);
        if($user == 0){
            $response = 0;
        }else if($user == -2){
            $response = -2;
        }else if(($user == -1)){
            $response = -1;
        }else if($user == 1){
            $_SESSION['user'] = serialize($usuario);
            if($usuario->getAdm() == 1){
                $response = 2;
            }else{
                $response = 1;
            }
        }else if($user == -3){
            $response = -3;
        }
    } catch (Exception $e){
        $response = -4;
    }
    
    echo json_encode($response);
?>