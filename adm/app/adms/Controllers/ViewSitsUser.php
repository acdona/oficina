<?php
namespace App\sts\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe ViewSitsUser responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class ViewSitsUser
{

    
    private int $id;
    private $dados;

    public function index($id) {
        $this->id = (int) $id;
        if (!empty($this->id)) {
            $viewSitsUser = new \App\sts\Models\StsViewSitsUser();
            $viewSitsUser->viewSitsUser($this->id);
            if ($viewSitsUser->getResultado()) {
                $this->dados['viewSitsUser'] = $viewSitsUser->getResultadoBd();
                $this->viewSitsUser();
            } else {
                $urlDestino = URLADM . "list-sits-users/index";
                header("Location: $urlDestino");
            }
        } else {
            $_SESSION['msg'] = "Situação para usuário não encontrado<br>";
            $urlDestino = URLADM . "list-sits-users/index";
            header("Location: $urlDestino");
        }
    }
    
    private function viewSitsUser() {
        $carregarView = new \App\sts\core\ConfigView("sts/Views/sitsUser/viewSitsUser", $this->dados);
        $carregarView->renderizar();
    }

}

?>