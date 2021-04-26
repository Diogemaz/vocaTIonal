<?php
require_once "funcoes.php";

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

    public function getCurso(){
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
                    /*try{
                        $sql = "SELECT * FROM profissao WHERE id_area=$id_area;";
                        $profissoes = $con->prepare($sql);
                        $profissoes->execute();
                        while($profissao = $profissoes->fetch()){
                            $this->profissoes[] = new profissao($profissao['nome_profissao'], $profissao['salario']); 
                        }
                    }catch(Exception $ex){
                        return $ex;
                    }*/
                }
            }
        }catch(Exception $e){
            return $e;
        }
    }
}


?>