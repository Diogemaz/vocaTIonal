<?php
    session_start();
    if(isset($_GET['logout']) == 1){
        session_destroy();
        $_SESSION['user'] = null;
    }
    if(isset($_SESSION['user']) != null){
        header('location: areaUsuario.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Início - vocaTIonal</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- Third party plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <div class="container" style="position: relative; z-index: 1;">
            <div class="d-flex justify-content-center h-100">
                <div class="alert alert-warning resposta" role="alert" id="resposta" style="display: none"></div>
                <div class="alert alert-danger resposta" role="alert" id="resposta" style="display: none"></div>
                <div class="alert alert-success resposta" role="alert" id="resposta" style="display: none"></div>
            </div>
        </div>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container-fluid">
                <a class="navbar-brand js-scroll-trigger" href="../index.php"><img src="../assets/img/voc2.png" width="140" height="50"></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="../index.php#about">Sobre</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="areas.php">Áreas</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="../index.php#contact">Contato</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="entra.php">Entrar</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <form id="form-recupera" method="POST" action="">
        <section class="page-section entrar" id="form">
            <div class="container">
                <div class="d-flex justify-content-center h-100">
                    <div class="card">
                        <div class="card-header">
                            <h3>Esqueceu a senha</h3>
                        </div>
                        <div class="card-body">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn float-right login_btn">Enviar <img style="display: none;" id="loader" src="https://res.cloudinary.com/sivadass/image/upload/v1498134389/icons/loader.gif" alt="loading"></button>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-center links">
                                <a href="entra.php">Logar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        </form>
        <!-- Footer-->
        <footer class="bg-primary py-4">
            <div class="container"><div class="small text-center text-muted">Copyright © 2021 - vocaTIonal</div></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
        <!-- Core theme JS-->
        <script src="../js/scripts.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </body>
</html>
