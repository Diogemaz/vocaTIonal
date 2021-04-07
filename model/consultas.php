<?php
    require_once "../model/usuario.php";

    function login($email, $senha)
    {
        require_once "conexao.php";
        $senha = md5($senha);
        try{
            $sql = "SELECT * FROM usuario WHERE email='$email' AND senha='$senha';";
            $resultado = $con->query($sql);
            if($resultado->num_rows == 1){
                while ($row = $resultado->fetch_assoc()){
                    $user = new Usuario($row['email'], $row['nome_usuario'], $row['areas']);
                }
                $_SESSION['user'] = serialize($user);
                return 1;
            }else if($resultado->num_rows > 1){
                return -2; 
            }else if($resultado->num_rows < 1){
                return -1;
            }
        }catch(Exception $e){
            return 0;
        }
    }
?>