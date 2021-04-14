<?php 
session_start();
include_once "../model/usuario.php";
if(isset($_SESSION['user'])){
    $user = unserialize($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="pt-br">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <title>Área de Usuário - vocaTIonal</title>
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
   </head>
   <body id="page-top">
      <!-- Navigation-->
      <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
         <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top"><img src="../assets/img/voc2.png" width="140" height="50"></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
               <ul class="navbar-nav ml-auto my-2 my-lg-0">
                  <li class="nav-item"><a class="nav-link js-scroll-trigger" href="../index.php#about">Sobre</a></li>
                  <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#services">Áreas</a></li>
                  <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">Contato</a></li>
                  <li class="nav-item"><a class="nav-link js-scroll-trigger" href="../view/entra.php?logout=1" >Sair</a></li>
               </ul>
            </div>
         </div>
      </nav>
      <!-- Masthead-->
      <header class="masthead">
         <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
               <div class="col-lg-10 align-self-end">
                  <h1 class="text-uppercase text-white font-weight-bold">Bem-vindo (<?php echo $user->getNomeUsuario(); ?>)</h1>
                  <hr class="divider my-4" />
               </div>
               <div class="col-lg-8 align-self-baseline">
                  <p class="text-white-75 font-weight-light mb-5">Suas areas pré-avaliadas estão listadas abaixo, sinta-se a contade para explorar as que mais te interessarem.</p>
                  <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Areas</a>
               </div>
            </div>
         </div>
      </header>
      <!-- About-->
      <section class="page-section bg-primary" id="services">
         <link rel="stylesheet" href="../css/estilo.css">
         <nav class="categories--home">
         <div class="categories__elements--home">
         <!-- Cubinho 0 -->
         <div class="categories__wrapper__links--home --mobile" style="--color-var: #ffba05">
            <a class="categories__link--home" href="cursos-online-mobile.html">
               <div class="categories__link-wrapper--home">
                  <div class="categories__svg-wrapper--home" style="background:#ffba0552;"></div>
                  <div class="categories__texts" style="color:#ffba05;">
                     <h4 class="categories__link__category-name">Segurança da Informação</h4>
                  </div>
               </div>
            </a>
            <nav class="categories__calls--home">
               <a href="cursos-online-mobile/multiplataforma.html" class="categories__calls__description--home">
                    Flutter, React Native
               </a>
               <span class="categories__calls__description-separator">, </span>
               <a href="cursos-online-mobile/ios.html" class="categories__calls__description--home">
                    iOS e Swift
               </a>
               <span class="categories__calls__description-separator">, </span>
               <a href="cursos-online-mobile/android.html" class="categories__calls__description--home">
                    Android, Kotlin
               </a>
               <span class="categories__calls__description-separator">, </span>
               <a href="cursos-online-mobile/jogos.html" class="categories__calls__description--home">
                    Jogos
               </a>
               <span class="categories__calls__description-separator"></span>
               <a href="cursos-online-mobile.html" class="categories__calls__link-see-more--home">
                    e mais...
                </a>
            </nav>
         </div>
         <!-- Cubinho 1 -->
         <div class="categories__wrapper__links--home --programacao" style="--color-var: #00c86f">
            <a class="categories__link--home" href="cursos-online-mobile.html">
               <div class="categories__link-wrapper--home">
                  <div class="categories__svg-wrapper--home" style="background:#ffba0552;"></div>
                  <div class="categories__texts" style="color:#ffba05;">
                     <h4 class="categories__link__category-name">Banco de dados</h4>
                  </div>
               </div>
            </a>
            <nav class="categories__calls--home">
               <a
                  href="cursos-online-mobile/multiplataforma.html"
                  class="categories__calls__description--home">Flutter, React Native</a><span
                  class="categories__calls__description-separator">, </span>
               <a
                  href="cursos-online-mobile/ios.html"
                  class="categories__calls__description--home">iOS e Swift</a><span
                  class="categories__calls__description-separator">, </span>
               <a
                  href="cursos-online-mobile/android.html"
                  class="categories__calls__description--home">Android, Kotlin</a><span
                  class="categories__calls__description-separator">, </span>
               <a
                  href="cursos-online-mobile/jogos.html"
                  class="categories__calls__description--home">Jogos</a><span
                  class="categories__calls__description-separator"></span>
               <a
                  href="cursos-online-mobile.html"
                  class="categories__calls__link-see-more--home">e mais...</a>
            </nav>
         </div>
         <!-- Cubinho 2 -->
         <div class="categories__wrapper__links--home --FRONT-END" style="--color-var: #00c86f">
            <a class="categories__link--home" href="cursos-online-mobile.html">
               <div class="categories__link-wrapper--home">
                  <div class="categories__svg-wrapper--home" style="background:#ffba0552;"></div>
                  <div class="categories__texts" style="color:#ffba05;">
                     <h4 class="categories__link__category-name">Administração de redes</h4>
                  </div>
               </div>
            </a>
            <nav class="categories__calls--home">
               <a
                  href="cursos-online-mobile/multiplataforma.html"
                  class="categories__calls__description--home">Flutter, React Native</a><span
                  class="categories__calls__description-separator">, </span>
               <a
                  href="cursos-online-mobile/ios.html"
                  class="categories__calls__description--home">iOS e Swift</a><span
                  class="categories__calls__description-separator">, </span>
               <a
                  href="cursos-online-mobile/android.html"
                  class="categories__calls__description--home">Android, Kotlin</a><span
                  class="categories__calls__description-separator">, </span>
               <a
                  href="cursos-online-mobile/jogos.html"
                  class="categories__calls__description--home">Jogos</a><span
                  class="categories__calls__description-separator"></span>
               <a
                  href="cursos-online-mobile.html"
                  class="categories__calls__link-see-more--home">e mais...</a>
            </nav>
         </div>
         <!-- Cubinho 3 -->
         <div class="categories__wrapper__links--home --DEVOPS" style="--color-var: #00c86f">
            <a class="categories__link--home" href="cursos-online-mobile.html">
               <div class="categories__link-wrapper--home">
                  <div class="categories__svg-wrapper--home" style="background:#ffba0552;"></div>
                  <div class="categories__texts" style="color:#ffba05;">
                     <h4 class="categories__link__category-name">Qualidade de software</h4>
                  </div>
               </div>
            </a>
            <nav class="categories__calls--home">
               <a
                  href="cursos-online-mobile/multiplataforma.html"
                  class="categories__calls__description--home">Flutter, React Native</a><span
                  class="categories__calls__description-separator">, </span>
               <a
                  href="cursos-online-mobile/ios.html"
                  class="categories__calls__description--home">iOS e Swift</a><span
                  class="categories__calls__description-separator">, </span>
               <a
                  href="cursos-online-mobile/android.html"
                  class="categories__calls__description--home">Android, Kotlin</a><span
                  class="categories__calls__description-separator">, </span>
               <a
                  href="cursos-online-mobile/jogos.html"
                  class="categories__calls__description--home">Jogos</a><span
                  class="categories__calls__description-separator"></span>
               <a
                  href="cursos-online-mobile.html"
                  class="categories__calls__link-see-more--home">e mais...</a>
            </nav>
         </div>
         <!-- Cubinho 4 -->
         <div class="categories__wrapper__links--home --DESIGN" style="--color-var: #00c86f">
            <a class="categories__link--home" href="cursos-online-mobile.html">
               <div class="categories__link-wrapper--home">
                  <div class="categories__svg-wrapper--home" style="background:#ffba0552;"></div>
                  <div class="categories__texts" style="color:#ffba05;">
                     <h4 class="categories__link__category-name">Programação</h4>
                  </div>
               </div>
            </a>
            <nav class="categories__calls--home">
               <a
                  href="cursos-online-mobile/multiplataforma.html"
                  class="categories__calls__description--home">Flutter, React Native</a><span
                  class="categories__calls__description-separator">, </span>
               <a
                  href="cursos-online-mobile/ios.html"
                  class="categories__calls__description--home">iOS e Swift</a><span
                  class="categories__calls__description-separator">, </span>
               <a
                  href="cursos-online-mobile/android.html"
                  class="categories__calls__description--home">Android, Kotlin</a><span
                  class="categories__calls__description-separator">, </span>
               <a href="cursos-online-mobile/jogos.html" class="categories__calls__description--home">Jogos</a>
               <span class="categories__calls__description-separator"></span>
               <a href="cursos-online-mobile.html" class="categories__calls__link-see-more--home">e mais...</a>
            </nav>
         </div>
      </section>
      <!-- Contact-->
      <?php include_once "../includes/contato.php" ?>
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
<?php
}else{
    echo "Acesso negado";
}
?>