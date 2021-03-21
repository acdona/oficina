<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsEditTypesPages Model. Responsible for editing the types of the page. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsEditTypesPages
{

    private $databaseResult;
    private bool $result;
    private int $id;
    private array $data;
    private array $dataExitVal;
    
    function getDatabaseResult() {
        return $this->databaseResult;
    }

    function getResult(): bool {
        return $this->result;
    }

    public function viewTypesPages($id) {
        $this->id = (int) $id;
        $viewTypesPages = new \App\adms\Models\helper\AdmsRead();
        $viewTypesPages->fullRead("SELECT id, type, name, note
                    FROM adms_types_pgs
                    WHERE id=:id
                    LIMIT :limit", "id={$this->id}&limit=1");
        $this->databaseResult = $viewTypesPages->getReadingResult();
        if($this->databaseResult){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Tipo de página não encontrado!</div>";
            $this->result = false;
        }
    }
    
    public function update(array $data) {
        $this->data = $data;
        
        $this->dataExitVal['note'] = $this->data['note'];
        unset($this->data['note']);
        
        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->validateData($this->data);
        if ($valEmptyField->getResult()) {
            $this->edit();
        } else {
            $this->result = false;
        }
    }
    
    private function edit() {
        $this->data['note'] = $this->dataExitVal['note'];
        $this->data['modified'] = date("Y-m-d H:i:s");
        
        $upTypesPages = new \App\adms\Models\helper\AdmsUpdate();
        $upTypesPages->exeUpdate("adms_types_pgs", $this->data, "WHERE id =:id", "id={$this->data['id']}");
        
        if($upTypesPages->getResult()){
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Tipo de página editado com sucesso!</div>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Tipo de página não editado com sucesso!</div>";
            $this->result = false;
        }
    }

}

?>