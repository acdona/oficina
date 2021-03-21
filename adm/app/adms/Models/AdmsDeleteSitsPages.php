<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsDeleteSitsPages Model. Responsible for deleting the situation of the pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsDeleteSitsPages
{

    private bool $result;
    private int $id;
    private $databaseResult;

    function getResult(): bool {
        return $this->result;
    }
    
    public function deleteSitsPages($id) {
        $this->id = (int) $id;

        if ($this->viewSitsPages() AND $this->verfPageAdded()) {
            $deleteSitsPages = new \App\adms\Models\helper\AdmsDelete();
            $deleteSitsPages->exeDelete("adms_sits_pgs", "WHERE id =:id", "id={$this->id}");

            if ($deleteSitsPages->getResult()) {
                $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Situação de página apagada com sucesso!</div>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Situação de página não apagada com sucesso!</div>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }

    private function viewSitsPages() {
        $viewSitsPages = new \App\adms\Models\helper\AdmsRead();
        $viewSitsPages->fullRead("SELECT id FROM adms_sits_pgs
                WHERE id=:id
                LIMIT :limit", "id={$this->id}&limit=1");

        $this->databaseResult = $viewSitsPages->getReadingResult();
        if ($this->databaseResult) {
            return true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Situação de página não encontrada!</div>";
            return false;
        }
    }
    
    private function verfPageAdded() {
        $viewPageAdded = new \App\adms\Models\helper\AdmsRead();
        $viewPageAdded->fullRead("SELECT id FROM adms_pages WHERE adms_sits_pgs_id=:adms_sits_pgs_id LIMIT :limit", "adms_sits_pgs_id={$this->id}&limit=1");
        if($viewPageAdded->getReadingResult()){
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Situação de página não pode ser apagada, há páginas cadastradas com essa situação!</div>";
            return false;
        }else{
            return true;
        }
    }

}

?>