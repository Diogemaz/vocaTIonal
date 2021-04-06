<?php
if(!($_POST)){ header('location: ../view/entra.php'); }
    session_start();
    require_once "../model/consultas.php";
    require_once "../model/usuario.php";

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    try{
        $user = login($email, $senha);
        $_SESSION['user'] = serialize($user);
        if($user == 0){
            $response = 0;
        }else{
            $response = 1;
        }
    } catch (Exception $e){
        $response = -1;
    }
    
    echo json_encode($response);
?>