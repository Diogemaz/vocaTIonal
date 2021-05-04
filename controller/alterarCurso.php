<?php
    session_start();
    include_once "../model/area.php";
    include_once "../model/profissao.php";
    include_once "../model/curso.php";
    include_once "../model/usuario.php";
    if(isset($_SESSION['user'])){
        $user = unserialize($_SESSION['user']);
        if($user->getAdm() == 1){
            $curso = unserialize($_SESSION['curso']);
            $id = $curso->getId();
            $nome = $_POST['nome'];
            $preco = $_POST['preco'];
            $link = $_POST['link'];
            $curso = new curso($id, $nome, $preco, $link);
            try{
                if($_POST['funcao'] == "Alterar"){
                    $cadastro = $curso->alterarCurso();
                }else if($_POST['funcao'] == "Excluir"){
                    $cadastro = $curso->deletarCurso();
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