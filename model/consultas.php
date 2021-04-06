<?php
    require_once "../model/usuario.php";

    function login($email, $senha)
    {
        require_once "conexao.php";
        $senha = md5($senha);
        try{
            $sql = "SELECT * FROM usuario WHERE email='$email' AND senha=$senha";
            $resultado = $con->query($sql);
            $row = $resultado->fetch_assoc();
            $user = new Usuario($row['email'], $row['nome'], $row['areas']);
            return $user;
        }catch(Exception $e){
            return 0;
        }
    }
?>