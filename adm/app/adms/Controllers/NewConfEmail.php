<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * NewConfEmail Controller. Responsible for sending a new email confirmation.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class NewConfEmail
{

    private $data;
    private $formData;

    public function index() {

        $this->formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->formData['NewConfEmail'])) {
            unset($this->formData['NewConfEmail']);
            $newConfEmail= new \App\adms\Models\AdmsNewConfEmail();
            $newConfEmail->newConfEmail($this->formData);
            if($newConfEmail->getResult()){
                $urlDestiny = URLADM . "login/index";
                header("Location: $urlDestiny");
            }else{
                $this->data['form'] = $this->formData;
                $this->viewNewConfEmail();
            }            
        }else{
            $this->viewNewConfEmail();
        }
    }
    
    private function viewNewConfEmail() {
        $loadView = new \Core\ConfigView("adms/Views/login/newConfEmail", $this->data);
        $loadView->renderLogin();
    }


}

?>