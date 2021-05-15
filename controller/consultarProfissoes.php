<?php
    session_start();
    include_once "../model/area.php";
    include_once "../model/usuario.php";
    include_once "../model/profissao.php";
    include_once "../model/curso.php";
    $response = array();
    if(isset($_SESSION['user'])){
        $user = unserialize($_SESSION['user']);
        if($user->getAdm() == 1){
            $area = new area;
            $id_area = $_POST['area'];
            try{
                if($id_area > 0 ){
                $area->consultarArea($id_area);
                foreach($area->getProfissoes() as $profissoes){
                ?>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <a href="?area=<?php echo $area->getId(); ?>&profissao=<?php echo $profissoes->getId(); ?>">
                            <div class="card card-hover">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                                    <h6 class="text-white"><?php echo $profissoes->getNome() ?></h6>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php
                }}else{
                    ?>
                    <h2>Nenhuma área selecionada</h2>
                    <?php
                }
            }catch (Exception $e){
                echo $response = $e;
            }   
        }
    }else{
        header('location: ../view/entra.php');
    }

?>