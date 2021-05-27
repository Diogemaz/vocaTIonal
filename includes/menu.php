<?php
    if($arq == "index.php"){
?>
<div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav ml-auto my-2 my-lg-0">
        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">Sobre</a></li>
        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="view/areas.php">Áreas</a></li>
        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">Contato</a></li>
        <?php 
            if(isset($_SESSION['user'])){
        ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $user->getNomeUsuario(); ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="view/areaUsuario.php#services">Suas áreas</a>
            <?php if($user->getAdm() == 1){ ?>
                <a class="dropdown-item" href="view/adm-dashboard.php">Voltar a Adm</a>
            <?php } ?>
            <a class="dropdown-item" href="view/confUser.php">Configuração do perfil</a>
            <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="view/entra.php?logout=1">Sair</a>
            </div>
        </li>
        <?php
            }else{
        ?>
        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="view/entra.php">Entrar</a></li>
        <?php } ?>
    </ul>
</div>
<?php
    }else if($arq == "areaUsuario.php"){        
?>
<div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav ml-auto my-2 my-lg-0">
        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="../index.php#about">Sobre</a></li>
        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="areas.php">Áreas</a></li>
        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="../index.php#contact">Contato</a></li>
        <?php 
            if(isset($_SESSION['user'])){
        ?>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $user->getNomeUsuario(); ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php if($user->getAdm() == 1){ ?>
                <a class="dropdown-item" href="adm-dashboard.php">Voltar a Adm</a>
            <?php } ?>
            <a class="dropdown-item" href="confUser.php">Configuração do perfil</a>
            <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="entra.php?logout=1">Sair</a>
            </div>
        </li>
        <?php
            }else{
        ?>
        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="entra.php">Entrar</a></li>
        <?php } ?>
    </ul>
</div>
<?php 
    }else{
?>
<div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav ml-auto my-2 my-lg-0">
        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="../index.php#about">Sobre</a></li>
        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="areas.php">Áreas</a></li>
        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="../index.php#contact">Contato</a></li>
        <?php 
            if(isset($_SESSION['user'])){
        ?>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $user->getNomeUsuario(); ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="areaUsuario.php#services">Suas áreas</a>
            <?php if($user->getAdm() == 1){ ?>
                <a class="dropdown-item" href="adm-dashboard.php">Voltar a Adm</a>
            <?php } ?>
            <a class="dropdown-item" href="confUser.php">Configuração do perfil</a>
            <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="entra.php?logout=1">Sair</a>
            </div>
        </li>
        <?php
            }else{
        ?>
        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="entra.php">Entrar</a></li>
        <?php } ?>
    </ul>
</div>
<?php
    }
?>
