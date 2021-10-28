<?php
    session_start();
    include_once "../model/area.php";
    include_once "../model/profissao.php";
    include_once "../model/usuario.php";
    include_once "../model/funcoes.php";
    include_once "../model/trilha.php";
    if(isset($_SESSION['user'])){
        $user = unserialize($_SESSION['user']);
        if($user->getAdm() == 1){
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
            $reflect = new ReflectionClass('trilhas');
            $trilhas = $reflect->newInstanceWithoutConstructor();
            $trilhas->setNome($nome);
            $trilhas->setTexto($textos);
            if(!empty(trim($nome))){
                try{
                    $cadastro = $trilhas->cadastrarTrilhas($area);
                    if($cadastro == 1){
                        $notificar = notificaUsers($area, 3);
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