<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe EditTopPagHome responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class EditTopPageHome
{

    private $dados;
    private $dadosForm;

    public function index() {
        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dadosForm['EditTopHome'])) {
            $editTop = new \App\adms\Models\AdmsViewTop();
            if($editTop->editTop($this->dadosForm)){
                $urlDestino = URLADM . "view-pg-home";
                header("Location: $urlDestino");
            }else{
                $this->dados['top'] = $this->dadosForm;
                $this->viewTop();
            }
        }else{
            $this->dadosTop();
            $this->viewTop();
        }  
    }
    
    private function dadosTop() {
        $viewTop = new \App\adms\Models\AdmsViewTop();
        $this->dados['top'] = $viewTop->viewTop();
    }
    
    private function viewTop() {
        $carregarView = new \Core\ConfigView("adms/Views/pgHome/editPgHomeTop", $this->dados);
        $carregarView->renderizar();
    }


}

?>