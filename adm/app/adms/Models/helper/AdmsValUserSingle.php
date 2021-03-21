<?php

namespace App\adms\Models\helper;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsValUserSingle Helper. Responsible for validating the single user.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsValUserSingle
{

    private string $userName;
    private $edit;
    private $id;
    private bool $result;
    private $databaseResult;

    function getResult(): bool {
        return $this->result;
    }

    public function validateUserSingle($username, $edit = null, $id = null) {
        $this->userName = $username;
        $this->edit = $edit;
        $this->id = $id;

        $valUserSingle = new \App\adms\Models\helper\AdmsRead();
        if (($this->edit == true) AND (!empty($this->id))) {
            $valUserSingle->fullRead("SELECT id
                    FROM adms_users
                    WHERE (username =:username OR email =:email) AND
                    id <>:id
                    LIMIT :limit",
                    "username={$this->userName}&email={$this->userName}&id={$this->id}&limit=1");
        } else {
            $valUserSingle->fullRead("SELECT id FROM adms_users WHERE username =:username LIMIT :limit", "username={$this->userName}&limit=1");
        }

        $this->databaseResult = $valUserSingle->getReadingResult();
        if (!$this->databaseResult) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Este usuário já está cadastrado!</div>";
            $this->result = false;
        }
    }

}
