<?php
require_once "funcoes.php";

class curso
{
    public $id;
    public $nome;
    public $preco;
    public $link;
    public $id_profissao;
    
    public function setPreco($preco){
        $this->preco = $preco;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function setLink($link){
        $this->link = $link;
    }

    public function getId(){
        return $this->id;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getPreco(){
        return $this->preco;
    }

    public function getLink(){
        return $this->link;
    }

    public function getIdProfissao(){
        return $this->id_profissao;
    }
    public function __construct($id, $nome, $preco, $link)
    {   
        $this->id = $id;
        $this->nome = $nome;
        $this->preco = $preco;
        $this->link = $link;
    }

    public function consultarCurso($id){
        $con = conexao();
        try{
            $sql = "SELECT * FROM curso WHERE id_curso=$id;";
            $curso = $con->prepare($sql);
            $curso->execute();
            if($curso->rowCount() == 1){
                while ($row = $curso->fetch()){
                    $this->id = $row['id_curso'];
                    $this->nome = $row['nome_curso'];
                    $this->preco = $row['preco'];
                    $this->link = $row['link'];
                    $this->id_profissao = $row['id_profissao'];
                }
            }
        }catch(Exception $ex){
            return $ex;
        }
    }

    public function cadastrarCurso($profissao){
        $con = conexao();
        try{
            $stmt = $con->prepare("INSERT INTO curso (nome_curso, preco, link, id_profissao) VALUES (:nome, :preco, :link, :profissao)");
            $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR, 50);
            $stmt->bindParam(':preco', $this->preco, PDO::PARAM_STR, 50);
            $stmt->bindParam(':link', $this->link, PDO::PARAM_STR, 120);
            $stmt->bindParam(':profissao', $profissao, PDO::PARAM_INT);
            $stmt->execute();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }
    
    public function alterarCurso(){
        $con = conexao();
        try{
            $stmt = $con->prepare("UPDATE curso SET nome_curso = :nome, preco = :preco, link = :link WHERE id_curso = :id");
            $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR, 50);
            $stmt->bindParam(':preco', $this->preco, PDO::PARAM_STR, 50);
            $stmt->bindParam(':link', $this->link, PDO::PARAM_STR, 120);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->execute();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }

    public function deletarCurso(){
        $con = conexao();
        try{
            $stmt = $con->prepare("DELETE FROM curso WHERE id_curso = :id");
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->execute();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }

}


?>