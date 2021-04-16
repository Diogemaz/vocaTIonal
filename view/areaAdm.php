<?php
session_start();
include_once "../model/usuario.php";
if(isset($_SESSION['user'])){
    $user = unserialize($_SESSION['user']);
    if($user->getAdm() == 1){
?>
<form id="form-area" onSubmit="cadastrarArea();" action="../controller/cadastrarArea.php" method="POST">
    <input type="text" id="nome" name="nome"><br>
    <textarea id="descricao" name="descricao"></textarea>
    <input type="submit" value="Enviar">
</form>
<!-- Bootstrap core JS-->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<!-- Core theme JS-->
<script src="../js/scripts.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php
}}else{
    header('location: entra.php');
}
?>