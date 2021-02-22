<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe EditServPgHome responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class EditServPgHome
{

    private $dados;
    private $dadosForm;

    public function index() {
        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dadosForm['EditServHome'])) {
            $editServ = new \App\adms\Models\AdmsViewServ();
            if($editServ->editServ($this->dadosForm)){
                $urlDestino = URLADM . "view-pg-home";
                header("Location: $urlDestino");
            }else{
                $this->dados['serv'] = $this->dadosForm;
                $this->viewServ();
            }
        }else{
            $this->dadosServ();
            $this->viewServ();
        }  
    }
    
    private function dadosServ() {
        $viewServ = new \App\adms\Models\AdmsViewServ();
        $this->dados['serv'] = $viewServ->viewServ();
    }
    
    private function viewServ() {
        $carregarView = new \Core\ConfigView("adms/Views/pgHome/editPgHomeServ", $this->dados);
        $carregarView->renderizar();
    }

}

?>