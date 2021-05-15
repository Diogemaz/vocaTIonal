<?php
     // Resultado da confirmação de e-mail que é recebido pelo utilizador.
    include_once "../model/usuario.php";
    $token = $_GET['token'];
    $user = new Usuario;
    $resultado = $user->userToken($token);
    if($resultado == 1){
        $ativacao = $user->confUser($token);
        if($ativacao == 1){
            echo '<script>window.alert("Verificado com sucesso!"); window.location.href = "../view/areaUsuario.php"</script>';
        }else{
            echo '<script>window.alert("Falha ao verificar!"); window.location.href = "../index.php"</script>';
        }
    }
    
?>
