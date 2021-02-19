<?php
namespace App\sts\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Controller ViewUser responsável por vizualizar usuario
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class ViewUser
{

    private int $id;
    private $dados;

    public function index($id) {
        
        $this->id = (int) $id;
        if (!empty($this->id)) {
            $viewUser = new \App\sts\Models\StsViewUser();
            $viewUser->viewUser($this->id);
            if ($viewUser->getResultado()) {
                $this->dados['viewUser'] = $viewUser->getResultadoBd();
                $this->viewUser();
            } else {
                $urlDestino = URLADM . "list-users/index";
                header("Location: $urlDestino");
            }
        } else {
            $_SESSION['msg'] = "Usuário não encontrado<br>";
            $urlDestino = URLADM . "list-users/index";
            header("Location: $urlDestino");
        }
    }
    
    private function viewUser() {
        $carregarView = new \App\sts\core\ConfigView("sts/Views/user/viewUser", $this->dados);
        $carregarView->renderizar();
    }

}

?>