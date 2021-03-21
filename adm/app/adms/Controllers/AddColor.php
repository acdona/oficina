<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * AddColor Controller responsible for adding a color.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AddColor
{
    /** @var array $data Receives the data that must be sent to VIEW. */
    private $data;

    /** @var array $formData Receives form data. */
    private $formData;

    public function index() {

        $this->formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if(!empty($this->formData['AddColor'])){
            unset($this->formData['AddColor']);
            $createNewColor = new \App\adms\Models\AdmsAddColor();
            $createNewColor->create($this->formData);
            if($createNewColor->getResult()) {
                $urlRedirect = URLADM . "list-colors/index";
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->formData;
                $this->viewNewColor();
            }
        } else {
            $this->viewNewColor();
        }
    }

       private function viewNewColor() {  
            $this->data['sidebarActive'] = "list-colors";
            $carregarView = new \Core\ConfigView("adms/Views/colors/addColor", $this->data);
            $carregarView->render();   
       }

}

?>