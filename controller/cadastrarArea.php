<?php
    session_start();
    include_once "../model/area.php";
    include_once "../model/usuario.php";
    if(isset($_SESSION['user'])){
        $user = unserialize($_SESSION['user']);
        if($user->getAdm() == 1){
            $nome = $_POST['nome'];
            $descricao = substr($_POST['descricao'], 0, 1001);
            $area = new Area;
            try{
                $cadastro = $area->cadastrarArea($nome, $descricao);
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