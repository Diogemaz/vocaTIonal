<?php
    session_start();
    $arq = basename(__FILE__);
    include_once "../model/area.php";
    include_once "../model/profissao.php";
    $arquivo = basename( __FILE__ );
    if(isset($_SESSION['user'])){
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
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- Third party plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="../css/estilo.css">
    </head>
    <body id="page-top">
         <!-- Navigation-->
         <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container">
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
                        <h1 class="text-uppercase text-white font-weight-bold">Áreas</h1>
                        <hr class="divider my-4" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 font-weight-light mb-5">Aqui você pode encontrar as áreas de TI, encontre aquela que mas te agrada e se cadastre caso queira favoritar as mais interessantes para você.</p>
                    </div>
                </div>
            </div>
        </header>
        <!-- areas-->
        <section class="page-section bg-primary" id="services">
            <link rel="stylesheet" href="../css/estilo.css">
            <div class="container">
            <nav class="categories--home">
            <div class="categories__elements--home">
            <?php
                if(!isset($_GET['area'])){
                    $areas = new area;
                    $i = 0;
                    $resultado = $areas->getAreas();
                    while($row = $resultado->fetch()){
                        $area[$i] = new area;
                        $area[$i]->consultarArea($row['id_area']);    
            ?>
            <div class="categories__wrapper__links--home --<?php $area[$i]->getNome(); ?>" style="--color-var: #ffba05">
                <a class="categories__link--home" href="profissoes.php?area=<?php echo $area[$i]->getNome(); ?>">
                <div class="categories__link-wrapper--home">
                    <div class="categories__svg-wrapper--home" style="background:#ffba0552;"></div>
                    <div class="categories__texts" style="color:#ffba05;">
                        <h4 class="categories__link__category-name"><?php echo ucfirst($area[$i]->getNome()); ?></h4>
                    </div>
                </div>
                </a>
                <nav class="categories__calls--home">
                <a href="profissoes.php?area=<?php echo $area[$i]->getNome(); ?>" class="categories__calls__description--home">
                        <?php 
                            $j = 0;
                            foreach($area[$i]->getProfissoes() as $profissao){ 
                                echo $profissao->getNome(); 
                                $j++;
                                if($j == 5){break;} 
                            }
                        ?>...
                </a>
                <div class="row d-flex justify-content-center pl-2">                    
                    <div class="col-1"><img src="../assets/img/star1.png" width="30" height="30"></div>
                    <div class="col mt-1">
                        <h6 class="text-white-75 font-weight-light mt-1">
                            <?php echo $area[$i]->getFavorito(); ?>
                        </h6>
                    </div>
                </div>
                <a href="profissoes.php?area=<?php echo $area[$i]->getNome(); ?>" class="categories__calls__description--home">
                    Ver mais
                </a>
                </nav>
            </div>
        <?php
            $i++;
            }}
        ?>
        </div>
      </section>
        <!-- Contact-->
        <?php include_once "../includes/contato.php"; ?>
        <!-- Footer-->
        <?php include_once "../includes/footer.php"; ?>
        <?php include_once "../includes/links.php"; ?>
        <script src="../js/scripts.js"></script>
    </body>
</html>
