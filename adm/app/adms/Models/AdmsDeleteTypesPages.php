<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsDeleteTypesPages Model. Responsible for deleting the types of pages.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsDeleteTypesPages
{

    private bool $result;
    private int $id;
    private $databaseResult;

    function getResult(): bool {
        return $this->result;
    }

    public function deleteTypesPages($id) {
        $this->id = (int) $id;
        if ($this->viewTypesPages() AND $this->verifyAddedPackage()) {
            $deleteTypesPages = new \App\adms\Models\helper\AdmsDelete();
            $deleteTypesPages->exeDelete("adms_types_pgs", "WHERE id =:id", "id={$this->id}");
            if ($deleteTypesPages->getResult()) {
                $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Tipo de página apagado com sucesso!</div>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Tipo de página não apagado com sucesso!</div>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }

    private function viewTypesPages() {
        $viewTypesPages = new \App\adms\Models\helper\AdmsRead();
        $viewTypesPages->fullRead("SELECT id FROM adms_types_pgs
                    WHERE id=:id
                    LIMIT :limit", "id={$this->id}&limit=1");
        $this->databaseResult = $viewTypesPages->getReadingResult();
        if ($this->databaseResult) {
            return true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Tipo de página não encontrado!</div>";
            return false;
        }
    }

    private function verifyAddedPackage() {
        $verifyAddedPackage = new \App\adms\Models\helper\AdmsRead();
        $verifyAddedPackage->fullRead("SELECT id FROM adms_pages WHERE adms_types_pgs_id=:adms_types_pgs_id LIMIT :limit", "adms_types_pgs_id={$this->id}&limit=1");
        if ($verifyAddedPackage->getReadingResult()) {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: O tipo de página não pode ser apagado, há páginas cadastradas nesse pacote!</div>";
            return false;
        } else {
            return true;
        }
    }

}

?>