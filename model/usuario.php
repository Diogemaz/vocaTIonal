<?php
require_once "funcoes.php";

class Usuario
{
    private $id;
    public $nomeUsuario = null;
    private $email = null;
    private $senha = null;
    private $adm = 0;
    private $areas = array(); 
    private $img;
    private $token_recuperacao;

    public function setEmail($email){
        $this->email = $email;
    }
    public function setNomeUsuario($foto)
    {
        $this->nomeUsuario = $foto;
    }
    public function setTokenRecuperacao($token)
    {
        $this->token_recuperacao = $token;
    }
    public function setAreas($areas)
    {
        $this->areas = $areas;
    }

    public function setAdm($adm)
    {
        $this->adm = $adm;
    }

    public function setImg($img)
    {
        $this->img = $img;
    }
    public function getNomeUsuario()
    {
        return $this->nomeUsuario;
    }

    public function getEmail()
    {
        return $this->email;
    }
    
    public function getImg()
    {
        return $this->img;
    }
    
    public function getAdm()
    {
        return $this->adm;
    }
    
    public function getSenha()
    {
        return $this->senha;
    }
    
    public function getAreas()
    {
        return $this->areas;
    }
    
    public function getTokenRecuperacao()
    {
        return $this->token_recuperacao;
    }

    public function getId()
    {
        return $this->id;
    }

