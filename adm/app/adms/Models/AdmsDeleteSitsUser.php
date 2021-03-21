<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsDeleteSitsUser Model. Responsible for deleting the user's situation. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsDeleteSitsUser
{

    private bool $result;
    private int $id;
    private $databaseResult;

    function getResult(): bool {
        return $this->result;
    }
    
    public function deleteSitsUser($id) {
        $this->id = (int) $id;

        if ($this->viewSitsUsers() AND $this->verfUserCad()) {
            $deleteSitsUser = new \App\adms\Models\helper\AdmsDelete();
            $deleteSitsUser->exeDelete("adms_sits_users", "WHERE id =:id", "id={$this->id}");

            if ($deleteSitsUser->getResult()) {
                $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Situação para usuário apagada com sucesso!</div>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Situação para usuário não apagada com sucesso!</div>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }

    private function viewSitsUsers() {
        $viewSitsUser = new \App\adms\Models\helper\AdmsRead();
        $viewSitsUser->fullRead("SELECT id FROM adms_sits_users
                WHERE id=:id
                LIMIT :limit", "id={$this->id}&limit=1");

        $this->databaseResult = $viewSitsUser->getReadingResult();
        if ($this->databaseResult) {
            return true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Situação para usuário não encontrada!</div>";
            return false;
        }
    }
    
    private function verfUserCad() {
        $viewUserCad = new \App\adms\Models\helper\AdmsRead();
        $viewUserCad->fullRead("SELECT id FROM adms_users WHERE adms_sits_user_id=:adms_sits_user_id LIMIT :limit", "adms_sits_user_id={$this->id}&limit=1");
        if($viewUserCad->getReadingResult()){
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Situação para usuário não pode ser apagada, há usuários cadastrados com essa situação!</div>";
            return false;
        }else{
            return true;
        }
    }

}

?>