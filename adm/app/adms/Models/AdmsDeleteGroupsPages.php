<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsDeleteGroupsPages Model. Responsible for deleting the groups of pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsDeleteGroupsPages
{

    private bool $result;
    private int $id;
    private $databaseResult;

    function getResult(): bool {
        return $this->result;
    }

    public function deleteGroupsPages($id) {
        $this->id = (int) $id;
        if ($this->viewGroupsPages() AND $this->verifyAddedPackage()) {
            $deleteGroupsPages = new \App\adms\Models\helper\AdmsDelete();
            $deleteGroupsPages->exeDelete("adms_groups_pgs", "WHERE id =:id", "id={$this->id}");
            if ($deleteGroupsPages->getResult()) {
                $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Grupo de página apagado com sucesso!</div>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Grupo de página não apagado com sucesso!</div>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }

    private function viewGroupsPages() {
        $viewGroupsPages = new \App\adms\Models\helper\AdmsRead();
        $viewGroupsPages->fullRead("SELECT id FROM adms_groups_pgs
                    WHERE id=:id
                    LIMIT :limit", "id={$this->id}&limit=1");
        $this->databaseResult = $viewGroupsPages->getReadingResult();
        if ($this->databaseResult) {
            return true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Grupo de página não encontrado!</div>";
            return false;
        }
    }

    private function verifyAddedPackage() {
        $verifyAddedPackage = new \App\adms\Models\helper\AdmsRead();
        $verifyAddedPackage->fullRead("SELECT id FROM adms_pages WHERE adms_groups_pgs_id=:adms_groups_pgs_id LIMIT :limit", "adms_groups_pgs_id={$this->id}&limit=1");
        if ($verifyAddedPackage->getReadingResult()) {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: O grupo de página não pode ser apagado, há páginas cadastradas com esse grupo!</div>";
            return false;
        } else {
            return true;
        }
    }

}

?>