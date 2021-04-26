<?php 
session_start();
include_once "../model/usuario.php";
include_once "../model/area.php";
include_once "../model/profissao.php";
$arquivo = basename( __FILE__ );
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
                <a class="navbar-brand js-scroll-trigger" href="../index.php"><img src="../assets/img/voc2.png" width="140" height="50"></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="../index.php#about">Sobre</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="areas.php">Áreas</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="../index.php#contact">Contato</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="entra.php?logout=1">Sair</a></li>
                    </ul>
                </div>
            </div>
        </nav>
      <!-- Masthead-->
      <header class="masthead">
         <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
               <div class="col-lg-10 align-self-end">
                  <h1 class="text-uppercase text-white font-weight-bold">Bem-vindo <?php echo $user->getNomeUsuario(); ?></h1>
                  <hr class="divider my-4" />
               </div>
               <div class="col-lg-8 align-self-baseline">
                  <p class="text-white-75 font-weight-light mb-5">Suas areas pré-avaliadas estão listadas abaixo, sinta-se a vontade para explorar as que mais te interessarem.</p>
                  <a class="btn btn-primary btn-xl js-scroll-trigger" href="areas.php">Áreas</a>
               </div>
            </div>
         </div>
      </header>
      <!-- About-->
      <section class="page-section bg-primary" id="services">
         <link rel="stylesheet" href="../css/estilo.css">
         <nav class="categories--home">
         <div class="categories__elements--home">
            <?php
                $area = new area; 
                $resultado = $area->consultarAreaFavoritada($user->getId());  
                while($row = $resultado->fetch()){

            ?>
            <div class="categories__wrapper__links--home --<?php $row['nome_area']; ?>" style="--color-var: #ffba05">
                <a class="categories__link--home" href="profissoes.php?area=<?php echo $row['nome_area']; ?>">
                <div class="categories__link-wrapper--home">
                    <div class="categories__svg-wrapper--home" style="background:#ffba0552;"></div>
                    <div class="categories__texts" style="color:#ffba05;">
                        <h4 class="categories__link__category-name"><?php echo ucfirst($row['nome_area']); ?></h4>
                    </div>
                </div>
                </a>
                <nav class="categories__calls--home">
                <a href="profissoes.php?area=<?php echo $row['nome_area']; ?>" class="categories__calls__description--home">
                        
                </a>
                <a href="profissoes.php?area=<?php echo $row['nome_area']; ?>" class="categories__calls__description--home">
                    Ver mais
                </a>
                </nav>
            </div>
        <?php
            }
        ?>
        </div>
      </section>
      <!-- Contact-->
      <?php include_once "../includes/contato.php" ?>
      <!-- Footer-->
      <?php include_once "../includes/footer.php"; ?>
      <?php include_once "../includes/links.php"; ?>
      <script src="../js/scripts.js"></script>
   </body>
</html>
<?php
}else{
   header('location: entra.php');
}
?>