<?php
    session_start();
    include_once "../model/area.php";
    include_once "../model/profissao.php";
    include_once "../model/usuario.php";
    if(isset($_SESSION['user'])){
        $user = unserialize($_SESSION['user']);
        if($user->getAdm() == 1){
            $area = unserialize($_SESSION['area']);
            $id = $area->getId();
            $nome = $_POST['nome'];
            $descricao = $_POST['descricao'];
            $area = new area();
            $area->consultarArea($id);
            $area->setNome($nome);
            $area->setDescricao($descricao);
            try{
                if($_POST['funcao'] == "Alterar"){
                    $cadastro = $area->alterarArea($id);
                }else if($_POST['funcao'] == "Excluir"){
                    $cadastro = $area->deletarArea($id);
                }
                if($cadastro == 1){
                    $response = 1;
                }else{
                    $response = 0;
                }
            }catch (Exception $e){
                $response = -1;
            }
            
            echo json_encode($response);
        }}else{
            header('location: ../view/entra.php');
        }
?>