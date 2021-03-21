<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsAddGroupsPages Model. Responsible for adding the groups of pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsAddGroupsPages
{

    private array $data;
    private bool $result;
    private $databaseResult;

    function getResult(): bool {
        return $this->result;
    }

    public function create(array $data = null) {
        $this->data = $data;
        
        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->validateData($this->data);
        if ($valEmptyField->getResult()) {
            $this->add();
        } else {
            $this->result = false;
        }
    }

    private function add() {
        if ($this->viewLastGroupsPages()) {
            $this->data['created'] = date("Y-m-d H:i:s");

            $createGroupPage = new \App\adms\Models\helper\AdmsCreate();
            $createGroupPage->exeCreate("adms_groups_pgs", $this->data);

            if ($createGroupPage->getCreateResult()) {
                $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Grupo de página cadastrado com sucesso!</div>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Grupo de página não cadastrado com sucesso. Tente mais tarde!</div>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }

    private function viewLastGroupsPages() {
        $viewLastGroupsPages = new \App\adms\Models\helper\AdmsRead();
        $viewLastGroupsPages->fullRead("SELECT order_group_pg FROM adms_groups_pgs ORDER BY order_group_pg DESC");
        $this->databaseResult = $viewLastGroupsPages->getReadingResult();
        if ($this->databaseResult) {
            $this->data['order_group_pg'] = $this->databaseResult[0]['order_group_pg'] + 1;
            return true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Grupo de página não cadastrado com sucesso. Tente mais tarde!</div>";
            return false;
        }
    }

}

?>