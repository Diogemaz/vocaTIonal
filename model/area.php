<?php
require_once "funcoes.php";

class Area
{
    public $id;
    public $nome;
    public $descricao;
    public $favorito;
    public $profissoes = array();

    public function getNome(){
        return $this->nome;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function getProfissoes(){
        return $this->profissoes;
    }

    public function getFavorito(){
        return $this->favorito;
    }

    public function getId(){
        return $this->id;
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

    public function QtdAreaFavoritada($user){
        $con = conexao();
        try{
            $sql = "SELECT * FROM favorito_usuario WHERE id_usuario = :user";
            $resultado = $con->prepare($sql);
            $resultado->bindParam(':user', $user, PDO::PARAM_STR);
            $resultado->execute();
            return $resultado->rowCount();
        }catch(Exception $e){
            return $e;
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
            $resultado->bindParam(':id', $id, PDO::PARAM_STR);
            $resultado->execute();
            if($resultado->rowCount() == 1){
                while ($row = $resultado->fetch()){
                    $this->id = $row['id_area'];
                    $this->nome = $row['nome_area'];
                    $this->descricao = $row['descricao'];
                    $this->favorito = $row['num_favorite'];
                    $id_area = $row['id_area'];
                    try{
                        $sql = "SELECT * FROM profissao WHERE id_area=$id_area;";
                        $profissoes = $con->prepare($sql);
                        $profissoes->execute();
                        while($profissao = $profissoes->fetch()){
                            $this->profissoes[] = new profissao($profissao['nome_profissao'], $profissao['salario']); 
                        }
                    }catch(Exception $ex){
                        return $ex;
                    }
                }
            }
        }catch(Exception $e){
            return $e;
        }
    }

    public function consultarAreaNome($nome){
        $con = conexao();
        try{
            $sql = "SELECT * FROM area WHERE nome_area=:nome;";
            $resultado = $con->prepare($sql);
            $resultado->bindParam(':nome', $nome, PDO::PARAM_STR);
            $resultado->execute();
            if($resultado->rowCount() == 1){
                while ($row = $resultado->fetch()){
                    $this->id = $row['id_area'];
                    $this->nome = $row['nome_area'];
                    $this->descricao = $row['descricao'];
                    $this->fevorito = $row['num_favorite'];
                    $id_area = $row['id_area'];
                    try{
                        $sql = "SELECT * FROM profissao WHERE id_area=$id_area;";
                        $profissoes = $con->prepare($sql);
                        $profissoes->execute();
                        while($profissao = $profissoes->fetch()){
                            $this->profissoes[] = new profissao($profissao['nome_profissao'], $profissao['salario']); 
                        }
                    }catch(Exception $ex){
                        return $ex;
                    }
                }
            }
        }catch(Exception $e){
            return $e;
        }
    }

    public function Favorita($user){
        $con = conexao();
        try{
            $stmt = $con->prepare("INSERT INTO favorito_usuario (id_area, id_usuario) VALUES (:area, :usuario)");
            $stmt->bindParam(':area', $this->id, PDO::PARAM_INT);
            $stmt->bindParam(':usuario', $user, PDO::PARAM_INT);
            $stmt->execute();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }

    public function RemoverFavorita($user){
        $con = conexao();
        try{
            $stmt = $con->prepare("DELETE FROM favorito_usuario WHERE id_area=:area AND id_usuario=:usuario;");
            $stmt->bindParam(':area', $this->id, PDO::PARAM_INT);
            $stmt->bindParam(':usuario', $user, PDO::PARAM_INT);
            $stmt->execute();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }

    public function consultarAreaFavoritada($user){
        $con = conexao();
        try{
            $sql = "SELECT a.* FROM area a LEFT OUTER JOIN favorito_usuario f ON a.id_area = f.id_area WHERE f.id_usuario = :user;";
            $resultado = $con->prepare($sql);
            $resultado->bindParam(':user', $user, PDO::PARAM_STR);
            $resultado->execute();
            return $resultado;
        }catch(Exception $e){
            return $e;
        }
    }

    
}


?>