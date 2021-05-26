<?php 
    include_once "../model/usuario.php";
    if(isset($_SESSION['user'])){ 
        $user = unserialize($_SESSION['user']);
        if($user->getAdm() == 1){
            if($user->getImg() == null){
                $img = "../assets/img/user/padrao.png";
            }else{
                $img = "../assets/img/user/" . $user->getImg();
            }
?>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="<?php echo $img; ?>" alt="user" class="rounded-circle" width="31">
    </a>
    <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="../index.php"><i class="me-2 mdi mdi-restart"></i>
            Voltar ao site</a>
        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email me-1 ms-1"></i>
            Inbox</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="adm-confUser.php"><i
                class="ti-settings me-1 ms-1"></i>Configuração de usuário</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="entra.php?logout=1"><i
                class="fa fa-power-off me-1 ms-1"></i> Logout</a>
        <div class="dropdown-divider"></div>
    </ul>
</li>
<?php }else{ header('location: entra.php'); }}else{ header('location: entra.php'); } ?>