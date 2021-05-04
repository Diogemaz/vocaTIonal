<?php
    session_start();
    include_once "../model/usuario.php";
    include_once "../model/area.php";
    if(isset($_SESSION['user'])){
        $user = unserialize($_SESSION['user']);
        $userId = $user->getId();
        $area = unserialize($_SESSION['area']);
        $comentario = $_POST['comentario'];
        try{
            $cadastro = $area->Comentar($comentario, $userId);
            if($cadastro == 1){
                $response = 1;
            }else{
                $response = -2;
            }
        }catch (Exception $e){
            $response = -1;
        }
    }else{
        $response = 0;
    }
    echo json_encode($response);
?>