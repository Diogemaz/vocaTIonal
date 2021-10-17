<?php
    session_start();
    $arq = basename(__FILE__);
    include_once "../model/area.php";
    include_once "../model/profissao.php";
    include_once "../model/usuario.php";
    $arquivo = basename( __FILE__ );
    if(isset($_GET['area'])){
        $nome = $_GET['area'];
        $area = new area;
        $area->consultarAreaNome($nome);
        $_SESSION['area'] = serialize($area);
        if(isset($_SESSION['user'])){
            $user = unserialize($_SESSION['user']);
            $area->pegarAvaliacao($user->getId());
            $id = $user->getId();
        }else{
            $area->Avaliacao();
            $id = null;
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
        <link rel="stylesheet" href="../css/cards.css">
    </head>
    <body id="page-top">
    
        <div class="container" style="position: relative; z-index: 1;">
            <div class="d-flex justify-content-center h-100">
                <div class="alert alert-danger resposta" role="alert" id="resposta" style="display: none"></div>
                <div class="alert alert-warning resposta" role="alert" id="resposta" style="display: none"></div>
                <div class="alert alert-success resposta" role="alert" id="resposta" style="display: none"></div>
            </div>
        </div>
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
                        <h1 class="text-uppercase text-white font-weight-bold animated fadeIn"><?php echo $nome; ?></h1>
                        <hr class="divider my-4 animated fadeInLeft" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 font-weight-light mb-5 animated fadeInRight"><?php echo $area->getDescricao(); ?></p>
                    </div>
                </div>
            </div>
        </header>
        <section class="bg-primary" id="opcoes">
            <div class="container animated fadeIn">
                <div class="row justify-content-center">       
                        <button class="borda-btn" id="profissoes" onclick="TrocarFoco('services-profissoes','services-trilhas')">Profissoes</button>
                        <button class="borda-btn" id="trilhas" onclick="TrocarFoco('services-trilhas','services-profissoes')">Trilhas</button>
                </div>
            </div>
        </section>
        <!-- trilas-->
        <section class="page-section bg-primary" id="services-trilhas" style="position: relative; z-index: 0; display:none;">
            <div class="container animated fadeIn">
                <div class="row justify-content-center mb-5">       
                    <button class="circulo" onclick="EscolheItem('1')">1</button>       
                    <button class="circulo" onclick="EscolheItem('2')">2</button>       
                    <button class="circulo">3</button>       
                    <button class="circulo">4</button>
                </div>
                <div class="row justify-content-center"> 
                    <div id="conteudo-1">      
                        <div class="text-center titulo" id="titulo">1 - O raciocínio lógico</div>
                        <div class="conteudo" id="texto">
                            O raciocínio lógico nos acompanha o tempo todo. Por exemplo, para fazer café, precisamos primeiro aquecer a água, depois despejarmos ela quente sobre o pó de café, assim o pó será coado e o café estará pronto para beber. Caso não siga sequência lógica, vai ser difícil saborear um bom café.
                            A lógica de programação nada mais é do que uma sequência de passos para resolver um problema. Quem vai resolver o problema, nesse caso, é o computador, baseado nas instruções que passamos para ele. Então, precisamos saber quais tipos de instruções o computador entende e qual a melhor forma de passarmos os comandos para nos comunicarmos com ele.
                        </div>
                    </div>
                    <div id="conteudo-1" style="display:none;">      
                        <div class="text-center titulo" id="titulo">2 - Conhecer o Sistema Operacional</div>
                        <div class="conteudo" id="texto">
                            Agora que você molhou os pés no mundo da programação e dos códigos, é importante que você conheça como o computador funciona e como ele interpreta os códigos que criamos. Isso porque, todo código que criamos será executado por uma máquina, então saber como elas funcionam nos ajuda a entender melhor os problemas comuns que toda pessoa na área de tecnologia precisa resolver diariamente.
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Profissoes-->
        <section class="page-section bg-primary" id="services-profissoes" style="position: relative; z-index: 0;">
            <link rel="stylesheet" href="../css/estilo.css">
            <div class="container">
                <div class="row align-items-center justify-content-center mb-5">
                <?php 
                    foreach($area->getProfissoes() as $profissao){
                            
                ?>
                <div class="card borda animated fadeInRight" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $profissao->getNome(); ?></h5>
                        <p class="card-text link-card">
                            Média salarial: <?php echo $profissao->getSalario(); ?>
                        </p>
                        <div class="text-center">
                            <a href="cursos.php?profissao=<?php echo $profissao->getNome(); ?>" class="text-center">Ver Mais</a>
                        </div>
                    </div>
                </div>
            <?php
                    }}
            ?>
                </div>
            </div>
            <div class="row justify-content-center">
                <?php 
                    if(isset($user)){
                ?>
                <form  id="form-favorita" onsubmit="favorita();" method="POST" action="../controller/favoritaArea.php">
                    <input type="text" style="display: none;" id="user" value="<?php if(isset($user)){ echo $user->getId();} ?>"> 
                    <button type="submit" class="btn btn-light btn-xl js-scroll-trigger animated fadeInDown" id="favoritar" name="favoritar"><?php 
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
      <section class="bg-primary" id="avaliacao">
            <div class="container">
                <div class="d-flex justify-content-center">
                    <?php if(isset($_SESSION['user'])){ ?>
                    <button style="border: 0; background: transparent" onclick="like()">
                        <img id="like" src="<?php if($area->getAvaliacao() == 1){ echo "../assets/img/like_sel.png"; }else{ echo "../assets/img/like.png"; } ?>" height="40px" width="40px">
                    </button>
                    <button style="border: 0; background: transparent" onclick="deslike()">
                        <img id="deslike" class="mt-3 rotate" src="<?php if($area->getAvaliacao() == -1){ echo "../assets/img/like_sel.png"; }else{ echo "../assets/img/like.png"; } ?>" height="40px" width="40px">
                    </button>
                    <?php }else{ ?>
                        <button style="border: 0; background: transparent" onclick="semUser()">
                            <img id="like" src="../assets/img/like.png" height="40px" width="40px">
                        </button>
                        <button style="border: 0; background: transparent" onclick="semUser()">
                            <img id="deslike" class="mt-3 rotate" src="../assets/img/like.png" height="40px" width="40px">
                        </button>
                    <?php } ?>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="col-4">
                        <div class="progress">
                            <div class="progress-bar" style="width: <?php if($area->getProcAvaliacao() == -1){ echo 0; }else{echo $area->getProcAvaliacao();} ?>%" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="text-center text-white"><?php if($area->getProcAvaliacao() == -1){echo "Área não avaliada";}else{echo number_format($area->getProcAvaliacao(), 2, ",", "") . "%";} ?></div>
                    </div>   
                </div>     
            </div>
      </section>
      <!--Área de comentario-->
      <section class="bg-primary2" id="comentarios">
            <div class="container pt-2">
                <form id="comentar" onsubmit="comentar();" method="POST">
                    <div class="form-group">
                        <label class="text-white" for="comentario">Deixe seu comentário</label>
                        <textarea class="form-control" required id="comentario" data-ls-module="charCounter" oninput="if(this.scrollHeight > this.offsetHeight) this.rows += 1" maxlength="500" name="comentario" rows="1"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
                <h2 class="text-uppercase text-primary font-weight-bold pb-5 pt-3 m-0">Comentários</h2>
                <div id="retorno">
                </div>
                <!--comentario 1-->
                <?php 
                    $resultado = $area->getComentario();
                    while($comentario = $resultado->fetch()){ 
                        if($comentario['foto'] == null){
                            $img = "../assets/img/user/padrao.png";
                        }else{
                            $img = "../assets/img/user/" . $comentario['foto'];
                        }
                ?>
                <div class="row pt-2">
                    <div class="col-1"><img class="img-user" src="<?php echo $img; ?>"></div>
                    <div class="comentario pt-0 pl-4 col-11" style="border-radius: 20px;">
                        <div class="h-25 row mb-2 mt-2">
                            <p class="text-primary mb-1 mr-2"><?php echo $comentario['nome_usuario']; ?></p>
                            <div class="d-flex h-50 align-items-center mt-2 mr-2" style="font-size: 10px">
                                <?php echo str_replace("-", "/", date('d/m/Y', strtotime($comentario['data_comentario']))); ?>
                            </div>
                            <?php if($comentario['id_usuario'] == $id){ ?>
                                <input type="hidden" id="comentarioId" value="<?php echo $comentario['id_comentarioArea']; ?>">
                                <div class="d-flex justify-content-end col-9 ml-5">
                                    <ul class="navbar-nav ml-auto my-2 my-lg-0">
                                        <li class="nav-item dropdown">
                                            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                ...
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                <button class="dropdown-item" onclick="excluirComentario(<?php echo $comentario['id_comentarioArea']; ?>);">Excluir</button>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="row pb-2 pt-2">
                            <div class="col">
                                <span><?php echo $comentario['comentario']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
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
