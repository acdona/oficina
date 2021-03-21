<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsConfEmail Model. Responsible for setting up email.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsConfEmail
{

    private $databaseResult;
    private bool $result;
    private string $key;
    private array $saveData;

    function getResult(): bool {
        return $this->result;
    }

    public function confEmail($key) {
        $this->key = $key;
        $viewKeyConfEmail  = new \App\adms\Models\helper\AdmsRead();
        
        $viewKeyConfEmail->fullRead("SELECT id 
                            FROM adms_users 
                            WHERE conf_email =:conf_email 
                            LIMIT :limit", 
                            "conf_email={$this->key}&limit=1");


        $this->databaseResult = $viewKeyConfEmail->getReadingResult();
        
        if($this->databaseResult){
           
            $this->updateSitUser();
        }else{
            
            
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Link inválido!</div>";
            $this->result = false;
        }    
    }

    private function updateSitUser() {

            $this->saveData['conf_email']=null;
            $this->saveData['adms_sits_user_id'] = 1;
            $this->saveData['modified'] = date("Y-m-d H:i:s");

            $up_conf_email = new \App\adms\Models\helper\AdmsUpdate();
            $up_conf_email->exeUpdate("adms_users", $this->saveData, "WHERE id=:id", "id={$this->databaseResult[0]['id']}");

            if($up_conf_email->getResult()) {
               
                $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>E-mail ativado com sucesso!</div>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Link inválido!</div>";
                $this->result = false;
            }
    }
 

}

?>