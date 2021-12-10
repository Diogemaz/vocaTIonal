<?php 
    session_start();
    include_once "../model/usuario.php";
    include_once "../model/funcoes.php";
    if(isset($_SESSION['user'])){
        try{
            $id = $_POST['id_frase'];
            $alter = DeletaFrase($id);
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