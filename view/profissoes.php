<?php
    session_start();
    include_once "../model/area.php";
    include_once "../model/profissao.php";
    include_once "../model/usuario.php";
    $arquivo = basename( __FILE__ );
    if(isset($_GET['area'])){
        $nome = $_GET['area'];
        $area = new area;
        $QtdArea = $area->QtdArea();
        $area->consultarAreaNome($nome);
        $_SESSION['area'] = serialize($area);
        if(isset($_SESSION['user'])){
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
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="../index.php#about">Sobre</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="areas.php">Áreas</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="../index.php#contact">Contato</a></li>
                        <?php 
                            if(isset($user)){
                        ?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="entra.php?logout=1">Sair</a></li>
                        <?php
                            }else{
                        ?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="entra.php">Entrar</a></li>
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
            <div class="container">
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
                </nav>
                </div>
            </div>
            <div class="row justify-content-center">
                <?php 
                    if(isset($user)){
                ?>
                <form  id="form-favorita" onsubmit="favorita();" method="POST" action="../controller/favoritaArea.php">
                    <input type="text" style="display: none;" id="user" value="<?php if(isset($user)){ echo $user->getId();} ?>"> 
                    <button type="submit" class="btn btn-light btn-xl js-scroll-trigger" id="favoritar" name="favoritar"><?php 
                         $fav = $area->consultarAreaFavoritada($user->getId());
                         $i = 0;
                        while($row = $fav->fetch()){
                            if($row['id_area'] == $area->getId()){
                                echo "Remover Favorito";
                                $i = 1;
                                break;
                            }
                        }
                        if($i == 0){
                           echo "Favoritar área"; 
                        }
                    ?></button>
                </form>
                <?php }else{ ?>
                    <button type="button" class="btn btn-light btn-xl js-scroll-trigger" onclick="favoritaSemUser();" name="favoritar">Favoritar área</button>
                <?php } ?>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    </body>
</html>
