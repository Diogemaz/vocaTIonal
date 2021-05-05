<?php 
    session_start();
    include_once "../model/usuario.php";
    if(isset($_SESSION['user'])){
        $user = unserialize($_SESSION['user']);
        $nome = $_POST['nome'];
        if(isset($_FILES['foto']['name']) && $_FILES['foto']['error'] == 0){
            echo "if 1";
            $arquivo_tmp = $_FILES['foto']['tmp_name'];
            $foto = $_FILES['foto']['name'];
            $extensao = pathinfo($foto, PATHINFO_EXTENSION);
            $extensao = strtolower($extensao);
            if(strstr('.jpg;.jpeg;.gif;.png', $extensao)){
                echo "tem foto";
                $novoNome = uniqid(time()).'.'.$extensao;
                $destino = '../assets/img/user/' . $novoNome;
                if (@move_uploaded_file($arquivo_tmp, $destino)) {
                    $alter = $user->alterarUsuario($nome, $novoNome);
                    $user->setImg($novoNome);
                    echo "enviou";
                }else{
                    $alter = 0;
                }
            }else{
                echo "null interno";
                $foto = null;
                $alter = $user->alterarUsuario($nome, $foto);
            }
        }else{
            echo "null externo";
            $foto = $user->getImg();
            $alter = $user->alterarUsuario($nome, $foto);
        }
        if($alter == 1){
            $user->setNomeUsuario($nome);
            $_SESSION['user'] = serialize($user);
            header('location: ../view/confUser.php');
        }else{
            header('location: ../view/confUser.php?status=falha');
        }
    }else{
        header('location: ../view/entra.php');
    }
?>