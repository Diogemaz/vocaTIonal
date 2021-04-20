<?php
    include_once "../model/area.php";
    include_once "../model/profissao.php";
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
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">Sobre</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="areas.php">Áreas</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">Contato</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="view/entra.php">Entrar</a></li>
                    </ul>
                </div>
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
         <nav class="categories--home">
         <div class="categories__elements--home">
         <?php
            if(!isset($_GET['area'])){
            $area = new area;
            $QtdArea = $area->QtdArea();
            $i = 0; 
            while($i < $QtdArea){
               if($area->consultarArea($i)){
         ?>
          <div class="categories__wrapper__links--home --<?php $area->getNome(); ?>" style="--color-var: #ffba05">
            <a class="categories__link--home" href="areas.php?area=<?php echo $area->getNome(); ?>">
               <div class="categories__link-wrapper--home">
                  <div class="categories__svg-wrapper--home" style="background:#ffba0552;"></div>
                  <div class="categories__texts" style="color:#ffba05;">
                     <h4 class="categories__link__category-name"><?php echo ucfirst($area->getNome()); ?></h4>
                  </div>
               </div>
            </a>
            <nav class="categories__calls--home">
               <a href="cursos-online-mobile/multiplataforma.html" class="categories__calls__description--home">
                    <?php echo substr($area->getDescricao(), 0, 80); ?>...
               </a>
               <a href="cursos-online-mobile/multiplataforma.html" class="categories__calls__description--home">
                  Ver mais
               </a>
            </nav>
         </div>
         <?php
               }
            $i++;
            }}else{
            $areaUnica = new area;
            $nome = $_GET['area'];
            if($areaUnica->consultarAreaNome($nome)){
         ?>
         <?php
            foreach($areaUnica->getProfissoes() as $profissao){
         ?>
          <div class="categories__wrapper__links--home --<?php $profissao->getNome(); ?>" style="--color-var: #ffba05">
            <a class="categories__link--home" href="areas.php?area=<?php echo $profissao->getNome(); ?>">
               <div class="categories__link-wrapper--home">
                  <div class="categories__svg-wrapper--home" style="background:#ffba0552;"></div>
                  <div class="categories__texts" style="color:#ffba05;">
                     <h4 class="categories__link__category-name"><?php echo ucfirst($profissao->getNome()); ?></h4>
                  </div>
               </div>
            </a>
            <nav class="categories__calls--home">
               <a href="cursos-online-mobile/multiplataforma.html" class="categories__calls__description--home">
                    <?php echo $profissao->getSalario(); ?>
               </a>
               <a href="cursos-online-mobile/multiplataforma.html" class="categories__calls__description--home">
                  Ver mais
               </a>
            </nav>
        </div>
        <?php
                }
            }}
        ?>
      </section>
        <!-- Contact-->
        <?php include_once "../includes/contato.php"; ?>
        <!-- Footer-->
        <?php include_once "../includes/footer.php"; ?>
        <!-- Bootstrap core JS-->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
        <!-- Core theme JS-->
        <script src="../js/scripts.js"></script>
    </body>
</html>
