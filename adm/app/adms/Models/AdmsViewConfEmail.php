<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsViewConfEmail Models. Responsible for viewing the email confirmation.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsViewConfEmail
{

    private $databaseResult;
    private bool $result;
    private int $id;

    function getResult(): bool {
        return $this->result;
    }
    
    function getDatabaseResult() {
        return $this->databaseResult;
    }

    public function viewConfEmail($id) {
        $this->id = (int) $id;
        $viewConfEmail = new \App\adms\Models\helper\AdmsRead();
        $viewConfEmail->fullRead("SELECT id, title, name, email, host, username, smtpsecure, port
                FROM adms_confs_emails 
                WHERE id=:id
                LIMIT :limit", "id={$this->id}&limit=1");
                
        $this->databaseResult = $viewConfEmail->getReadingResult();
        if($this->databaseResult){
            $this->result = true;
        }else{
            
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: E-mail não encontrado!</div>";
            $this->result = false;
        }
    }


}

?>