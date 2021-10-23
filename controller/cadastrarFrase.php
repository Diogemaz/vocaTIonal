<?php
    session_start();
    include_once "../model/funcoes.php";
    include_once "../model/usuario.php";
    if(isset($_SESSION['user'])){
        $user = unserialize($_SESSION['user']);
        if($user->getAdm() == 1){
            $nome = substr($_POST['nome'], 0, 50);
            $frase = substr($_POST['frase'], 0, 500);
            $link = substr($_POST['link_linkedin'], 0, 200);
            if(!empty(trim($nome))){
                try{
                    $cadastro = cadastrarFrase($nome, $frase, $link);
                    if($cadastro == 1){
                        $response = 1;
                    }else{
                        $response = 0;
                    }
                }catch (Exception $e){
                    $response = -1;
                }
            }else{
                $response = -2;
            }
            echo json_encode($response);
        }}else{
            header('location: ../view/entra.php');
        }
?>