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
    $mail->Body = "Olá ".$nomeUser." aqui está o token de verificação para seu email <br><br> Token: https://vocational.com.br/controller/confirmar_email?token=".$token."";
    $mail->AddAddress($email);

     if(!$mail->Send()) {
        return 0;
     } else {
        echo $mail->error;
     }
}
?>