<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}


/**
 * AdmsEditConfEmail Model. Responsible for editing email confirmation.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsEditConfEmail
{

    private $databaseResult;
    private bool $result;
    private int $id;
    private string $key;
    private array $saveData;

    function getResult(): bool {
        return $this->result;
    }

    function getDatabaseResult() {
        return $this->databaseResult;
    }

    public function viewConfEmail($id) {
        $this->id = $id;
       
        $viewConfEmail  = new \App\adms\Models\helper\AdmsRead();
        
        $viewConfEmail->fullRead("SELECT id , title, name, email, host, username, smtpsecure, port
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

    public function update(array $data) {
        
        $this->data = $data;

        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->validateData($this->data);

        if ($valEmptyField->getResult()){
           
            $this->edit();
        } else {
            $this->result = false;
           
        }
           
    }

    private function edit() {
        
        $this->data['modified'] = date("Y-m-d H:i:s");

        $upConfEmail = new \App\adms\Models\helper\AdmsUpdate();
        $upConfEmail->exeUpdate("adms_confs_emails", $this->data, "WHERE id =:id", "id={$this->data['id']}");

        if ($upConfEmail->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>E-mail editado com sucesso!</div>";
            
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: E-mail não editado!</div>";
            
            $this->result = false;
        }
    }

}

?>