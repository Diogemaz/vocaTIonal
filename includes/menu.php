<?php
if ($arq == "index.php") {
?>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto mr-2 my-lg-0">
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">Sobre</a></li>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="view/areas.php">Áreas</a></li>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">Contato</a></li>
            <?php
            if (isset($_SESSION['user'])) {
            ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $user->getNomeUsuario(); ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="view/areaUsuario.php#services">Suas áreas</a>
                        <?php if ($user->getAdm() == 1) { ?>
                            <a class="dropdown-item" href="view/adm-dashboard.php">Voltar a Adm</a>
                        <?php } ?>
                        <a class="dropdown-item" href="view/confUser.php">Configuração do perfil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="view/entra.php?logout=1">Sair</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a type="button" class="nav-link" data-toggle="modal" data-target="#notificacao">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                        </svg>
                        <span class="badge badge-light">
                            <?php
                                $notificacao = getNotificacao($user->getId());
                                echo $notificacao->rowCount();
                            ?>
                        </span>
                    </a>
                </li>
            <?php
            } else {
            ?>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="view/entra.php">Entrar</a></li>
            <?php } ?>
        </ul>
    </div>
<?php
} else if ($arq == "areaUsuario.php") {
?>
     <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto mr-2 my-lg-0">
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="../index.php#about">Sobre</a></li>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="areas.php">Áreas</a></li>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="../index.php#contact">Contato</a></li>
            <?php
            if (isset($_SESSION['user'])) {
            ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $user->getNomeUsuario(); ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="areaUsuario.php#services">Suas áreas</a>
                        <?php if ($user->getAdm() == 1) { ?>
                            <a class="dropdown-item" href="adm-dashboard.php">Voltar a Adm</a>
                        <?php } ?>
                        <a class="dropdown-item" href="confUser.php">Configuração do perfil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="entra.php?logout=1">Sair</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a type="button" class="nav-link" data-toggle="modal" data-target="#notificacao">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                        </svg>
                        <span class="badge badge-light">
                            <?php
                                $notificacao = getNotificacao($user->getId());
                                echo $notificacao->rowCount();
                            ?>
                        </span>
                    </a>
                </li>
            <?php
            } else {
            ?>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="entra.php">Entrar</a></li>
            <?php } ?>
        </ul>
    </div>
<?php
} else {
?>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto mr-2 my-lg-0">
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="../index.php#about">Sobre</a></li>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="areas.php">Áreas</a></li>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="../index.php#contact">Contato</a></li>
            <?php
            if (isset($_SESSION['user'])) {
            ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $user->getNomeUsuario(); ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="areaUsuario.php#services">Suas áreas</a>
                        <?php if ($user->getAdm() == 1) { ?>
                            <a class="dropdown-item" href="adm-dashboard.php">Voltar a Adm</a>
                        <?php } ?>
                        <a class="dropdown-item" href="confUser.php">Configuração do perfil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="entra.php?logout=1">Sair</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a type="button" class="nav-link" data-toggle="modal" data-target="#notificacao">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                        </svg>
                        <span class="badge badge-light">
                            <?php
                                $notificacao = getNotificacao($user->getId());
                                echo $notificacao->rowCount();
                            ?>
                        </span>
                    </a>
                </li>
            <?php
            } else {
            ?>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="entra.php">Entrar</a></li>
            <?php } ?>
        </ul>
    </div>
<?php
}
?>
<!-- Modal -->
<div class="modal fade" id="notificacao" tabindex="-1" role="dialog" aria-labelledby="TituloModalLongoExemplo" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModalLongoExemplo">Notificações</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php 
                if(isset($notificacao)){
                    while ($row = $notificacao->fetch()) {
                        if( $row['item'] == 1){
                            $item = "Nova profissão";
                        }else{
                            $item = "Novo curso";
                        }
                ?>
                <h5><?php echo $item. " na área " . $row['nome_area']; ?></h5>
                <a href="<?php echo $row['link']; ?>">Ver mais</a>
                <hr>
                <?php }} ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>