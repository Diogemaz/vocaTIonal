<?php

    function CadastroDeUsuario($nome, $email, $senha, $adm){
        require_once "conexao.php";
        require_once "../model/usuario.php";

        $senha = md5($senha);
        try{
            $stmt = $con->prepare("INSERT INTO usuario (nome_usuario, email, senha, administrador) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssi", $nome, $email, $senha, $adm);
            $stmt->execute();
            $user = new Usuario($email, $nome); 
            return $user;
        }catch(Exception $e){
            return null;
        }
    }
?>  