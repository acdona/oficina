<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Login Controller Responsible for loggin user.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class Login
{
    /** @var array $data Receives the data that must be sent to VIEW. */
    private array $data;
    /** @var array $formData Receives the data send by the form. */
    private array $formData;

    public function index() {
    
        if(!is_null(filter_input_array(INPUT_POST, FILTER_DEFAULT))){
            $this->formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            } else {
            $formData=[];
            }
        if (!empty($this->formData['SendLogin'])) {
            
            $valLogin= new \App\adms\Models\AdmsLogin();
            $valLogin->login($this->formData);
            
            if($valLogin->getResult()) {        
              
                $urlRedirect = URLADM . "dashboard/index";
                header("Location: $urlRedirect");

            }else{
                $this->data['form'] = $this->formData;
            }            
        }
        
       $this->data = [];

        $loadView = new \Core\ConfigView("adms/Views/login/access", $this->data);
        
        $loadView->renderLogin();
    }
}

?>