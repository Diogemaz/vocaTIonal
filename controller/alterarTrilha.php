<?php
    session_start();
    include_once "../model/area.php";
    include_once "../model/trilha.php";
    include_once "../model/usuario.php";
    if(isset($_SESSION['user'])){
        $user = unserialize($_SESSION['user']);
        if($user->getAdm() == 1){
            $trilha = unserialize($_SESSION['trilhas']);
            $id = $trilha->getId();
            $nome = substr($_POST['nome'], 0, 50);
            $area = $_POST['area'];
            $textos = [];
            for ($i = 0; $i < 10; $i++){
                if(isset($_POST['texto'.$i])){
                    $textos[$i] = $_POST['texto'.$i];
                }else{
                    break;
                }
            }
            $textos = implode("|", $textos);
            $trilha = new trilhas($id, $nome, $textos);
            $trilha->setArea($area);
            if(!empty(trim($nome))){
                try{
                    if($_POST['funcao'] == "Alterar"){
                        $cadastro = $trilha->alterarTrilha($id);
                    }else if($_POST['funcao'] == "Excluir"){
                        $cadastro = $trilha->deletarTrilha($id);
                    }
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