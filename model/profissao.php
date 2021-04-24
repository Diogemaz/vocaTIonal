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
    public function cadastrarProfissao($area){
        $con = conexao();
        try{
            $stmt = $con->prepare("INSERT INTO profissao (nome_profissao, salario, id_area) VALUES (:nome, :salario, :area)");
            $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR, 50);
            $stmt->bindParam(':salario', $this->salario, PDO::PARAM_STR, 50);
            $stmt->bindParam(':area', $area, PDO::PARAM_INT);
            $stmt->execute();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }
}


?>