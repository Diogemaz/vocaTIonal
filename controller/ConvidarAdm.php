<?php 
    session_start();
    include_once "../model/usuario.php";
    if(isset($_SESSION['user'])){
        try{
            $reflect = new ReflectionClass('usuario');
            $user = $reflect->newInstanceWithoutConstructor();
            $nome = $_POST['pesquisa'];
            $alter = $user->tornarADM($nome);
            if($alter = 1){
                $response = 1;
            }else{
                $response = -1;
            }
        }catch(Exception $e){
            $response = -1;
        }
        echo json_encode($response);
    }else{
        header('location: ../view/entra.php');
    }
?>