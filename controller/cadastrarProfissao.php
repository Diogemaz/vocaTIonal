<?php
    session_start();
    include_once "../model/area.php";
    include_once "../model/profissao.php";
    include_once "../model/usuario.php";
    include_once "../model/funcoes.php";
    if(isset($_SESSION['user'])){
        $user = unserialize($_SESSION['user']);
        if($user->getAdm() == 1){
            $nome = substr($_POST['nome'], 0, 36);
            $salario = $_POST['salario'];
            $descricao = $_POST['descricao'];
            $area = $_POST['area'];
            $reflect = new ReflectionClass('profissao');
            $profissao = $reflect->newInstanceWithoutConstructor();
            $profissao->setNome($nome);
            $profissao->setSalario($salario);
            $profissao->setDescricao($descricao);
            if(!empty(trim($nome))){
                try{
                    $cadastro = $profissao->cadastrarProfissao($area);
                    if($cadastro == 1){
                        $notificar = notificaUsers($area, 1);
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