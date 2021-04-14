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
    require("PHPMailer-master/src/PHPMailer.php");
    require("PHPMailer-master/src/SMTP.php");
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "servidor.hostgator.com.br";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "suporte@vocational.com.br";
    $mail->Password = "suporteVocational$%1";
    $mail->SetFrom("suporte@vocational.com.br");
    $mail->Subject = "Verificação de email";
    $mail->Body = "Olá ".$nomeUser." aqui está o token de verificação para seu email <br><br> Token: vocational.com.br/model/verificarEmail?token=".$token."";
    $mail->AddAddress($email);
    if(!$mail->Send()) {
       return $mail->ErrorInfo;
    } else {
       return 1;
    }
}
?>