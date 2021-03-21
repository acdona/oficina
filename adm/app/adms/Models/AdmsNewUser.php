<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsNewUser Model. Responsible for handling new user registration data.  
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsNewUser
{
    private array $data;
    private bool $result;
    private string $fromEmail;
    private string $firstName;
    private array $emailData;
    private $databaseResult;

    function getResult() {
        return $this->result;
    }

    function getDatabaseResult() {
        return $this->databaseResult;
    }

    public function create(array $data = null) {
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
        
        $valEmail = new \App\adms\Models\helper\AdmsValEmail();
        $valEmail->validateEmail($this->data['email']);
             
        $valEmailSingle = new \App\adms\Models\helper\AdmsValEmailSingle();
        $valEmailSingle->validateEmailSingle($this->data['email']);

        $valPassword = new \App\adms\Models\helper\AdmsValPassword();
        $valPassword->validatePassword($this->data['password']);
        
        $valUserSingleLogin = new \App\adms\Models\helper\AdmsValUserSingleLogin();
        $valUserSingleLogin->validateUserSingleLogin($this->data['email']);
       
        if($valEmail->getResult() AND $valEmailSingle->getResult() AND $valPassword->getResult() AND $valUserSingleLogin->getResult()){
      
            $this->add();
            
        }else{
            
            $this->result = false;
        }
    }

    private function add() {
        if ($this->accessLevel()) {
        
            $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);
            $this->data['username'] = $this->data['email'];
            $this->data['conf_email'] = password_hash($this->data['password'] . date("Y-m-d H:i:s"), PASSWORD_DEFAULT);
            $this->data['created'] = date("Y-m-d H:i:s");
        
            $createUser = new \App\adms\Models\helper\AdmsCreate();
            $createUser->exeCreate("adms_users", $this->data);
            
            if ($createUser->getCreateResult()) {
                
                $this->sendEmail();

            } else {
                $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Usuário não cadastrado!</div>";
                $this->result = false;
            }
       } else {
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Usuário não cadastrado!</div>";
            $this->result = false;
       }
    }

    private function accessLevel(){
        $accessLevel = new \App\adms\Models\helper\AdmsRead();
        $accessLevel->fullRead("SELECT adms_access_level_id FROM adms_levels_forms LIMIT :limit", "limit=1");
        $this->databaseResult = $accessLevel->getReadingResult();

        if($this->databaseResult){
            $this->data['adms_access_level_id'] = $this->databaseResult[0]['adms_access_level_id'];
            return true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Usuário não cadastrado!</div>";
            return false;
        }
        
     

    }

    private function sendEmail() {
        $sendEmail = new \App\adms\Models\helper\AdmsSendEmail();
        $this->emailHtml();
        $this->emailText();
        $sendEmail->sendEmail($this->emailData, 4);
        if ($sendEmail->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Usuário cadastrado com sucesso. Acesse a sua caixa de e-mail para confimar o e-mail!</div>";
            
            $this->result = true;
        } else {
            $this->fromEmail = $sendEmail->getFromEmail();
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Usuário cadastrado com sucesso. Houve erro ao enviar o e-mail de confirmação, entre em contado com " . $this->fromEmail . " para mais informações!</div>";

            $this->result = true;
        }
    }

    private function emailHtml() {
        $name = explode(" ", $this->data['name']);
        $this->firstName = $name[0];

        $this->emailData['toEmail'] = $this->data['email'];
        $this->emailData['toName'] = $this->firstName;
        $this->emailData['subject'] = "Confirmar sua conta";
        $url = URLADM . "conf-email/index?key=" . $this->data['conf_email'];

        $this->emailData['contentHtml'] = "Falta só mais um passo...<br><br>";
        $this->emailData['contentHtml'] .= "Oi, {$this->firstName}.<br><br>";
        $this->emailData['contentHtml'] .= "Só falta mais um passo para você acessar o conteúdo completo da empresa XXX.<br><br>";
        $this->emailData['contentHtml'] .= "Clique abaixo para confirmar seu e-mail.<br><br>";
        $this->emailData['contentHtml'] .= "<a href='" . $url . "'>" . $url . "</a><br><br>";
        $this->emailData['contentHtml'] .= "Esta mensagem foi enviada a você pela empresa XXX. <br>Você está recebendo porque está cadastrado no banco de dados da empresa XXX. Nenhum e-mail enviado pela empresa XXX tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.<br><br>";
    }

    private function emailText() {     
        $url = URLADM . "conf-email/index?key=" . $this->data['conf_email'];   
        $this->emailData['contentText'] = "Prezado(a) {$this->firstName}\n\n";
        $this->emailData['contentText'] .= "Agradecemos a sua solicitação de cadastramento em nosso site!\n\n";
        $this->emailData['contentText'] .= "Para que possamos liberar o seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicanco no link abaixo: \n\n";
        $this->emailData['contentText'] .= $url . "\n\n";
        $this->emailData['contentText'] .= "Esta mensagem foi enviada a você pela empresa XXX.\nVocê está recebendo porque está cadastrado no banco de dados da empresa XXX. Nenhum e-mail enviado pela empresa XXX tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.\n\n";        
    }

}

?>