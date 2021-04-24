<?php
    session_start();
    include_once "../model/area.php";
    include_once "../model/profissao.php";
    include_once "../model/usuario.php";
    if(isset($_SESSION['user'])){
        $user = unserialize($_SESSION['user']);
        if($user->getAdm() == 1){
            $nome = $_POST['nome'];
            $salario = $_POST['salario'];
            $area = $_POST['area'];
            $profissao = new profissao($nome, $salario);
            try{
                $cadastro = $profissao->cadastrarProfissao($area);
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