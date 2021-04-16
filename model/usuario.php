<?php
require_once "funcoes.php";

class Usuario
{
    public ?string $nomeUsuario = null;
    private string $email;
    private string $senha;
    private int $adm = 0;
    private $areas = array(); 

    public function setNome($nome){
        $this->nomeUsuario = $nome;
    }
    public function setEmail($email){
        $this->email = $email;
    }

    public function setAreas($areas)
    {
        $this->areas = $areas;
    }

    public function setAdm($adm)
    {
        $this->adm = $adm;
    }

    public function getNomeUsuario()
    {
        return $this->nomeUsuario;
    }

    public function getEmail()
    {
        return $this->email;
    }
    
    public function getAdm()
    {
        return $this->adm;
    }
    
    public function getAreas()
    {
        return $this->areas;
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
                //if(verificarEmail($email, $nome, $token) == 1){
                    return 1;
                //}else{
                  //  return 2;
                //}
            }else{
                return 0;
            }
        }catch(Exception $e){
            return -1;
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
                    $user = new Usuario();
                    $user->setNome($row['nome_usuario']);
                    $user->setEmail($row['email']);
                    $user->setAreas($row['areas']);
                    $user->setAdm($row['administrador']);
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