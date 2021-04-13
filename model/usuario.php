<?php
require_once "conexao.php";

class Usuario
{
    private string $nomeUsuario;
    private string $email;
    private string $senha;
    private int $adm = 0;
    private $areas = array(); 

    public function setSenha($senha){
        $this->senha = $senha;
    }

    public function setAreas($areas)
    {
        $this->areas = $areas;
    }

    public function getNomeUsuario()
    {
        return $this->nomeUsuario;
    }

    public function getEmail()
    {
        return $this->email;
    }
    
    public function getSenha()
    {
        return $this->senha;
    }
    
    public function getAdm()
    {
        return $this->adm;
    }
    
    public function getAreas()
    {
        return $this->areas;
    }

    public function cadastrarUsuario($nome, $email, $senha, $adm){
        $con = conexao();
        $senha = md5($senha);
        try{
            $stmt = $con->prepare("INSERT INTO usuario (nome_usuario, email, senha, administrador) VALUES (:nome, :email, :senha, :adm)");
            $stmt->bindParam(':nome', $email, PDO::PARAM_STR, 50);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR, 50);
            $stmt->bindParam(':senha', $senha, PDO::PARAM_STR, 32);
            $stmt->bindParam(':adm', $email, PDO::PARAM_INT);
            $stmt->execute();
            $user = new Usuario($email, $nome); 
            return $user;
        }catch(Exception $e){
            return null;
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
                    $user = new Usuario($row['email'], $row['nome_usuario'], $row['areas']);
                }
                $_SESSION['user'] = serialize($user);
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
}

?>