    public function cadastrarUsuario($nome, $email, $senha){
        $con = conexao();
        $senha = md5($senha);
        $token = md5($email);
        try{
            $resultado = $con->prepare("SELECT email FROM usuario WHERE email=:email");
            $resultado->bindParam(':email', $email, PDO::PARAM_STR, 50);
            $resultado->execute();
            if($resultado->rowCount() == 0){
                $stmt = $con->prepare("INSERT INTO usuario (nome_usuario, email, senha, token) VALUES (:nome, :email, :senha, :token)");
                $stmt->bindParam(':nome', $nome, PDO::PARAM_STR, 50);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR, 50);
                $stmt->bindParam(':senha', $senha, PDO::PARAM_STR, 32);
                $stmt->bindParam(':token', $token, PDO::PARAM_STR, 32);
                $stmt->execute();
                return 1;
            }else{
                return 0;
            }
        }catch(Exception $e){
            return -1;
        }
    }
    public function RecuperacaoSenha($email){
        $con = conexao();
        try{
            $sql = "SELECT token_recuperacao, nome_usuario FROM usuario WHERE email = :email;";
            $resultado = $con->prepare($sql);
            $resultado->bindParam(':email', $email, PDO::PARAM_STR);
            $resultado->execute();
            if($resultado->rowCount() == 1){
                while ($row = $resultado->fetch()){
                    $this->nomeUsuario = $row['nome_usuario'];
                    $this->email = $email;
                    if(is_null($row['token_recuperacao'])){
                        $token = md5($email);
                        try{
                            $sql2 = "UPDATE usuario SET token_recuperacao = :token WHERE email = :email";
                            $update = $con->prepare($sql2);
                            $update->bindParam(':token', $token, PDO::PARAM_STR, 32);
                            $update->bindParam(':email', $email, PDO::PARAM_STR); 
                            $update->execute();
                        }catch(Exception $e){
                            return 0;
                        }
                        $this->token_recuperacao = $token;
                    }else{
                        $token = md5($row['token_recuperacao']);
                        try{
                            $sql2 = "UPDATE usuario SET token_recuperacao = :token WHERE email = :email";
                            $update = $con->prepare($sql2);
                            $update->bindParam(':token', $token, PDO::PARAM_STR, 32);
                            $update->bindParam(':email', $email, PDO::PARAM_STR); 
                            $update->execute();
                        }catch(Exception $e){
                            return 0;
                        }
                        $this->token_recuperacao = $token;
                    }
                }
                return 1;
            }
        }catch(Exception $e){
            return 0;
        }
    }
    public function confUser($token)
    {
        $con = conexao();
        try{
            $sql = "UPDATE usuario SET verificacao = 1 WHERE token = :token";
            $update = $con->prepare($sql);
            $update->bindParam(':token', $token, PDO::PARAM_STR, 32); 
            $update->execute();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }
    public function userToken($token)
    {
        $con = conexao();
        try{
            $sql = "SELECT * FROM usuario WHERE token = :token;";
            $resultado = $con->prepare($sql);
            $resultado->bindParam(':token', $token, PDO::PARAM_STR, 32);
            $resultado->execute();
            if($resultado->rowCount() == 1){
                while ($row = $resultado->fetch()){
                    $this->id = $row['id_usuario'];
                    $this->nomeUsuario = $row['nome_usuario'];
                    $this->email = $row['email'];
                    $this->areas = $row['areas'];
                    $this->adm = $row['administrador'];
                    $this->senha = $row['senha'];
                    $this->img = $row['foto'];
                }
                return 1;
            }else if($resultado->rowCount() > 1){
                return -2; 
            }else if($resultado->rowCount() < 1){
                return -1;
            }
        }catch(Exception $e){
            return 0;
        }
    }
    public function login($email, $senha)
    {
        $con = conexao();
        $senha = md5($senha);
        try{
            $sql = "SELECT * FROM usuario WHERE email=:email AND senha=:senha;";
            $resultado = $con->prepare($sql);
            $resultado->bindParam(':email', $email, PDO::PARAM_STR, 50);
            $resultado->bindParam(':senha', $senha, PDO::PARAM_STR, 32);
            $resultado->execute();
            if($resultado->rowCount() == 1){
                while ($row = $resultado->fetch()){
                    if($row['verificacao'] == 0){
                        return -3;
                    }
                    $this->id = $row['id_usuario'];
                    $this->nomeUsuario = $row['nome_usuario'];
                    $this->email = $row['email'];
                    $this->areas = $row['areas'];
                    $this->adm = $row['administrador'];
                    $this->senha = $row['senha'];
                    $this->img = $row['foto'];
                }
                return 1;
            }else if($resultado->rowCount() > 1){
                return -2; 
            }else if($resultado->rowCount() < 1){
                return -1;
            }
        }catch(Exception $e){
            return 0;
        }
    }
    public function alterarSenha($senha){
        $con = conexao();
        $senha = md5($senha);
        try{
            $sql = "UPDATE usuario SET senha = :senha WHERE id_usuario = ".$this->id."";
            $update = $con->prepare($sql);
            $update->bindParam(':senha', $senha, PDO::PARAM_STR, 32); 
            $update->execute();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }
    public function alterarSenhaToken($senha, $Token, $email){
        $con = conexao();
        $senha = md5($senha);
        try{
            $sql = "UPDATE usuario SET senha = :senha WHERE token_recuperacao = :token AND email = :email";
            $update = $con->prepare($sql);
            $update->bindParam(':senha', $senha, PDO::PARAM_STR, 32); 
            $update->bindParam(':token', $Token, PDO::PARAM_STR, 32); 
            $update->bindParam(':email', $email, PDO::PARAM_STR); 
            $update->execute();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }
    public function alterarUsuario($nome, $foto){
        $con = conexao();
        try{
            $sql = "UPDATE usuario SET foto = :foto, nome_usuario = :nome WHERE id_usuario = ".$this->id."";
            $update = $con->prepare($sql);
            $update->bindParam(':foto', $foto, PDO::PARAM_STR, 100); 
            $update->bindParam(':nome', $nome, PDO::PARAM_STR, 32); 
            $update->execute();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }
    public function tornarADM($nome){
        $con = conexao();
        try{
            $sql = "UPDATE usuario SET administrador = 1 WHERE nome_usuario = :nome";
            $update = $con->prepare($sql);
            $update->bindParam(':nome', $nome, PDO::PARAM_STR, 50); 
            $update->execute();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }
}

?>