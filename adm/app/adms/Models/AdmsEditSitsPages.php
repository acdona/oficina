<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsEditSitsPages Model. Responsible for editin the situations of the pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsEditSitsPages
{

    private $databaseResult;
    private bool $result;
    private int $id;
    private array $data;
    private $listRegistryEdit;

    function getResult(): bool {
        return $this->result;
    }

    function getDatabaseResult() {
        return $this->databaseResult;
    }

    public function viewSitsPages($id) {
        $this->id = (int) $id;
        $viewSitsPages = new \App\adms\Models\helper\AdmsRead();
        $viewSitsPages->fullRead("SELECT id, name, adms_color_id
                FROM adms_sits_pgs
                WHERE id=:id
                LIMIT :limit", "id={$this->id}&limit=1");

        $this->databaseResult = $viewSitsPages->getReadingResult();
        if ($this->databaseResult) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Situação de página não encontrada!</div>";
            $this->result = false;
        }
    }

    public function update(array $data) {
        $this->data = $data;

        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->validateData($this->data);
        if ($valEmptyField->getResult()) {
            $this->edit();
        } else {
            $this->result = false;
        }
    }

    private function edit() {
        $this->data['modified'] = date("Y-m-d H:i:s");

        $upSitPages = new \App\adms\Models\helper\AdmsUpdate();
        $upSitPages->exeUpdate("adms_sits_pgs", $this->data, "WHERE id =:id", "id={$this->data['id']}");

        if ($upSitPages->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Situação de página editada com sucesso!</div>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Situação de página não editada!</div>";
            $this->result = false;
        }
    }
    
    public function listSelect() {
        $list = new \App\adms\Models\helper\AdmsRead();
        $list->fullRead("SELECT id id_cor, name name_cor FROM adms_colors ORDER BY name ASC");
        $registry['cor'] = $list->getReadingResult();
        
        $this->listRegistryEdit = ['cor' => $registry['cor']];
        
        return $this->listRegistryEdit;
    }

}

?>