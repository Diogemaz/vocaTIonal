<?php 
    session_start();
    include_once "../model/usuario.php";
    include_once "../model/area.php";
    include_once "../model/profissao.php";
    $arq = basename( __FILE__ );
    if(isset($_SESSION['user'])){
        $user = unserialize($_SESSION['user']);
        if($user->getImg() == null){
            $img = "../assets/img/user/padrao.png";
        }else{
            $img = "../assets/img/user/" . $user->getImg();
        }
?>
<!DOCTYPE html>
<html lang="pt-br">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <title>Configuração de Usuário - vocaTIonal</title>
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
                  <h1 class="text-uppercase text-white font-weight-bold">Configurações de Usuário</h1>
               </div>
               <div class="container bg-white">
                    <form id="form-altUser" action="../controller/alterarUsuario.php" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-6 mt-2">
                            <img class="img-user" src="<?php echo $img; ?>">
                            <div><label id="foto2" for='foto'>Selecionar uma foto</label></div>
                            <input type="file" class="form-control-file" name="foto" id="foto">
                            </div>
                            <div class="form-group col-md-6 mt-3">
                            <label for="nome">Nome de usuário</label>
                            <input type="text" class="form-control" id="nome" name="nome" required placeholder="Nome de usuário" value="<?php echo $user->getNomeUsuario(); ?>" maxlength="25">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary mb-2" value="Alterar">
                    </form>
                    <button class="btn btn-primary mb-2" data-toggle="modal" onclick="modalSenha();" data-target="#AltSenha">Alterar Senha</button>
                </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" id="AltSenha" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Alterar Senha</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../controller/alterarSenhaUsuario.php" method="POST" id="form-altUserSenha" onsubmit="alterarSenha();">
                        <div class="form-row align-content-center">
                            <div class="form-group col-md-6 mt-2">
                                <label for="senha">Nova senha</label>
                                <input type="password" class="form-control" required id="senha" name="senha" placeholder="Nova Senha">
                                <label for="confSenha">Confirmar senha</label>
                                <input type="password" class="form-control" id="confSenha" required name="confSenha" placeholder="Confirma nova senha">
                            </div>
                        </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Alterar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
                </form>
                </div>
            </div>
        </div>
      </header>
      </section>
      <!-- Contact-->
      <?php include_once "../includes/contato.php" ?>
      <!-- Footer-->
      <?php include_once "../includes/footer.php"; ?>
      <?php include_once "../includes/links.php"; ?>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="../js/scripts.js"></script>
      <script>
        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;
            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
        }; 
        var status = getUrlParameter('status');
        if(status == "falha"){
            alert("Falha ao alterar");
        }
        $('#nome').blur(function(){
            if($('#nome').val() == ""){
                alert("Nome não deve estar vazio")
            }
        })
      </script>
   </body>
</html>
<?php
    }else{
    header('location: entra.php');
    }
?>