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
?>