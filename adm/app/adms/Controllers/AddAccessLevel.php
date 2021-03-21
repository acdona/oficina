<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * AddAccessLevel Controller. Responsible for adding an access level.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AddAccessLevel
{
    /** @var array $data Receives the data that must be sent to VIEW. */
    private $data;

    /** @var array $formData Receives form data. */
    private $formData;

    public function index() {

        $this->formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if(!empty($this->formData['AddAccessLevel'])){
            unset($this->formData['AddAccessLevel']);
            $createNewAccessLevel = new \App\adms\Models\AdmsAddAccessLevel();
            $createNewAccessLevel->create($this->formData);
            if($createNewAccessLevel->getResult()) {
                $urlDestiny = URLADM . "list-access-levels/index";
                header("Location: $urlDestiny");
            } else {
                $this->data['form'] = $this->formData;
                $this->viewNewAccessLevel();
            }
        } else {
            $this->viewNewAccessLevel();
        }
    }

       private function viewNewAccessLevel() {  
            $this->data['sidebarActive'] = "list-access-levels";
            $loadView = new \Core\ConfigView("adms/Views/accessLevels/addAccessLevel", $this->data);
            $loadView->render();   
       }

}

?>