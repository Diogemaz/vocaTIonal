<?php
    session_start();
    include_once "../model/profissao.php";
    include_once "../model/area.php";
    include_once "../model/usuario.php";
    if(isset($_SESSION['user'])){
        $id = $_POST['id'];
        try{    
            if($_POST['local'] == 'profissao'){
                $profissao = unserialize($_SESSION['profissao']);
                $funcao = $profissao->excluirComentario($id);
            }else if($_POST['local'] == 'area'){
                $area = unserialize($_SESSION['area']);
                $funcao = $area->excluirComentario($id);
            }
            if($funcao == 1){
                $response = 1;
            }else{
                $response = 0;
            }
        }catch (Exception $e){
            $response = 0;
        }
        echo json_encode($response);
        }else{
            header('location: ../view/entra.php');
        }
?>