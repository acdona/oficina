<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsAddPages Model. Responsible for adding the pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsAddPages
{

    private array $data;
    private array $dataExitVal;
    private bool $result;
    private $listRegistryAdd;

    function getResult() {
        return $this->result;
    }

    public function create(array $data = null) {
        $this->data = $data;

        $this->dataExitVal['icon'] = $this->data['icon'];
        $this->dataExitVal['note'] = $this->data['note'];
        unset($this->data['note'], $this->data['icon']);

        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->validateData($this->data);
        if ($valEmptyField->getResult()) {
            $this->add();
        } else {
            $this->result = false;
        }
    }

    private function add() {
        $this->data['icon'] = $this->dataExitVal['icon'];
        $this->data['note'] = $this->dataExitVal['note'];
        $this->data['created'] = date("Y-m-d H:i:s");

        $createPage = new \App\adms\Models\helper\AdmsCreate();
        $createPage->exeCreate("adms_pages", $this->data);

        if ($createPage->getCreateResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Página cadastrada com sucesso!</div>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Página não cadastrada com sucesso. Tente mais tarde!</div>";
            $this->result = false;
        }
    }

    public function listSelect() {
        $list = new \App\adms\Models\helper\AdmsRead();
        $list->fullRead("SELECT id id_sit, name name_sit FROM adms_sits_pgs ORDER BY name ASC");
        $registry['sit_page'] = $list->getReadingResult();

        $list->fullRead("SELECT id id_type, type, name name_type FROM adms_types_pgs ORDER BY name ASC");
        $registry['type_page'] = $list->getReadingResult();
        
        $list->fullRead("SELECT id id_group, name name_group FROM adms_groups_pgs ORDER BY name ASC");
        $registry['group_page'] = $list->getReadingResult();

        $this->listRegistryAdd = ['sit_page' => $registry['sit_page'], 'type_page' => $registry['type_page'], 'group_page' => $registry['group_page']];

        return $this->listRegistryAdd;
    }


}

?>