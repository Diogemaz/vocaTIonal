<?php
session_start();
include_once "../model/usuario.php";
include_once "../model/area.php";
include_once "../model/profissao.php";
if(isset($_SESSION['user'])){
    $user = unserialize($_SESSION['user']);
    if($user->getAdm() == 1){
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <!-- Favicon icon -->
    <!-- Custom CSS -->
    <link href="../assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <style>   
        .resposta{
            position: fixed;
            top: 100px;
        }
    </style>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon -->
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <h2>Bem vindo:</h2>
                            <h6><?php echo $user->getNomeUsuario(); ?></h6>

                        </span>
                        <!-- Logo icon -->
                        <!-- <b class="logo-icon"> -->
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                        <!-- <img src="../assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

                        <!-- </b> -->
                        <!--End Logo icon -->
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-start me-auto">
                        <li class="nav-item d-none d-lg-block"><a
                                class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)"
                                data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                        <!-- ============================================================== -->
                        <!-- create new -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-end">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-bell font-24"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" id="2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                 <i class="font-24 mdi mdi-comment-processing"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end mailbox animated bounceInDown" aria-labelledby="2">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="">
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-success btn-circle"><i
                                                            class="ti-calendar"></i></span>
                                                    <div class="ms-2">
                                                        <h5 class="mb-0">Notificação</h5>
                                                        <span class="mail-desc">Notifica</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-info btn-circle"><i
                                                            class="ti-settings"></i></span>
                                                    <div class="ms-2">
                                                        <h5 class="mb-0">Settings</h5>
                                                        <span class="mail-desc">Teste</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-primary btn-circle"><i
                                                            class="ti-user"></i></span>
                                                    <div class="ms-2">
                                                        <h5 class="mb-0">Pavan kumar</h5>
                                                        <span class="mail-desc">Just see the my admin!</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-danger btn-circle"><i
                                                            class="fa fa-link"></i></span>
                                                    <div class="ms-2">
                                                        <h5 class="mb-0">Luanch Admin</h5>
                                                        <span class="mail-desc">Just see the my new admin!</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </ul>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <?php include_once "../includes/menu-adm.php"; ?>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="pt-4">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="adm-dashboard.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                                    class="hide-menu">Dashboard</span></a>
                                </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="adm-area.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                                    class="hide-menu">Áreas</span></a>
                                </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="adm-profissao.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                                    class="hide-menu">Profissões</span></a>
                                </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="adm-curso.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                                    class="hide-menu">Cursos</span></a>
                                </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="adm-lista.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                                    class="hide-menu">Administradores</span></a>
                                </li>
                            </ul>
                        </li> 
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <div class="container" style="position: relative; z-index: 1;">
                <div class="d-flex justify-content-center h-100">
                    <div class="alert alert-warning resposta" role="alert" id="resposta" style="display: none"></div>
                    <div class="alert alert-danger resposta" role="alert" id="resposta" style="display: none"></div>
                    <div class="alert alert-success resposta" role="alert" id="resposta" style="display: none"></div>
                </div>
            </div> 
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <select id="areaSelect" name="areaSelect" onchange="profissoes(this.value)">
                            <option value="0">SELECIONE A ÁREA</option>
                            <?php 
                                $areas = new area;
                                $i = 0;
                                $resultado = $areas->getAreas();
                                while($row = $resultado->fetch()){
                                    $area[$i] = new area;
                                    $area[$i]->consultarArea($row['id_area']); 
                            ?>
                                <option value="<?php echo $area[$i]->getId(); ?>"><h4 class="page-title"><?php echo $area[$i]->getNome(); ?></h4></option>
                            <?php
                                $i++;
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Sales Cards  -->
                <!-- ============================================================== -->
                <div class="row" id="retorno">
                </div>
            <?php if(!isset($_GET['profissao'])){ ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <form class="form-horizontal" id="form-profissao" onsubmit="cadastrarProfissao();" action="../controller/cadastrarProfissao.php" method="POST">
                                    <div class="card-body">
                                        <h4 class="card-title">Adicionar profissão:</h4>
                                        <div class="form-group row">
                                            <label for="nome" class="col-sm-3 text-end control-label col-form-label">Nome:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="nome" name="nome" maxlength="35" placeholder="Nome da profissão." required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="salario" class="col-sm-3 text-end control-label col-form-label">Salario:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="salario" name="salario" placeholder="Salario da profissão." required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="area" class="col-sm-3 text-end control-label col-form-label">Área:</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="area" id="area">
                                                    <?php 
                                                        $areas = new area;
                                                        $i = 0;
                                                        $resultado = $areas->getAreas();
                                                        while($row = $resultado->fetch()){
                                                            $area[$i] = new area;
                                                            $area[$i]->consultarArea($row['id_area']); 
                                                    ?>
                                                        <option value="<?php echo $area[$i]->getId(); ?>"><?php echo $area[$i]->getNome(); ?></option>
                                                    <?php
                                                        $i++;
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top">
                                        <div class="card-body">
                                            <button type="submit" class="btn btn-primary">Enviar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }else{ 
                $reflect = new ReflectionClass('profissao');
                $profissao = $reflect->newInstanceWithoutConstructor();
                $profissao->consultarProfissao($_GET['profissao']);
                $_SESSION['profissao'] = serialize($profissao);    
            ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <form class="form-horizontal" id="form-profissao" action="../controller/cadastrarProfissao.php" method="POST">
                                    <div class="card-body">
                                        <h4 class="card-title"><?php echo $profissao->getNome(); ?></h4>
                                        <div class="form-group row">
                                            <label for="nome" class="col-sm-3 text-end control-label col-form-label">Nome:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="nome" maxlength="35" name="nome" placeholder="Nome da profissão." required value="<?php echo $profissao->getNome(); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="salario" class="col-sm-3 text-end control-label col-form-label">Salario:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="salario" name="salario" placeholder="Salario da profissão." required value="<?php echo $profissao->getSalario(); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="area" class="col-sm-3 text-end control-label col-form-label">Área:</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="area" id="area">
                                                    <?php 
                                                         $areas = new area;
                                                         $i = 0;
                                                         $resultado = $areas->getAreas();
                                                         while($row = $resultado->fetch()){
                                                             $area[$i] = new area;
                                                             $area[$i]->consultarArea($row['id_area']); 
                                                         if($area[$i]->getId() == $_GET['area']){
                                                    ?>
                                                        <option selected value="<?php echo $area[$i]->getId(); ?>"><?php echo $area[$i]->getNome(); ?></option>
                                                    <?php
                                                         }else{
                                                    ?>
                                                        <option value="<?php echo $area[$i]->getId(); ?>"><?php echo $area[$i]->getNome(); ?></option>
                                                    <?php
                                                         }
                                                        $i++;
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top">
                                        <div class="card-body">
                                            <button onclick="alterarProfissao();" class="btn btn-primary">Alterar</button>
                                            <button onclick="deletarProfissao();" class="btn btn-primary">Excluir</button>
                                        </div>
                                    </div>
                                </form>
                            <button class="btn btn-primary"><a href="adm-profissao.php" style="text-decoration: none; color: white;">Adicionar nova Profissao</a></button>  
                        </div>
                    </div>
                </div>
            <?php } ?>
                            

                    <!-- Column -->
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="../dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!-- <script src="../dist/js/pages/dashboards/dashboard1.js"></script> -->
    <!-- Charts js Files -->
    <script src="../assets/libs/flot/excanvas.js"></script>
    <script src="../assets/libs/flot/jquery.flot.js"></script>
    <script src="../assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="../assets/libs/flot/jquery.flot.time.js"></script>
    <script src="../assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="../assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="../assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="../dist/js/pages/chart/chart-page-init.js"></script>
    <script>      
        $(document).ready(function () {
            abriPagina();
        });
        form = document.getElementById('form-profissao');
        form.addEventListener('submit', e => {
            e.preventDefault()
        })
        function cadastrarProfissao(){
            var form = $('#form-profissao').serialize();
            console.log(form);
            $.ajax({
                type:'POST',
                url:'../controller/cadastrarProfissao.php',
                dataType: "json",
                data: form,
                success: function(response){
                if(response == 1 || response == 2){
                    profissoes($('#area option:selected').val());
                    $('#form-profissao').each (function(){
                        this.reset();
                    });
                }else if(response == 0){
                    $('.alert-warning').text("Falha ao cadastrar, tente novamente");
                    $('.alert-warning').show();
                    setInterval(() => {
                        $('.alert-warning').text("");
                        $('.alert-warning').hide('close');
                    }, 5000);
                }else if(response == -2){
                    $('.alert-warning').text("Nome da profissão deve ter letras");
                    $('.alert-warning').show();
                    setInterval(() => {
                        $('.alert-warning').text("");
                        $('.alert-warning').hide('close');
                    }, 5000);
                }
                },
                error: function(response){
                    $('.alert-danger').text("ERRO!"+response);
                    $('.alert-danger').show();
                    setInterval(() => {
                        $('.alert-danger').text("");
                        $('.alert-danger').hide('close');
                    }, 5000);
                }
            });
        };
        function deletarProfissao(){
            var funcao = "Excluir";
            alterarDeletarProfissao(funcao);
        }
        function alterarProfissao(){
            var funcao = "Alterar";
            alterarDeletarProfissao(funcao);
        }
        function alterarDeletarProfissao(funcao){
            var form = $('#form-profissao').serialize() + '&funcao=' + funcao;
            console.log(form);
            $.ajax({
                type:'POST',
                url:'../controller/alterarProfissao.php',
                dataType: "json",
                data: form,
                success: function(response){
                if(response == 1){
                    $('.alert-success').text("Alterado/deletado com sucesso!");;
                    $('.alert-success').show();
                    setInterval(() => {
                        $('.alert-success').text("");
                        $('.alert-success').hide('close');
                    }, 5000);
                    profissoes($('#area option:selected').val());                    
                }else if(response == 0){
                    $('.alert-warning').text("Falha ao alterar, tente novamente");
                    $('.alert-warning').show();
                    setInterval(() => {
                        $('.alert-warning').text("");
                        $('.alert-warning').hide('close');
                    }, 5000);
                }
                },
                error: function(response){
                    $('.alert-danger').text("ERRO!"+response);
                    $('.alert-danger').show();
                    setInterval(() => {
                        $('.alert-danger').text("");
                        $('.alert-danger').hide('close');
                    }, 5000);
                }
            });
        };
        function profissoes(area){
            $('#retorno').html("");
            $('#retorno').load("../controller/consultarProfissoes.php", {area : area});
        }
        function abriPagina(){
            if($('#areaSelect option:selected').val() == 0){
                var elemento = "<h2>Nenhuma Área selecionada</h2>";
                document.getElementById('retorno').innerHTML = elemento;
            }else{
                profissoes($('#areaSelect option:selected').val());
            }
        }
    </script>
</body>

</html>
<?php
}}else{
    header('location: entra.php');
}
?>