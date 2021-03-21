<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * ViewAccessLevel Controller. Responsible for viewing the access level.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class ViewAccessLevel
{
    /** @var int $id Receives an integer referring to the access level id. */
    private int $id;
    
    /** @var array $data Receives data that must be sent to VIEW. */
    private $data;

    public function index($id) {
        $this->id = $id;
        
        if (!empty($this->id)) {
            
            $viewAccessLevel = new \App\adms\Models\AdmsViewAccessLevel();
            $viewAccessLevel->viewAccessLevel($this->id);
       
            if ($viewAccessLevel->getResult()) {
                $this->data['viewAccessLevel'] = $viewAccessLevel->getDatabaseResult();
                $this->viewAccessLevel();
            } else {
                $urlDestiny = URLADM . "list-access-levels/index";
                header("Location: $urlDestiny");
            }
        } else {
           
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Nível de acesso não encontrado!</div>";
            $urlDestiny = URLADM . "list-access-levels/index";
            header("Location: $urlDestiny");
        }
    }
    
    private function viewAccessLevel() {
        $this->data['sidebarActive'] = "list-access-levels";
        $loadView = new \Core\ConfigView("adms/Views/accessLevels/viewAccessLevel", $this->data);
        $loadView->render();
    }

}

?>