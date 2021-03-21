<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * EditAccessLevel Controller. Responsible for editing an access level.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class EditAccessLevel
{
    /** @var array $data Receives the data that must be sent to VIEW. */
    private array $data=[];

    /** @var array $formData Receives the form data. */
    private $formData;

    /** @var int $id Receives an integer referring to the access level ID. */
    private $id;

    /** Index function that receives the access level ID. */
    public function index($id) {
        $this->id = (int) $id;

        $this->formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        /** If the id is not empty and the form data is empty */
        if (!empty($this->id) AND (empty($this->formData['EditAccessLevel']))) {
            /** Instantiate the model. */
            $viewAccessLevel = new \App\adms\Models\AdmsEditAccessLevel();
            /** Loads the model's viewAccessLevel. */
            $viewAccessLevel->viewAccessLevel($this->id);
            if ($viewAccessLevel->getResult()) {
               
                $this->data['form'] = $viewAccessLevel->getDatabaseResult();
                $this->viewEditAccessLevel();
              
            } else {
                $urlDestiny = URLADM . "list-access-levels/index";
                header("Location: $urlDestiny");
            }
        } else {
            
            $this->editAccessLevel();
        }
    }

    private function viewEditAccessLevel() {       
        $this->data['sidebarActive'] = "list-access-levels";
        $loadView = new \Core\ConfigView("adms/Views/accessLevels/editAccessLevel", $this->data);
        $loadView->render();
    }

    private function editAccessLevel() {
        if (!empty($this->formData['EditAccessLevel'])) {
            unset($this->formData['EditAccessLevel']);
            $editAccessLevel = new \App\adms\Models\AdmsEditAccessLevel();
            $editAccessLevel->update($this->formData);
            if ($editAccessLevel->getResult()) {
                $urlDestiny = URLADM . "list-access-levels/index";
                header("Location: $urlDestiny");
            } else {
                $this->data['form'] = $this->formData;
                $this->viewEditAccessLevel();
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Nível de acesso não encontrado!</div>";
            $urlDestiny = URLADM . "list-access-levels/index";
            header("Location: $urlDestiny");
        }
    }

}

?>