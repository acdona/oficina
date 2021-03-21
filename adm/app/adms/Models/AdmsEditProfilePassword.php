<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsEditProfilePassword Model. Responsible for editing the user profile password.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsEditProfilePassword
{

    private $databaseResult;
    private bool $result;
    private $dataExitVal;
    private array $data;

    function getDatabaseResult() {
        return $this->databaseResult;
    }

    function getResult() {
        return $this->result;
    }
 
    public function viewProfilePassword()
    {
       $viewProfile = new \App\adms\Models\helper\AdmsRead();
       $viewProfile->fullRead("SELECT id 
                              FROM adms_users 
                              WHERE id=:id 
                              LIMIT :limit ", "id={$_SESSION['user_id']}&limit=1");
        $this->databaseResult = $viewProfile->getReadingResult();
        if($this->databaseResult) {
                $this->result = true;

        } else { 
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Usuário não encontrado!</div>";
            $this->result = false;
        }
    }

    public function update(array $data) {
        $this->data = $data;
   
        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->validateData($this->data);
        if ($valEmptyField->getResult()) {
            $this->valInput();
        } else {
            $this->result = false;
        }
    }
    private function valInput() {
        $valPassword = new \App\adms\Models\helper\AdmsValPassword();
        $valPassword->validatePassword($this->data['password']);

        if ($valPassword->getResult() ) {
            $this->edit();
           
        } else {
            $this->result = false;
        }
    }

    private function edit() {
        $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);
        $this->data['modified'] = date("Y-m-d H:i:s");

        $upUser = new \App\adms\Models\helper\AdmsUpdate();
        $upUser->exeUpdate("adms_users", $this->data, "WHERE id =:id", "id={$_SESSION['user_id']}");

        if ($upUser->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Senha editada com sucesso!</div>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Senha não editada!/div>";
            $this->result = false;
        }
    }

}

?>