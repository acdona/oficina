<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsEditGroupsPages Model. Responsible for editing the groups of pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsEditGroupsPages
{

    private $databaseResult;
    private bool $result;
    private int $id;
    private array $data;
    
    function getDatabaseResult() {
        return $this->databaseResult;
    }

    function getResult(): bool {
        return $this->result;
    }

    public function viewGroupsPages($id) {
        $this->id = (int) $id;
        $viewGroupsPages = new \App\adms\Models\helper\AdmsRead();
        $viewGroupsPages->fullRead("SELECT id, name
                    FROM adms_groups_pgs
                    WHERE id=:id
                    LIMIT :limit", "id={$this->id}&limit=1");
        $this->databaseResult = $viewGroupsPages->getReadingResult();
        if($this->databaseResult){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Grupo de página não encontrado!</div>";
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
        
        $upGroupsPages = new \App\adms\Models\helper\AdmsUpdate();
        $upGroupsPages->exeUpdate("adms_groups_pgs", $this->data, "WHERE id =:id", "id={$this->data['id']}");
        
        if($upGroupsPages->getResult()){
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Grupo de página editado com sucesso!</div>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Grupo de página não editado com sucesso!</div>";
            $this->result = false;
        }
    }

}

?>