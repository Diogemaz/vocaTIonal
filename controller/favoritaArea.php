<?php
    session_start();
    include_once "../model/area.php";
    include_once "../model/usuario.php";
    if(isset($_SESSION['user'])){
        $user = unserialize($_SESSION['user']);
        if($user->getAdm() == 0){
            $area = unserialize($_SESSION['area']);

            $area = new Area;
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
            
            echo json_encode($response);
        }
    }else{
        header('location: ../view/entra.php');
    }

?>