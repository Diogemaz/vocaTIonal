<?php
session_start();
include_once "../model/usuario.php";
include_once "../model/area.php";
include_once "../model/profissao.php";
if (isset($_SESSION['user'])) {
    $user = unserialize($_SESSION['user']);
    $userId = $user->getId();
    $comentario = substr($_POST['comentario'], 0, 501);
    if (!empty(trim($comentario))) {
        if (!preg_match("<script>", $comentario) && !preg_match("<SCRIPT>", $comentario)) {
            if ($_POST['local'] == 'area') {
                $area = unserialize($_SESSION['area']);
                $cadastro = $area->Comentar($comentario, $userId);
            } else if ($_POST['local'] == 'profissao') {
                $profissao = unserialize($_SESSION['profissao']);
                $cadastro = $profissao->Comentar($comentario, $userId);
            }
            try {
                if ($cadastro == 1) {
                    $response = 1;
                } else {
                    $response = -2;
                }
            } catch (Exception $e) {
                $response = -1;
            }
        }else{ $response = -4; }
    } else {
        $response = -3;
    }
} else {
    $response = 0;
}
echo json_encode($response);
