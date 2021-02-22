<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}


/**
 * Classe EditTopImgPgHome responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class EditTopImgPgHome
{

    private $dados;
    private $dadosForm;

    public function index() {
        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dadosForm['EditTopImgHome'])) {
            $this->dadosForm['imagem_nova']= ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);        
            $editImgTop = new \App\adms\Models\AdmsViewImgTop;
            if($editImgTop->editImgTop($this->dadosForm)){
                $urlDestino = URLADM . "view-pg-home";
                header("Location: $urlDestino");
            }else{
                $this->dadosTop();
                $this->viewTop();
            }
            $this->dadosTop();
            $this->viewTop();
        }else{
            $this->dadosTop();
            $this->viewTop();
        } 
    }
    
    private function dadosTop() {
        $viewTop = new \App\adms\Models\AdmsViewImgTop;
        $this->dados['top'] = $viewTop->viewImgTop();
    }
    
    private function viewTop() {
        $carregarView = new \Core\ConfigView("adms/Views/pgHome/editPgHomeImgTop", $this->dados);
        $carregarView->renderizar();
    }


}

?>