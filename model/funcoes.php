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

function notificaUsers($area, $item){
    $con = conexao();
    try{
        $resultado = $con->prepare("SELECT a.nome_area, f.id_usuario FROM favorito_usuario f, area a WHERE f.id_area=:area AND f.id_area = a.id_area");
        $resultado->bindParam(':area', $area, PDO::PARAM_INT);
        $resultado->execute();
        while($row = $resultado->fetch()){
            $link = "cursos.php?profissao=".$row['nome_area'];
            $stmt = $con->prepare("INSERT INTO notificacao (id_usuario, link, id_area, item) VALUES (:user, :link, :area, :item)");
            $stmt->bindParam(':user', $row['id_usuario'], PDO::PARAM_STR, 50);
            $stmt->bindParam(':link', $link, PDO::PARAM_STR);
            $stmt->bindParam(':area', $area, PDO::PARAM_INT);
            $stmt->bindParam(':item', $item, PDO::PARAM_INT);
            $stmt->execute();
            return 1;
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
?>