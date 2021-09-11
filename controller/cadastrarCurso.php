<?php
    session_start();
    include_once "../model/area.php";
    include_once "../model/profissao.php";
    include_once "../model/curso.php";
    include_once "../model/usuario.php";
    if(isset($_SESSION['user'])){
        $user = unserialize($_SESSION['user']);
        if($user->getAdm() == 1){
            $nome = substr($_POST['nome'], 0, 101);
            $preco = $_POST['preco'];
            $link = $_POST['link'];
            $profissaoId = $_POST['profissao'];
            $reflect = new ReflectionClass('curso');
            $curso = $reflect->newInstanceWithoutConstructor();
            $curso->setNome($nome);
            $curso->setPreco($preco);
            $curso->setLink($link);
            $reflect = new ReflectionClass('profissao');
            $profissao = $reflect->newInstanceWithoutConstructor();
            $profissao->consultarProfissao($profissaoId);
            if(!empty(trim($nome))){
                try{
                    $cadastro = $curso->cadastrarCurso($profissaoId);
                    if($cadastro == 1){
                        $notificar = notificaUsers($profissaoId, 2);
                        if($notificar == 1){
                            $response = 1;
                        }else{
                            $response = 2;
                        }
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