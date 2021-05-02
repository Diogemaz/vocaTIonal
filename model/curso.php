<?php
require_once "funcoes.php";

class curso
{
    public $nome;
    public $preco;
    public $link;
    
    public function getNome(){
        return $this->nome;
    }

    public function getPreco(){
        return $this->preco;
    }

    public function getLink(){
        return $this->link;
    }
    public function __construct($nome, $preco, $link)
    {   
        $this->nome = $nome;
        $this->preco = $preco;
        $this->link = $link;
    }

    public function cadastrarCurso($nome, $preco){
        $con = conexao();
        try{
            $stmt = $con->prepare("INSERT INTO curso (nome_curso, preco) VALUES (:nome, :preco)");
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR, 50);
            $stmt->bindParam(':preco', $preco, PDO::PARAM_STR, 50);
            $stmt->execute();
        }catch(Exception $e){
            return null;
        }
    }
}


?>