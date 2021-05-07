<?php
require_once "funcoes.php";
require_once "curso.php";

class profissao
{
    public $id;
    public $nome;
    public $salario;
    public $cursos = [];

    public function __construct($id, $nome, $salario)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->salario = $salario;
    }
    
    public function setNome($nome){
        $this->nome = $nome;
    }
    
    public function setSalario($salario){
        $this->salario = $salario;
    }

    public function getNome(){
        return $this->nome;
    }
    
    public function getSalario(){
        return $this->salario;
    }

    public function getCursos(){
        return $this->cursos;
    }
    
    public function getId(){
        return $this->id;
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
            $resultado->bindParam(':nome', $profissao, PDO::PARAM_INT);
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
            $stmt->bindParam(':comentario', $comentario, PDO::PARAM_STR);
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
}


?>