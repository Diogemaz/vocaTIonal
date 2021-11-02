<?php
    session_start();
    try{
        include_once "../model/funcoes.php";
        include_once "../model/usuario.php";
        if(isset($_SESSION['user'])){
            $ids = $_POST['data'];
            try{    
                $response = excluirNotificacao($ids);
            }catch (Exception $e){
                $response = 0;
            }
        }else{
            $response = 0;
        }
        echo json_encode($response);
    }catch (Exception $e){
        echo json_encode($e);
    }
?>