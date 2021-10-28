<?php
require_once "funcoes.php";
require_once "curso.php";

class trilhas
{
    public $id;
    public $nome;
    public $texto;
    public $area;

    public function __construct($id, $nome, $texto)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->texto = $texto;
    }
    
    public function setNome($nome){
        $this->nome = $nome;
    }
    
    public function setTexto($texto){
        $this->texto = $texto;
    }

    public function setArea($area){
        $this->area = $area;
    }
    public function getNome(){
        return $this->nome;
    }
    
    public function getArea(){
        return $this->area;
    }

    public function getTexto(){
        return $this->texto;
    }

    public function getId(){
        return $this->id;
    }

    public function cadastrarTrilhas($area){
        $con = conexao();
        try{
            $stmt = $con->prepare("INSERT INTO trilha (nome_Trilha, textos_trilha, id_area) VALUES (:nome, :texto, :area)");
            $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR, 50);
            $stmt->bindParam(':texto', $this->texto, PDO::PARAM_STR);
            $stmt->bindParam(':area', $area, PDO::PARAM_INT);
            $stmt->execute();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }

    public function alterarProfissao($profissao){
        $con = conexao();
        try{
            $stmt = $con->prepare("UPDATE profissao SET nome_profissao = :nome, salario = :salario WHERE id_profissao = :id");
            $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR, 50);
            $stmt->bindParam(':salario', $this->salario, PDO::PARAM_STR, 50);
            $stmt->bindParam(':id', $profissao, PDO::PARAM_INT);
            $stmt->execute();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }

    public function deletarProfissao($profissao){
        $con = conexao();
        try{
            $stmt = $con->prepare("DELETE FROM profissao WHERE id_profissao = :id");
            $stmt->bindParam(':id', $profissao, PDO::PARAM_INT);
            $stmt->execute();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }
    public function consultarProfissao($profissao){
        $con = conexao();
        try{
            $sql = "SELECT * FROM profissao WHERE id_profissao=:id;";
            $resultado = $con->prepare($sql);
            $resultado->bindParam(':id', $profissao, PDO::PARAM_INT);
            $resultado->execute();
            if($resultado->rowCount() == 1){
                while ($row = $resultado->fetch()){
                    $this->id = $row['id_profissao'];
                    $this->nome = $row['nome_profissao'];
                    $this->salario = $row['salario'];
                    $this->area = $row['id_area'];
                    $id = $row['id_profissao'];
                    try{
                        $sql = "SELECT * FROM curso WHERE id_profissao=$id;";
                        $cursos = $con->prepare($sql);
                        $cursos->execute();
                        while($curso = $cursos->fetch()){
                            $this->cursos[] = new curso($curso['id_curso'], $curso['nome_curso'], $curso['preco'], $curso['link']); 
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

    public function consultarProfissaoNome($profissao){
        $con = conexao();
        try{
            $sql = "SELECT * FROM profissao WHERE nome_profissao=:nome;";
            $resultado = $con->prepare($sql);
            $resultado->bindParam(':nome', $profissao, PDO::PARAM_STR);
            $resultado->execute();
            if($resultado->rowCount() == 1){
                while ($row = $resultado->fetch()){
                    $this->id = $row['id_profissao'];
                    $this->nome = $row['nome_profissao'];
                    $this->salario = $row['salario'];
                    $id = $row['id_profissao'];
                    try{
                        $sql = "SELECT * FROM curso WHERE id_profissao=$id;";
                        $cursos = $con->prepare($sql);
                        $cursos->execute();
                        while($curso = $cursos->fetch()){
                            $this->cursos[] = new curso($curso['id_curso'], $curso['nome_curso'], $curso['preco'], $curso['link']); 
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

    public function getComentario(){
        $con = conexao();
        try{
            $sql = "SELECT u.nome_usuario, u.foto, u.id_usuario, c.* FROM comentario_profissao c, usuario u WHERE id_profissao = :profissao AND u.id_usuario = c.id_usuario  ORDER BY id_comentarioProfissao DESC";
            $resultado = $con->prepare($sql);
            $resultado->bindParam(':profissao', $this->id, PDO::PARAM_INT);
            $resultado->execute();
            return $resultado;
        }catch(Exception $e){
            return $e;
        }
        return $this->id;
    }

    public function Comentar($comentario, $user){
        $con = conexao();
        try{
            $stmt = $con->prepare("INSERT INTO comentario_profissao (comentario, id_profissao, id_usuario) VALUES (:comentario, :profissao, :user)");
            $stmt->bindParam(':comentario', $comentario, PDO::PARAM_STR, 500);
            $stmt->bindParam(':profissao', $this->id, PDO::PARAM_INT);
            $stmt->bindParam(':user', $user, PDO::PARAM_INT);
            $stmt->execute();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }

    public function excluirComentario($id){
        $con = conexao();
        try{
            $stmt = $con->prepare("DELETE FROM comentario_profissao WHERE id_comentarioProfissao = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }

    public function avaliar($like, $user){
        $con = conexao();
        try{
            $sql = $con->prepare("SELECT * FROM avaliacao_profissao WHERE id_profissao = :profissao AND id_usuario = :user");
            $sql->bindParam(':profissao', $this->id, PDO::PARAM_INT);
            $sql->bindParam(':user', $user, PDO::PARAM_INT);
            $sql->execute();
            if($sql->rowCount() == 1){
                $stmt = $con->prepare("UPDATE avaliacao_profissao SET like_deslike = :valor WHERE id_profissao = :profissao AND id_usuario = :user");
                $stmt->bindParam(':valor', $like, PDO::PARAM_INT);
                $stmt->bindParam(':profissao', $this->id, PDO::PARAM_INT);
                $stmt->bindParam(':user', $user, PDO::PARAM_INT);
                $stmt->execute();
            }else{
                $stmt = $con->prepare("INSERT INTO avaliacao_profissao (like_deslike, id_profissao, id_usuario) VALUES (:likes, :profissao, :user)");
                $stmt->bindParam(':likes', $like, PDO::PARAM_INT);
                $stmt->bindParam(':profissao', $this->id, PDO::PARAM_INT);
                $stmt->bindParam(':user', $user, PDO::PARAM_INT);
                $stmt->execute();
            }
            return 1;
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function pegarAvaliacao($user){
        $con = conexao();
        try{
            $sql = "SELECT * FROM avaliacao_profissao WHERE id_usuario = :user AND id_profissao = :profissao";
            $resultado = $con->prepare($sql);
            $resultado->bindParam(':user', $user, PDO::PARAM_INT);
            $resultado->bindParam(':profissao', $this->id, PDO::PARAM_INT);
            $resultado->execute();
            while ($row = $resultado->fetch()){
                $this->avaliacao = $row['like_deslike'];
            }
            try{
                $sql2 = "SELECT * FROM avaliacao_profissao WHERE id_profissao = :profissao";
                $resultado2 = $con->prepare($sql2);
                $resultado2->bindParam(':profissao', $this->id, PDO::PARAM_INT);
                $resultado2->execute();
                $porcNegativa = 0;
                $porcPositiva = 0;
                while ($row = $resultado2->fetch()){
                    $like = $row['like_deslike'];
                    if($like == -1){
                        $porcNegativa++;
                    }else if($like == 1){
                        $porcPositiva++;
                    }
                }
                if($porcNegativa == 0 && $porcPositiva == 0){
                    $this->PorcAvaliacao = -1;
                }else{
                    $this->PorcAvaliacao = ($porcPositiva*100)/($porcNegativa+$porcPositiva);
                }
            }catch(Exception $e){
                return $e;
            } 
        }catch(Exception $e){
            return $e;
        }
    }
    
    public function Avaliacao(){
        $con = conexao();
        try{
            $sql2 = "SELECT * FROM avaliacao_area WHERE id_area = :area";
            $resultado2 = $con->prepare($sql2);
            $resultado2->bindParam(':area', $this->id, PDO::PARAM_INT);
            $resultado2->execute();
            $porcNegativa = 0;
            $porcPositiva = 0;
            while ($row = $resultado2->fetch()){
                $like = $row['like_deslike'];
                if($like == -1){
                    $porcNegativa++;
                }else if($like == 1){
                    $porcPositiva++;
                }
            }
            if($porcNegativa == 0 && $porcPositiva == 0){
                $this->PorcAvaliacao = -1;
            }else{
                $this->PorcAvaliacao = ($porcPositiva*100)/($porcNegativa+$porcPositiva);
            }
        }catch(Exception $e){
            return $e;
        } 
    }
}


?>