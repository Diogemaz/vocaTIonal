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

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
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
    
    public function getComentario(){
        $con = conexao();
        try{
            $sql = "SELECT u.nome_usuario, u.foto, c.* FROM comentario_area c, usuario u WHERE id_area = :area AND u.id_usuario = c.id_usuario ORDER BY id_comentarioArea DESC;";
            $resultado = $con->prepare($sql);
            $resultado->bindParam(':area', $this->id, PDO::PARAM_INT);
            $resultado->execute();
            return $resultado;
        }catch(Exception $e){
            return $e;
        }
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

    public function Comentar($comentario, $user){
        $con = conexao();
        try{
            $stmt = $con->prepare("INSERT INTO comentario_area (comentario, id_area, id_usuario) VALUES (:comentario, :area, :user)");
            $stmt->bindParam(':comentario', $comentario, PDO::PARAM_STR);
            $stmt->bindParam(':area', $this->id, PDO::PARAM_INT);
            $stmt->bindParam(':user', $user, PDO::PARAM_INT);
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

    public function getAreas(){
        $con = conexao();
        try{
            $sql = "SELECT id_area FROM area";
            $resultado = $con->prepare($sql);
            $resultado->execute();
            return $resultado;
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
                            $this->profissoes[] = new profissao($profissao['id_profissao'], $profissao['nome_profissao'], $profissao['salario']); 
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
    public function alterarArea($area){
        $con = conexao();
        try{
            $stmt = $con->prepare("UPDATE area SET nome_area = :nome, descricao = :descricao WHERE id_area = :id");
            $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR, 50);
            $stmt->bindParam(':descricao', $this->descricao, PDO::PARAM_STR, 50);
            $stmt->bindParam(':id', $area, PDO::PARAM_INT);
            $stmt->execute();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }

    public function deletarArea($area){
        $con = conexao();
        try{
            $stmt = $con->prepare("DELETE FROM area WHERE id_area = :id");
            $stmt->bindParam(':id', $area, PDO::PARAM_INT);
            $stmt->execute();
            return 1;
        }catch(Exception $e){
            return 0;
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
                            $this->profissoes[] = new profissao($profissao['id_area'], $profissao['nome_profissao'], $profissao['salario']); 
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