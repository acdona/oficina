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
        if (!empty($this->dadosForm['EditTopoHome'])) {
            $editTopo = new \App\adms\Models\AdmsViewTop();
            if($editTopo->editTopo($this->dadosForm)){
                $urlDestino = URLADM . "view-pg-home";
                header("Location: $urlDestino");
            }else{
                $this->dados['topo'] = $this->dadosForm;
                $this->viewTopo();
            }
        }else{
            $this->dadosTopo();
            $this->viewTopo();
        }  
    }
    
    private function dadosTopo() {
        $viewTopo = new \App\adms\Models\AdmsViewTop();
        $this->dados['topo'] = $viewTopo->viewTopo();
    }
    
    private function viewTopo() {
        $carregarView = new \Core\ConfigView("adms/Views/pgHome/editPgHomeTop", $this->dados);
        $carregarView->renderizar();
    }


}

?>