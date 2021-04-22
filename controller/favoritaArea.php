<?php
    session_start();
    include_once "../model/area.php";
    include_once "../model/usuario.php";
    if(isset($_POST['funcao'])){
        $funcao = $_POST['funcao'];
        $user = unserialize($_SESSION['user']);
        $area = unserialize($_SESSION['area']);
        if($funcao == "Favoritar área"){
        if($user->getAdm() == 0){
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
        }else{ $response = -2; }
        }else if($funcao == "Remover Favorito"){
            if($user->getAdm() == 0){
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
            }else{ $response = -2; }
        }
        echo json_encode($response);
    }else{
        header('location: ../view/entra.php');
    }

?>