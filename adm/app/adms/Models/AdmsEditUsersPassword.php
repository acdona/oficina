<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}


/**
 * AdmsEditUsersPassword Model. Responsible for editing the user's password.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsEditUsersPassword
{

    private $databaseResult;
    private bool $result;
    private int $id;
    private array $data;

    function getResult(): bool {
        return $this->result;
    }

    function getDatabaseResult() {
        return $this->databaseResult;
    }

    public function viewUser($id) {
        $this->id = (int) $id;
        $viewUser = new \App\adms\Models\helper\AdmsRead();
        $viewUser->fullRead("SELECT usu.id 

                FROM adms_users usu
                INNER JOIN adms_access_levels As lev ON lev.id=usu.adms_access_level_id
                WHERE usu.id=:id AND lev.order_levels >:order_levels
                LIMIT :limit", "id={$this->id}&order_levels=".$_SESSION['order_levels']."&limit=1");

        $this->databaseResult = $viewUser->getReadingResult();
        if ($this->databaseResult) {
            $this->result = true;
        } else {
            
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Usuário não encontrado!</div>";
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
        $upUser->exeUpdate("adms_users", $this->data, "WHERE id =:id", "id={$this->data['id']}");

        if ($upUser->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Senha do usuário cadastrada com sucesso!</div>";;
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Senha do usuário não cadastrada!!</div>";
            $this->result = false;
        }
    }

}

?>