<?php 
    session_start();
    include_once "../model/usuario.php";
    if(isset($_SESSION['user'])){
        $user = unserialize($_SESSION['user']);
        $senha = $_POST['senha'];
        $confSenha = $_POST['confSenha'];
        if($senha == $confSenha){
            $alter = $user->alterarSenha($senha);
            if($alter == 1){
                $response = 1;
            }else{
                $response = 0;
            }
        }else{
            $response = -1;
        }
        echo json_encode($response);
    }
?>