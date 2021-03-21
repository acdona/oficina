<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * ViewColor Controller responsible for viewing a color.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class ViewColor
{
    /** @var int $id Receives an integer referring to the color id. */
    private int $id;
    
    /** @var array $data Receives data that must be sent to VIEW. */
    private $data;

    public function index($id) {
        $this->id = $id;
        
        if (!empty($this->id)) {
            
            $viewColor = new \App\adms\Models\AdmsViewColor();
            $viewColor->viewColor($this->id);
       
            if ($viewColor->getResult()) {
                $this->data['viewColor'] = $viewColor->getDatabaseResult();
                $this->viewColor();
            } else {
                $urlRedirect = URLADM . "list-colors/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Cor não encontrada!</div>";
            
            $urlRedirect = URLADM . "list-colors/index";
            header("Location: $urlRedirect");
        }
    }
    
    private function viewColor() {
        $this->data['sidebarActive'] = "list-colors";
        $loadView = new \Core\ConfigView("adms/Views/colors/viewColor", $this->data);
        $loadView->render();
    }

}

?>