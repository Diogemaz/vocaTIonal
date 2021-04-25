<?php
    session_start();
    if(isset($_SESSION['user'])){
        include_once "model/usuario.php";
        $user = unserialize($_SESSION['user']);
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Início - vocaTIonal</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- Third party plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top"><img src="assets/img/voc2.png" width="140" height="50"></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
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
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end">
                        <h1 class="text-uppercase text-white font-weight-bold">Bem-vindo ao vocaTIonal</h1>
                        <hr class="divider my-4" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 font-weight-light mb-5">Aqui você vai encontrar o que precisar sobre as áreas e profissões de TI e entender que esse universo não é só codigo.</p>
                    </div>
                </div>
            </div>
        </header>
        <!-- About-->
        <section class="page-section bg-primary" id="about">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-3 text-center mr-5">
                        <h2 class="text-white mt-0">Equipe</h2>
                        <div class="row justify-content-center">
                            <div class="col">
                                <img>
                                <p class="text-white-50 mb-4">Bruno Ricardo</p>
                            </div>
                            <div class="col">
                                <img>
                                <p class="text-white-50 mb-4">Diogenes Paulino</p>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col">
                                    <img>
                                    <p class="text-white-50 mb-4">Henrique Pereira</p>
                                </div>
                                <div class="col">
                                    <img>
                                    <p class="text-white-50 mb-4">Rógerio Gongora</p>
                                </div>
                            </div>
                    </div>
                    <div class="col-lg-8 text-center">
                        <h2 class="text-white mt-0">Sobre a vocaTIonal</h2>
                        <hr class="divider light my-4" />
                        <p class="text-white-50 mb-4">Existimos para ajudar você a decidir qual caminho seguir e também te indicar como começar a se preparar para ele.</p>
                        <div class="row justify-content-center">
                            <a class="btn btn-light btn-xl js-scroll-trigger" href="view/areas.php">Comece a explorar</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact-->
        <?php include_once "includes/contato.php"; ?>
        <!-- Footer-->
        <?php include_once "includes/footer.php"; ?>
        <!-- Bootstrap core JS-->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
