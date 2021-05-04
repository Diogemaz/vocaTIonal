<?php
    session_start();
    include_once "../model/area.php";
    include_once "../model/profissao.php";
    include_once "../model/curso.php";
    include_once "../model/usuario.php";
    if(isset($_SESSION['user'])){
        $user = unserialize($_SESSION['user']);
        if($user->getAdm() == 1){
            $nome = $_POST['nome'];
            $preco = $_POST['preco'];
            $link = $_POST['link'];
            $profissao = $_POST['profissao'];
            $reflect = new ReflectionClass('curso');
            $curso = $reflect->newInstanceWithoutConstructor();
            $curso->setNome($nome);
            $curso->setPreco($preco);
            $curso->setLink($link);
            try{
                $cadastro = $curso->cadastrarCurso($profissao);
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