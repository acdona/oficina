<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * NewUser controller Responsible for registering new user.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class NewUser
{
    /** @var array $data Receives the data that must be sent to VIEW*/
    private $data;
    /** @var array $formData Receives the data send by the form. */
    private $formData;

    /**
     * Index method responsible for starting a new user registration.
     *  
     * @return void
     */
    public function index() {
        
        $this->formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if(!empty($this->formData['SendNewUser'])){
            unset($this->formData['SendNewUser']);
            $createNewUser = new \App\adms\Models\AdmsNewUser();
            $createNewUser->create($this->formData);
            if($createNewUser->getResult()){
                $urlDestiny = URLADM . "login/index";
                header("Location: $urlDestiny");
            }else{
                $this->data['form'] = $this->formData;
                $this->viewNewUser();
            }            
        }else{
            $this->viewNewUser();
        }   
    }
    
    private function viewNewUser() {
        $loadView = new \Core\ConfigView("adms/Views/login/newUser", $this->data);
        $loadView->renderLogin();
    }


}

?>