<?php
    session_start();
    $arq = basename(__FILE__);
    include_once "model/funcoes.php";
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
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic"
        rel="stylesheet" type="text/css" />
    <!-- Third party plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"
        rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container-fluid">
            <a class="navbar-brand js-scroll-trigger" href="#page-top"><img src="assets/img/voc2.png" width="140"
                    height="50"></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <?php include_once "includes/menu.php" ?>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-10 align-self-end">
                    <h1 class="text-uppercase text-white font-weight-bold animated fadeIn">Bem-vindo ao vocaTIonal</h1>
                    <hr class="divider my-4 animated fadeInLeft" />
                </div>
                <div class="col-lg-8 align-self-baseline ">
                    <p class="text-white-75 font-weight-light mb-5 animated fadeInRight">Aqui você vai encontrar o que
                        precisar sobre as áreas e profissões de TI e entender que esse universo não é só codigo.</p>
                </div>
            </div>
        </div>
    </header>
    <!-- About-->
    <section class="page-section bg-primary" id="about">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-3 text-center mr-5">
                    <h2 class="text-white mt-0 animated fadeIn">Equipe</h2>
                    <div class="row justify-content-center">
                        <div class="col">
                            <img>
                            <p class="text-white-50 mb-4 animated fadeIn">Bruno Ricardo</p>
                        </div>
                        <div class="col">
                            <img>
                            <p class="text-white-50 mb-4 animated fadeIn">Diogenes Paulino</p>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col">
                            <img>
                            <p class="text-white-50 mb-4 animated fadeIn">Henrique Pereira</p>
                        </div>
                        <div class="col">
                            <img>
                            <p class="text-white-50 mb-4 animated fadeIn">Rogério Gongora</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 text-center">
                    <h2 class="text-white mt-0 animated fadeInLeft">Sobre a vocaTIonal</h2>
                    <hr class="divider light my-4 animated fadeInLeft" />
                    <p class="text-white-50 mb-4 animated fadeInLeft">Existimos para ajudar você a decidir qual caminho
                        seguir e também te indicar como começar a se preparar para ele.</p>
                    <div class="row justify-content-center">
                        <a class="btn btn-light btn-xl js-scroll-trigger animated fadeInLeft"
                            href="view/areas.php">Comece a explorar</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="page-section bg-primary3" id="services">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="text-white mt-0">Oque é Ti para você?</h2>
                    <hr class="divider light my-4" />
                    <p class="text-white-50 mb-4">Existimos para ajudar você a decidir qual caminho seguir e também te
                        indicar como começar a se preparar para ele.</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <?php
                            $contador = 1;
                            foreach (listaFrases() as $frases) {
                                if($contador>1){
                        ?>
                            <div class="carousel-item active">
                                <div style="height: 75px;"></div>
                                <p class="text-white d-block w-100" style="height: 100px;">
                                    <?php echo $frases['texto_frase'];?> - Por:
                                    <?php echo $frases['profissional_frase'];?>
                                </p>
                            </div>

                            <?php 
                                }else{
                        ?>
                            <div class="carousel-item">
                                <div style="height: 75px;"></div>
                                <p class="text-white d-block w-100" style="height: 100px;">
                                    <?php echo $frases['texto_frase'];?> - Por:
                                    <?php echo $frases['profissional_frase'];?>
                                </p>
                            </div>

                            <?php
                                }
                                $contador++;
                                if ($contador == 3){
                                    break;
                                }
                            } 
                        ?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
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