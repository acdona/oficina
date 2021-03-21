<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsViewProfile Model. Responsible for viewing the user's profile.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsViewProfile
{

    private $databaseResult;
    private bool $result;


    function getResult(): bool {
        return $this->result;
    }
    function getDatabaseResult() {
        return $this->databaseResult;
    }
 
    public function viewProfile() {

        $viewUser = new \App\adms\Models\helper\AdmsRead();
        $viewUser->fullRead("SELECT id, name, nickname, email, username, image 
                             FROM adms_users 
                             WHERE id=:id 
                             LIMIT :limit", "id={$_SESSION['user_id']}&limit=1");

        $this->databaseResult = $viewUser->getReadingResult();
        if($this->databaseResult) {
            $this->result = true;
        }else {
            
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Usuário não encontrado!</div>";
            $this->result = false;
        }
    }
 

}

?>