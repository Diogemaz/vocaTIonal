<?php
    include_once "../model/area.php";
    include_once "../model/profissao.php";
    $arquivo = basename( __FILE__ );
    if(isset($_GET['area'])){
        $nome = $_GET['area'];
        $area = new area;
        $QtdArea = $area->QtdArea();
        $area->consultarAreaNome($nome);
        $_SESSION['area'] = serialize($area);
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
        <?php include_once "../includes/navegacao.php"; ?>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end">
                        <h1 class="text-uppercase text-white font-weight-bold"><?php echo $nome; ?></h1>
                        <hr class="divider my-4" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 font-weight-light mb-5"><?php echo $area->getDescricao(); ?></p>
                    </div>
                </div>
            </div>
        </header>
        <!-- areas-->
        <section class="page-section bg-primary" id="services">
            <link rel="stylesheet" href="../css/estilo.css">
            <div class="row">
            <nav class="categories--home">
            <div class="categories__elements--home">
            <?php 
                foreach($area->getProfissoes() as $profissao){
                        
            ?>
            <div class="categories__wrapper__links--home --<?php $profissao->getNome(); ?>" style="--color-var: #ffba05">
                <a class="categories__link--home" href="">
                <div class="categories__link-wrapper--home">
                    <div class="categories__texts" style="color:#ffba05;">
                        <h4 class="categories__link__category-name text-center"><?php echo $profissao->getNome(); ?></h4>
                    </div>
                </div>
                </a>
                <nav class="categories__calls--home">
                <h6 class="text-white-75 font-weight-light mt-3">
                   Salario: <?php echo $profissao->getSalario(); ?>
                </h6>
                <div class="d-flex justify-content-center">
                    <a href="" class="categories__calls__description--home">
                        Ver mais
                    </a>
                </div>
                </nav>
            </div>
        <?php
                }}
        ?>
        </div>
        </div>
        <div class="row justify-content-center">
            <button class="btn btn-light btn-xl js-scroll-trigger" id="favorita" onclick="favoritar();">Favoritar área</button>
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
