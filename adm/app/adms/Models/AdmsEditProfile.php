<?php

namespace App\adms\Models;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsEditProfile Model. Responsible for editing the user profile.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsEditProfile
{
    private $databaseResult;
    private bool $result;
    private $dataExitVal;
    private array $data;
    
    function getDatabaseResult() {
        return $this->databaseResult;
    }

    function getResult(): bool {
        return $this->result;
    }

    public function viewProfile() {
        
        $viewProfile = new \App\adms\Models\helper\AdmsRead();
        $viewProfile->fullRead("SELECT id, name, nickname, email, username
                FROM adms_users
                WHERE id=:id
                LIMIT :limit ", 
                "id={$_SESSION['user_id']}&limit=1");
        $this->databaseResult = $viewProfile->getReadingResult();
        if($this->databaseResult){
            
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Usuário não encontrado!</div>";
            $this->result = false;
        }
    }
    
    public function update(array $data) {
        $this->data = $data;
        
        $this->dataExitVal['nickname'] = $this->data['nickname'];
        unset($this->data['nickname']);
        
        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->validateData($this->data);
        if($valEmptyField->getResult()){            
            $this->valInput();
        }else{
            $this->result = false;
        }
    }
    
    private function valInput() {
        $valEmail = new \App\adms\Models\helper\AdmsValEmail();
        $valEmail->validateEmail($this->data['email']);
        
        $valEmailSingle = new \App\adms\Models\helper\AdmsValEmailSingle();
        $valEmailSingle->validateEmailSingle($this->data['email'], true, $_SESSION['user_id']);
        
        $valUserSingle = new \App\adms\Models\helper\AdmsValUserSingle();
        $valUserSingle->validateUserSingle($this->data['username'], true, $_SESSION['user_id']);
        
        if($valEmail->getResult() AND $valEmailSingle->getResult() AND $valUserSingle->getResult()){
             $this->edit();
        }else{
            $this->result = false;
        }
    }
    
    private function edit() {
        $this->data['nickname'] = $this->dataExitVal['nickname'];
        $this->data['modified'] = date("Y-m-d H:i:s");
        
        $upProfile = new \App\adms\Models\helper\AdmsUpdate();
        $upProfile->exeUpdate("adms_users", $this->data, "WHERE id=:id", "id={$_SESSION['user_id']}");
        
        if($upProfile->getResult()){
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Perfil editado com sucesso!</div>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Perfil não editado!</div>";
            $this->result = false;
        }
    }
           
}
