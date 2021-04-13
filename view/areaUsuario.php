<?php 
session_start();
if(isset($_SESSION['user'])){
    echo "area de usuario";
}else{
    echo "Acesso negado";
}
?>
<button href="entra.php">Sair</button>