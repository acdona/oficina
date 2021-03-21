<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsUpdatePassword Model. Responsible for receiving the password link. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsUpdatePassword
{

    private $databaseResult;
    private bool $result;
    private string $key;
    private array $saveData;
    private array $data;

    function getResult() {
        return $this->result;
    }

    public function validateKey($key) {
        $this->key = $key;

        $viewkeyUpPass = new \App\adms\Models\helper\AdmsRead();
        $viewkeyUpPass->fullRead("SELECT id
                FROM adms_users
                WHERE recover_password =:recover_password
                LIMIT :limit",
                "recover_password={$this->key}&limit=1");

        $this->databaseResult = $viewkeyUpPass->getReadingResult();
        if ($this->databaseResult) {
            $this->result = true;
            return true;
        } else {
            $_SESSION['msg'] =  "<div class='alert alert-danger' role='alert'>Erro: Link inválido, solicite novo link <a href='" . URLADM . "recover-password/index'>clique aqui</a>!</div>";
           
            $this->result = false;
            return false;
        }
    }

    public function editPassword(array $data) {
        $this->data = $data;
        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->validateData($this->data);
        if($valEmptyField->getResult()){            
            $this->valInput();
        }else{
            $this->result = false;
        }
    }
    
    private function valInput() {
        $valPassword= new \App\adms\Models\helper\AdmsValPassword();
        $valPassword->validatePassword($this->data['password']);
        if($valPassword->getResult()){
   
            if($this->validateKey($this->data['key'])){
                $this->updatePassword();
            }else{
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Link inválido, solicite novo link <a href='" . URLADM . "recover-password/index'>clique aqui</a>!</div>";
            $this->result = false;
            }            
        }else{
            $this->result = false;
        }
    }
    
    private function updatePassword() {
        $this->saveData['recover_password'] = null;
        $this->saveData['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);
        $this->saveData['modified'] = date("Y-m-d H:i:s");
        
        $upPassword = new \App\adms\Models\helper\AdmsUpdate();
        $upPassword->exeUpdate("adms_users", $this->saveData, "WHERE id=:id", "id={$this->databaseResult[0]['id']}");
        if($upPassword->getResult()){
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Senha atualizada com sucesso!</div>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Senha não atualizada, tente novamente!<br></div>";
            $this->result = false;            
        }
        
    }

}

?>