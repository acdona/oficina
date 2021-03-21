<?php
namespace App\adms\Models\helper;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsValEmailSingle Helper. Responsible for cheking if the email exists in the database.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsValEmailSingle
{

    private string $email;
    private $edit;
    private $id;
    private bool $result;
    private $databaseResult;

    function getResult(): bool {
        return $this->result;
    }

    public function validateEmailSingle($email, $edit = null, $id = null) {
        $this->email = $email;
        $this->edit = $edit;
        $this->id = $id;

        $valEmailSingle = new \App\adms\Models\helper\AdmsRead();
      
        if (($this->edit == true) AND (!empty($this->id))) {
           
            $valEmailSingle->fullRead("SELECT id
                    FROM adms_users
                    WHERE (email =:email OR username =:username) AND id <>:id 
                    LIMIT :limit", "email={$this->email}&username={$this->email}&id={$this->id}&limit=1");
                    
                    
        } else {
          
            $valEmailSingle->fullRead("SELECT id FROM adms_users WHERE email =:email LIMIT :limit", "email={$this->email}&limit=1");
        }

        $this->databaseResult = $valEmailSingle->getReadingResult();
        if (!$this->databaseResult) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Este e-mail já está cadastrado!</div>";
            $this->result = false;
        }
    }

}

?>