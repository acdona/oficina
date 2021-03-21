<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsEditPages Model. Responsible for editing the pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsEditPages
{

    private $databaseResult;
    private bool $result;
    private int $id;
    private array $data;
    private array $dataExitVal;
    private $listRegistryEdit;

    function getResult(): bool {
        return $this->result;
    }

    function getDatabaseResult() {
        return $this->databaseResult;
    }

    public function viewPage($id) {
        $this->id = (int) $id;
        $viewPage = new \App\adms\Models\helper\AdmsRead();
        $viewPage->fullRead("SELECT pg.id, pg.controller, pg.method, pg.menu_controller, pg.menu_method, pg.page_name, pg.public, pg.icon, pg.note, pg.adms_sits_pgs_id, pg.adms_types_pgs_id, pg.adms_groups_pgs_id,
                tpg.type type_tpg, tpg.name name_tpg,
                sit.name name_sit, 
                clr.color name_color
                FROM adms_pages pg
                LEFT JOIN adms_types_pgs AS tpg ON tpg.id=pg.adms_types_pgs_id
                LEFT JOIN adms_sits_pgs AS sit ON sit.id=pg.adms_sits_pgs_id
                INNER JOIN adms_colors AS clr ON clr.id=sit.adms_color_id
                WHERE pg.id=:id
                LIMIT :limit", "id={$this->id}&limit=1");

        $this->databaseResult = $viewPage->getReadingResult();
        if ($this->databaseResult) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Página não encontrada!</div>";
            $this->result = false;
        }
    }

    public function update(array $data) {
        $this->data = $data;

        $this->dataExitVal['icon'] = $this->data['icon'];
        $this->dataExitVal['note'] = $this->data['note'];
        unset($this->data['icon'], $this->data['note']);

        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->validateData($this->data);
        if ($valEmptyField->getResult()) {
            $this->edit();
        } else {
            $this->result = false;
        }
    }    

    private function edit() {
        $this->data['icon'] = $this->dataExitVal['icon'];
        $this->data['note'] = $this->dataExitVal['note'];
        $this->data['modified'] = date("Y-m-d H:i:s");

        $upPage = new \App\adms\Models\helper\AdmsUpdate();
        $upPage->exeUpdate("adms_pages", $this->data, "WHERE id =:id", "id={$this->data['id']}");

        if ($upPage->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Página editada com sucesso!</div>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Página não editada com sucesso!</div>";
            $this->result = false;
        }
    }
    
    public function listSelect() {
        $list = new \App\adms\Models\helper\AdmsRead();
        $list->fullRead("SELECT id id_sit, name name_sit FROM adms_sits_pgs ORDER BY name ASC");
        $registry['sit'] = $list->getReadingResult();

        $list->fullRead("SELECT id id_type, type, name name_type FROM adms_types_pgs ORDER BY name ASC");
        $registry['type'] = $list->getReadingResult();
        
        $list->fullRead("SELECT id id_group, name name_group FROM adms_groups_pgs ORDER BY name ASC");
        $registry['group'] = $list->getReadingResult();

        $this->listRegistryEdit = ['sit' => $registry['sit'], 'type' => $registry['type'], 'group' => $registry['group']];

        return $this->listRegistryEdit;
    }

}

?>