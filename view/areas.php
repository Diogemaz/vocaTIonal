<?php
session_start();
$arq = basename(__FILE__);
include_once "../model/area.php";
include_once "../model/profissao.php";
$arquivo = basename(__FILE__);
if (isset($_SESSION['user'])) {
    include_once "../model/usuario.php";
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
        <link href="../css/cards.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container-fluid">
            <a class="navbar-brand js-scroll-trigger" href="#page-top"><img src="../assets/img/voc2.png" width="140" height="50"></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <?php include_once "../includes/menu.php" ?>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-10 align-self-end">
                    <h1 class="text-uppercase text-white font-weight-bold animated fadeIn">Áreas</h1>
                    <hr class="divider my-4 animated fadeInLeft" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 font-weight-light mb-5 animated fadeInRight">Aqui você pode encontrar as áreas de TI, encontre aquela que mas te agrada e se cadastre caso queira favoritar as mais interessantes para você.</p>
                </div>
            </div>
        </div>
    </header>
    <!-- areas-->
    <section class="page-section bg-primary" id="services" style="position: relative; z-index: 0;">
        <div class="container">
            <div class="row align-items-center justify-content-center mb-5">
                <?php
                if (!isset($_GET['area'])) {
                    $areas = new area;
                    $i = 0;
                    $resultado = $areas->getAreas();
                    while ($row = $resultado->fetch()) {
                        $area[$i] = new area;
                        $area[$i]->consultarArea($row['id_area']);
                ?>
                    <div class="card borda animated fadeInRight" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $area[$i]->getNome(); ?></h5>
                            <p class="card-text link-card">
                                <?php echo substr($area[$i]->getDescricao(), 0, 70) ?>...
                            </p>
                            <div class="text-center">
                                <a href="profissoes.php?area=<?php echo $area[$i]->getNome(); ?>" class="text-center">Ver mais</a>
                            </div>
                            <div class="row avaliacao">
                                <div class="col-1"><img src="../assets/img/star1.png" width="30" height="30"></div>
                                <div class="col mt-1">
                                    <h6 class="text-white-75 font-weight-light mt-1">
                                        <?php echo $area[$i]->getFavorito(); ?>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                        $i++;
                    }
                }
                ?>
            </div>
        </div>
    </section>
    <!-- Contact-->
    <?php include_once "../includes/contato.php"; ?>
    <!-- Footer-->
    <?php include_once "../includes/footer.php"; ?>
    <!-- Bootstrap core JS-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <!-- Core theme JS-->
    <script src="../js/scripts.js"></script>
</body>

</html>