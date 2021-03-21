<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsDeletePages . Responsible for deleting the pages.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsDeletePages
{

    private bool $result;
    private int $id;
    private $databaseResult;

    function getResult(): bool {
        return $this->result;
    }

    public function deletePages($id) {
        $this->id = (int) $id;

        if ($this->viewPages()) {
            $deletePage = new \App\adms\Models\helper\AdmsDelete();
            $deletePage->exeDelete("adms_pages", "WHERE id =:id", "id={$this->id}");

            if ($deletePage->getResult()) {
                $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Página apagada com sucesso!</div>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Página não foi apagada!</div>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }

    private function viewPages() {
        $viewPage = new \App\adms\Models\helper\AdmsRead();
        $viewPage->fullRead("SELECT id FROM adms_pages WHERE id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->databaseResult = $viewPage->getReadingResult();
        if ($this->databaseResult) {
            return true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Página não encontrada!</div>";
            return false;
        }
    }

}

?>