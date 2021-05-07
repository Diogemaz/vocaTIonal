<?php
session_start();
include_once "../model/usuario.php";
include_once "../model/area.php";
include_once "../model/profissao.php";
if(isset($_SESSION['user'])){
    $user = unserialize($_SESSION['user']);
    $userId = $user->getId();
    if($_POST['local'] == 'area'){
        $area = unserialize($_SESSION['area']);
        $like = $_POST['like'];
        $cadastro = $area->avaliar($like, $userId);
    }else if($_POST['local'] == 'profissao'){
        $profissao = unserialize($_SESSION['profissao']);
        $like = $_POST['like'];
        $cadastro = $profissao->avaliar($like, $userId);
    }
    if($cadastro == 1){
        $response = 1;
    }else{
        $response['ex'] = $cadastro;
    }
}else{
    $response = 0;
}
echo json_encode($response);

?>