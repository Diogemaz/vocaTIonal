<?php
require_once "funcoes.php";

class profissao
{
    public $nome;
    public $descricao;
    public $profissoes = [];


    public function cadastrarArea($nome, $descricao){
        $con = conexao();
        try{
            $stmt = $con->prepare("INSERT INTO area (nome_area, descricao) VALUES (:nome, :descricao)");
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR, 50);
            $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            $stmt->execute();
        }catch(Exception $e){
            return null;
        }
    }
}


?>