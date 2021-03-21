<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * EditColor Controller responsible for editing a color.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class EditColor
{
    /** @var array $data Receives the data that must be sent to VIEW. */
    private array $data=[];

    /** @var array $formData Receives the form data. */
    private $formData;

    /** @var int $id Receives an integer referring to the color ID. */
    private $id;

    /** Index function that receives the color ID. */
    public function index($id) {
        $this->id = (int) $id;

        $this->formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        /** If the id is not empty and the form data is empty */
        if (!empty($this->id) AND (empty($this->formData['EditColor']))) {
            /** Instantiate the model. */
            $viewColor = new \App\adms\Models\AdmsEditColor();
            /** Loads the model's viewColor. */
            $viewColor->viewColor($this->id);
            if ($viewColor->getResult()) {
                $this->data['form'] = $viewColor->getDatabaseResult();
                $this->viewEditColor();
            } else {
                $urlDestiny = URLADM . "list-colors/index";
                header("Location: $urlDestiny");
            }
        } else {
            $this->editColor();
        }
    }

    private function viewEditColor() {       
        $this->data['sidebarActive'] = "list-colors";
        $loadView = new \Core\ConfigView("adms/Views/colors/editColor", $this->data);
        $loadView->render();
    }

    private function editColor() {
        if (!empty($this->formData['EditColor'])) {
            unset($this->formData['EditColor']);
            $editColor = new \App\adms\Models\AdmsEditColor();
            $editColor->update($this->formData);
            if ($editColor->getResult()) {
                $urlDestiny = URLADM . "list-colors/index";
                header("Location: $urlDestiny");
            } else {
                $this->data['form'] = $this->formData;
                $this->viewEditColor();
            }
        } else {
            
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Cor não encontrada!</div>";
            $urlDestiny = URLADM . "list-colors/index";
            header("Location: $urlDestiny");
        }
    }

}

?>