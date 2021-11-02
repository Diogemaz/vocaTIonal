<?php

function conexao(){
    try {
        $con = new PDO('mysql:host=localhost:3306;dbname=vocati29_vocationalbd', "root", "");
          $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
          echo 'ERROR: ' . $e->getMessage();
      }
    return $con;
}

function verificarEmail($email, $nomeUser, $token){
    require("PHPMailer/src/PHPMailer.php");
    require("PHPMailer/src/SMTP.php");
    require("PHPMailer/src/Exception.php");
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP(); // enable SMTP
    $mail->CharSet = 'UTF-8';
    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "mail.vocational.com.br";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "suporte@vocational.com.br";
    $mail->Password = "suporteVocational$%1";
    $mail->SetFrom("suporte@vocational.com.br");
    $mail->Subject = "Verificação de email";
    $mail->Body = "Olá ".$nomeUser." aqui está o token de verificação para seu email <br><br> Token: https://vocational.com.br/controller/confirmar_email.php?token=".$token."";
    $mail->AddAddress($email);

     if(!$mail->Send()) {
        return 0;
     } else {
        echo $mail->error;
     }
}

function notificaUsers($local, $item){
    $con = conexao();
    try{
        if($item == 1){
            $resultado = $con->prepare("SELECT a.nome_area, f.id_usuario FROM favorito_usuario f, area a WHERE f.id_area=:area AND f.id_area = a.id_area");
            $resultado->bindParam(':area', $local, PDO::PARAM_INT);
            $resultado->execute();
            while($row = $resultado->fetch()){
                $link = "profissoes.php?area=".$row['nome_area'];
                $stmt = $con->prepare("INSERT INTO notificacao (id_usuario, link, id_area, item) VALUES (:user, :link, :area, :item)");
                $stmt->bindParam(':user', $row['id_usuario'], PDO::PARAM_STR, 50);
                $stmt->bindParam(':link', $link, PDO::PARAM_STR);
                $stmt->bindParam(':area', $local, PDO::PARAM_INT);
                $stmt->bindParam(':item', $item, PDO::PARAM_INT);
                $stmt->execute();
                return 1;
            }
        }else if($item == 2){
            $resultado = $con->prepare("SELECT p.nome_profissao, f.id_usuario, a.id_area FROM favorito_usuario f, area a, profissao p WHERE p.id_profissao=:profissao AND a.id_area = (SELECT id_area FROM profissao WHERE id_profissao=:profissao) AND f.id_area = a.id_area;");
            $resultado->bindParam(':profissao', $local, PDO::PARAM_INT);
            $resultado->execute();
            while($row = $resultado->fetch()){
                $area = $row['id_area'];
                $link = "cursos.php?profissao=".$row['nome_profissao'];
                $stmt = $con->prepare("INSERT INTO notificacao (id_usuario, link, id_area, item) VALUES (:user, :link, :area, :item)");
                $stmt->bindParam(':user', $row['id_usuario'], PDO::PARAM_STR, 50);
                $stmt->bindParam(':link', $link, PDO::PARAM_STR);
                $stmt->bindParam(':area', $area, PDO::PARAM_INT);
                $stmt->bindParam(':item', $item, PDO::PARAM_INT);
                $stmt->execute();
                return 1;
            }
        }else if($item == 3){
            $resultado = $con->prepare("SELECT a.nome_area, f.id_usuario FROM favorito_usuario f, area a WHERE f.id_area=:area AND f.id_area = a.id_area");
            $resultado->bindParam(':area', $local, PDO::PARAM_INT);
            $resultado->execute();
            while($row = $resultado->fetch()){
                $link = "profissoes.php?area=".$row['nome_area'];
                $stmt = $con->prepare("INSERT INTO notificacao (id_usuario, link, id_area, item) VALUES (:user, :link, :area, :item)");
                $stmt->bindParam(':user', $row['id_usuario'], PDO::PARAM_STR, 50);
                $stmt->bindParam(':link', $link, PDO::PARAM_STR);
                $stmt->bindParam(':area', $local, PDO::PARAM_INT);
                $stmt->bindParam(':item', $item, PDO::PARAM_INT);
                $stmt->execute();
                return 1;
            }
        }
    }catch(Exception $e){
        return 0;
    }
}

    function getNotificacao($user){
        $con = conexao();
        try{
            $sql = "SELECT a.nome_area, n.* FROM notificacao n, area a WHERE id_usuario=:user AND a.id_area = n.id_area";
            $resultado = $con->prepare($sql);
            $resultado->bindParam(':user', $user, PDO::PARAM_INT);
            $resultado->execute();
            return $resultado;
        }catch(Exception $e){
            return $e;
        }
    }
    function excluirNotificacao($ids){
        $con = conexao();
        try{
            $ids = json_decode(stripslashes($ids));
            foreach($ids as $id){
                $sql = "DELETE FROM notificacao WHERE id_notificacao=:notificacao;";
                $resultado = $con->prepare($sql);
                $resultado->bindParam(':notificacao', $id, PDO::PARAM_INT);
                $resultado->execute();
            }
            return 1;
        }catch(Exception $e){
            return 2;
        }
    }
    
    function listaAdm(){
        $con = conexao();
        try{
            $sql = "SELECT id_usuario, nome_usuario, email FROM usuario WHERE administrador=1";
            $resultado = $con->prepare($sql);
            $resultado->execute();
            return $resultado;
        }catch(Exception $e){
            return $e;
        }
    }
    
    function listaFrases(){
        $con = conexao();
        try{
            $sql = "SELECT * FROM frase;";
            $resultado = $con->prepare($sql);
            $resultado->execute();
            return $resultado;
        }catch(Exception $e){
            return $e;
        }
    }

    function cadastrarFrase($nome, $frase, $linkedin){
        $con = conexao();
        try{
            $stmt = $con->prepare("INSERT INTO frase (texto_frase, profissional_frase, linkedin_frase) VALUES (:frase, :nome, :linkedin)");
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR, 50);
            $stmt->bindParam(':frase', $frase, PDO::PARAM_STR, 500);
            $stmt->bindParam(':linkedin', $linkedin, PDO::PARAM_STR, 200);
            $stmt->execute();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }

?>