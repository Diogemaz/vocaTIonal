<?php
    session_start();
    include_once "../model/area.php";
    include_once "../model/usuario.php";
    if(isset($_POST['funcao'])){
        $funcao = $_POST['funcao'];
        $user = unserialize($_SESSION['user']);
        $area = unserialize($_SESSION['area']);
        if($funcao == "Favoritar área"){
            try{
                $favorita = $area->Favorita($user->getId());
                if($favorita == 1){
                    $response = 1;
                }else{
                    $response = 0;
                }
            }catch (Exception $e){
                $response = -1;
            }  
        }else if($funcao == "Remover Favorito"){
            try{
                $favorita = $area->RemoverFavorita($user->getId());
                if($favorita == 1){
                    $response = 1;
                }else{
                    $response = 0;
                }
            }catch (Exception $e){
                $response = -1;
            }  
        }
        echo json_encode($response);
    }else{
        header('location: ../view/entra.php');
    }

?>