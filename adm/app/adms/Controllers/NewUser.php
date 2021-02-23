<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe NewUser responsável por 
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

    private $dados;
    private $dadosForm;

    public function index() {
        
        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if(!empty($this->dadosForm['SendNewUser'])){
            unset($this->dadosForm['SendNewUser']);
            $createNewUser = new \App\adms\Models\AdmsNewUser();
            $createNewUser->create($this->dadosForm);
            if($createNewUser->getResultado()){
                $urlDestino = URLADM . "login/index";
                header("Location: $urlDestino");
            }else{
                $this->dados['form'] = $this->dadosForm;
                $this->viewNewUser();
            }            
        }else{
            $this->viewNewUser();
        }   
    }
    
    private function viewNewUser() {
        $carregarView = new \Core\ConfigView("adms/Views/login/newUser", $this->dados);
        $carregarView->renderizar();
    }


}

?>