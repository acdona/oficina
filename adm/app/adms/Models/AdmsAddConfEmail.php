<?php

namespace App\adms\Models;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsAddConfEmail Model. Responsible for adding email configuration.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsAddConfEmail
{

    private array $data;
    private bool $result;

    function getResult() {
        return $this->result;
    }

    public function create(array $data = null) {
        $this->data = $data;
        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->validateData($this->data);
        if ($valEmptyField->getResult()) {
            $this->add();
        } else {
            $this->result = false;
        }
    }

    private function add() {
        $this->data['created'] = date("Y-m-d H:i:s");
        
        $createConfEmail = new \App\adms\Models\helper\AdmsCreate();
        $createConfEmail->exeCreate("adms_confs_emails", $this->data);

        if ($createConfEmail->getCreateResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>E-mail cadastrado com sucesso!</div>";
            
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>E-mail não cadastrado!</div>";
            $this->result = false;
        }
    }

}
