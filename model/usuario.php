<?php
require_once "cadastros.php";

class Usuario{
    private string $nomeUsuario;
    private string $email;
    private string $senha;
    private int $adm = 0;
    private $areas = array(); 

    public function __construct($email, $nome)
    {
        $this->nomeUsuario = $nome;
        $this->email = $email;   
    }

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
}

?>