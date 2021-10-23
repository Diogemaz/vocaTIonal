<?php
include "../model/funcoes.php";
$con = conexao();
$user =  $_POST['palavra']."%";
//Pesquisar no banco de dados nome do curso referente a palavra digitada pelo usuário
$sql = "SELECT nome_usuario, email FROM usuario WHERE nome_usuario LIKE :user";
$resultado = $con->prepare($sql);
$resultado->bindParam(':user', $user, PDO::PARAM_STR);
$resultado->execute();

if($resultado->rowCount() <= 0){
    echo "Nenhum usuário encontrado...";
}else{
    foreach($resultado as $rows){
        echo "<option value='".$rows['nome_usuario']."'>".$rows['nome_usuario']." (".$rows['email'].")<option>";
    }
}
?>