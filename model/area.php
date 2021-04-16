<?php
require_once "funcoes.php";

class Area
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
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }
}


?>