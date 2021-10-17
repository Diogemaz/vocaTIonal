<?php 
    session_start();
    include_once "../model/usuario.php";
    if(isset($_SESSION['user'])){
        $user = $_POST['nome'];
        if(isset($_FILES['foto']['name']) && $_FILES['foto']['error'] == 0){
            $arquivo_tmp = $_FILES['foto']['tmp_name'];
            $foto = $_FILES['foto']['name'];
            $extensao = pathinfo($foto, PATHINFO_EXTENSION);
            $extensao = strtolower($extensao);
            if(strstr('.jpg;.jpeg;.gif;.png', $extensao)){
                $fotoAntiga = "../assets/img/user/".$user->getImg();
                unlink($fotoAntiga);
                $novoNome = uniqid(time()).'.'.$extensao;
                $destino = '../assets/img/user/' . $novoNome;
                if (@move_uploaded_file($arquivo_tmp, $destino)) {
                    $alter = $user->alterarUsuario($nome, $novoNome);
                    $user->setImg($novoNome);
                }else{
                    $alter = 0;
                }
            }else{
                $foto = null;
                $alter = $user->alterarUsuario($nome, $foto);
            }
        }else{
            $foto = $user->getImg();
            $alter = $user->alterarUsuario($nome, $foto);
        }
        if($alter == 1){
            $user->setNomeUsuario($nome);
            $_SESSION['user'] = serialize($user);
            header("Location: ".$_SERVER['HTTP_REFERER']."");
        }else{
            header("Location: ".$_SERVER['HTTP_REFERER']."?status=falha");
        }
    }else{
        header('location: ../view/entra.php');
    }
?>