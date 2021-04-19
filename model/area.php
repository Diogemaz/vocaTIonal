<?php
require_once "funcoes.php";

class Area
{
    public $nome;
    public $descricao;
    public $profissoes = [];

    public function getNome(){
        return $this->nome;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function cadastrarArea($nome, $descricao){
        $con = conexao();
        try{
            $stmt = $con->prepare("INSERT INTO area (nome_area, descricao) VALUES (:nome, :descricao)");
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR, 50);
            $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            $stmt->execute();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }

    public function QtdArea(){
        $con = conexao();
        try{
            $sql = "SELECT * FROM area";
            $resultado = $con->prepare($sql);
            $resultado->execute();
            return $resultado->rowCount();
        }catch(Exception $e){
            return $e;
        }
    }

    public function consultarArea($id){
        $con = conexao();
        try{
            $sql = "SELECT * FROM area WHERE id_area=:id;";
            $resultado = $con->prepare($sql);
            $resultado->bindParam(':id', $id, PDO::PARAM_INT);
            $resultado->execute();
            if($resultado->rowCount() == 1){
                while ($row = $resultado->fetch()){
                    $this->nome = $row['nome_area'];
                    $this->descricao = $row['descricao'];
                    $sql = "SELECT * FROM profissoes WHERE id_area=".$row['id_area'].";";
                    $profissoes = $con->prepare($sql);
                    $profissoes->execute();
                    foreach($profissoes as $profissao){
                        $this->profissoes[] = new profissao($profissao['nome_proffissao'], $profissao['salario']); 
                    }
                }
            }
        }catch(Exception $e){
            return $e;
        }
    }

    
}


?>