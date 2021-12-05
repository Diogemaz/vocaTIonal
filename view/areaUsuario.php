<?php 
session_start();
include_once "../model/usuario.php";
include_once "../model/area.php";
include_once "../model/profissao.php";
$arq = basename( __FILE__ );
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
        <link href="../css/cards.css" rel="stylesheet" />
   </head>
   <body id="page-top">
      <!-- Navigation-->
      <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container-fluid">
                <a class="navbar-brand js-scroll-trigger" href="../index.php"><img src="../assets/img/voc2.png" width="140" height="50"></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <?php include_once "../includes/menu.php" ?>
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
      <section class="page-section bg-primary" id="services" style="position: relative; z-index: 0;">
        <div class="container">
            <div class="row align-items-center justify-content-center mb-5">
               <?php
                     $area = new area; 
                     $resultado = $area->consultarAreaFavoritada($user->getId());  
                     while($row = $resultado->fetch()){

               ?>
                    <div class="card borda animated fadeInRight" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['nome_area']; ?></h5>
                            <p class="card-text link-card">
                                <?php echo substr($row['descricao'], 0, 70); ?>...
                            </p>
                            <div class="text-center">
                                <a href="profissoes.php?area=<?php echo $row['nome_area']; ?>" class="text-center">Ver mais</a>
                            </div>
                            <div class="row avaliacao">
                                <div class="col-1"><img src="../assets/img/star1.png" width="30" height="30"></div>
                                <div class="col mt-1">
                                    <h6 class="text-white-75 font-weight-light mt-1">
                                        <?php echo $row['num_favorite']; ?>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                  }
                ?>
            </div>
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