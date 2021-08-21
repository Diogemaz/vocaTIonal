<?php
    session_start();
    include_once "../model/area.php";
    include_once "../model/profissao.php";
    include_once "../model/usuario.php";
    if(isset($_SESSION['user'])){
        $user = unserialize($_SESSION['user']);
        if($user->getAdm() == 1){
            $profissao = unserialize($_SESSION['profissao']);
            $id = $profissao->getId();
            $nome = substr($_POST['nome'], 0, 36);
            $salario = $_POST['salario'];
            $area = $_POST['area'];
            $profissao = new profissao($id, $nome, $salario);
            if(!empty(trim($nome))){
                try{
                    if($_POST['funcao'] == "Alterar"){
                        $cadastro = $profissao->alterarProfissao($id);
                    }else if($_POST['funcao'] == "Excluir"){
                        $cadastro = $profissao->deletarProfissao($id);
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