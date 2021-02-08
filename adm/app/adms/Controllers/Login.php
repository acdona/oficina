<?php
namespace App\adms\Controllers;

/**
 * Controller Login responsável por 
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
    private $dados;
    private $dadosForm;

    public function access()
    {
        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dadosForm['SendLogin'])) {
            $valLogin= new \App\adms\Models\AdmsLogin();
            $valLogin->login($this->dadosForm);
            if($valLogin->getResultado()){
                $urlDestino = URLADM . "dashboard/index";
                header("Location: $urlDestino");
            }else{
                $this->dados['form'] = $this->dadosForm;
            }   
        }

        //$this->dados = [];

        $carregarView = new \Core\ConfigView("adms/Views/login/access", $this->dados);
        $carregarView->renderizar();
    }
        
   

}

?>