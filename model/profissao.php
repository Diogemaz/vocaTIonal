<?php
require_once "funcoes.php";

class profissao
{
    public $nome;
    public $salario;
    public $cursos = [];

    public function __construct($nome, $salario)
    {
        $this->nome = $nome;
        $this->salario = $salario;
    }

    public function getNome(){
        return $this->nome;
    }
    
    public function getSalario(){
        return $this->salario;
    }

    public function getCurso(){
        return $this->cursos;
    }
    public function cadastrarProfissao($nome, $salario){
        $con = conexao();
        try{
            $stmt = $con->prepare("INSERT INTO profissao (nome_profissao, salario) VALUES (:nome, :salario)");
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR, 50);
            $stmt->bindParam(':salario', $salario, PDO::PARAM_STR, 50);
            $stmt->execute();
        }catch(Exception $e){
            return null;
        }
    }
}


?>