<?php
if(!$_POST){}else{
    session_start(); 
    include_once "../model/area.php";
    include_once "../model/profissao.php";
    include_once "../model/usuario.php";
    $comentario = $_POST['comentario'];
    if(isset($_SESSION['user'])){
        $user = unserialize($_SESSION['user']);
        $id = $user->getId();
        if($user->getImg() == null){
            $img = "../assets/img/user/padrao.png";
        }else{
            $img = "../assets/img/user/" . $user->getImg();
        }
?>
<div class="row mt-2">
    <div class="col-1"><img class="img-user" src="<?php echo $img; ?>"></div>
    <div class="comentario pt-0 pl-4 col-11" style="border-radius: 20px;">
        <div class="h-25 row mb-2 mt-2">
            <p class="text-primary mb-1 mr-2"><?php echo $user->getNomeUsuario() ?></p>
            <div class="d-flex h-50 align-items-center mt-2 mr-2" style="font-size: 10px">
                <?php echo str_replace("-", "/", date('d/m/Y')); ?>
            </div>
                <div class="d-flex justify-content-end col-9 ml-5">
                    <ul class="navbar-nav ml-auto my-2 my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                ...
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <button class="dropdown-item" onclick="excluirComentario(-1);">Excluir</button>
                            </div>
                        </li>
                    </ul>
                </div>
        </div>
        <div class="row mb-2 mt-2">
            <div class="col">
                <span><?php echo $comentario; ?></span>
            </div>
        </div>
    </div>
</div>
<?php }}?>