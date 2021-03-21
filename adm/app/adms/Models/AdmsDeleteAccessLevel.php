<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsDeleteAccessLevel Model. Responsible for deleting a access level.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsDeleteAccessLevel
{

    private bool $result;
    private int $id;
    private $databaseResult;

    function getResult(): bool {
        return $this->result;
    }
    
    public function deleteAccessLevel($id) {
        $this->id = (int) $id;
        /**Check if the access level exists and if any access level of the user is using the same. */
        if ($this->viewAccessLevel() AND $this->checkAccessLevel()) {
            $deleteAccessLevel = new \App\adms\Models\helper\AdmsDelete();
            $deleteAccessLevel->exeDelete("adms_access_levels", "WHERE id =:id", "id={$this->id}");
            
            if ($deleteAccessLevel->getResult()) {
                $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Nível de acesso apagado com sucesso!</div>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Nível de acesso não apagado!</div>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }

    /**Checks if the access level exists */
    private function viewAccessLevel() {
        $viewAccessLevel = new \App\adms\Models\helper\AdmsRead();
        $viewAccessLevel->fullRead("SELECT id FROM adms_access_levels 
                WHERE id=:id
                AND order_levels >:order_levels
                LIMIT :limit", "id={$this->id}&order_levels=" . $_SESSION['order_levels'] . "&limit=1");

        $this->databaseResult = $viewAccessLevel->getReadingResult();
        
        if ($this->databaseResult) {
            return true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Nível de acesso não encontrado ou sem permissão de acesso!</div>";
            return false;
        }
    }
    /** Checks if any user access level is using the access level to be deleted. */
    private function checkAccessLevel() {
        $checkAccessLevel = new \App\adms\Models\helper\AdmsRead();
        $checkAccessLevel->fullRead("SELECT id FROM adms_users WHERE adms_access_level_id=:adms_access_level_id LIMIT :limit", "adms_access_level_id={$this->id}&limit=1");
     
        if($checkAccessLevel->getReadingResult()){
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: O nível de acesso não pode ser apagado, ele está sendo usada por um usuário!</div>";
            return false;
        }else{
            return true;
        }
    }

}

?>