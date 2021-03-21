<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsNewConfEmail Model. Responsible for sending a new email confirmation.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsNewConfEmail
{

    private array $data;
    private $databaseResult;
    private bool $result;
    private string $firstName;
    private array $emailData;

    function getResult() {
        return $this->result;
    }

    public function newConfEmail(array $data = null) {
        $this->data = $data;

        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->validateData($this->data);
        if($valEmptyField->getResult()){
            $this->valUser();
        }else{
            $this->result = false;
        }
        
    }

     private function valUser() {
        $newConfEmail = new \App\adms\Models\helper\AdmsRead();
        $newConfEmail->fullRead("SELECT id, name, email, conf_email
                FROM adms_users
                WHERE email =:email
                LIMIT :limit",
                "email={$this->data['email']}&limit=1");

        $this->databaseResult = $newConfEmail->getReadingResult();
        if ($this->databaseResult) {
            if ($this->valConfEmail()) {
                $this->sendEmail();
            } else {
                
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Link não enviado, tente novamente!</div>";
                $this->result = false;
            }
        } else {
            
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: E-mail não cadastrado!</div>";
            $this->result = false;
        } 
    }

    private function valConfEmail() {
        if (empty($this->databaseResult[0]['conf_email']) OR $this->databaseResult[0]['conf_email'] == NULL) {

            $this->saveData['conf_email'] = password_hash(date("Y-m-d H:i:s"), PASSWORD_DEFAULT);
            $this->saveData['modified'] = date("Y-m-d H:i:s");

            $up_conf_email = new \App\adms\Models\helper\AdmsUpdate();
            $up_conf_email->exeUpdate("adms_users", $this->saveData, "WHERE id=:id", "id={$this->databaseResult[0]['id']}");

            if ($up_conf_email->getResult()) {
                $this->databaseResult[0]['conf_email'] = $this->saveData['conf_email'];
                return true;
            } else {
                return false;
            }


            return false;
     
        } else {
            return true;
        }
    }

    private function sendEmail() {
        $sendEmail = new \App\adms\Models\helper\AdmsSendEmail();
        $this->emailHtml();
        $this->emailText();
        $sendEmail->sendEmail($this->emailData, 2);
        if ($sendEmail->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Novo link enviado com sucesso. Acesse a sua caixa de e-mail para confimar o e-mail!</div>";
            
            $this->result = true;
        } else {
            $this->fromEmail = $sendEmail->getFromEmail();
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Link não enviado, tente novamente ou entre em contato com o e-mail {$this->fromEmail}!</div>";
            
            $this->result = false;
        }
    }

    private function emailHtml() {
        $name = explode(" ", $this->databaseResult[0]['name']);
        $this->firstName = $name[0];

        $this->emailData['toEmail'] = $this->databaseResult[0]['email'];
        $this->emailData['toName'] = $this->firstName;
        $this->emailData['subject'] = "Confirmar sua conta";
        $url = URLADM . "conf-email/index?key=" . $this->databaseResult[0]['conf_email'];

        $this->emailData['contentHtml'] = "Prezado(a) {$this->firstName}<br><br>";
        $this->emailData['contentHtml'] .= "Agradecemos a sua solicitação de cadastramento em nosso site!<br><br>";
        $this->emailData['contentHtml'] .= "Para que possamos liberar o seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicanco no link abaixo: <br><br>";
        $this->emailData['contentHtml'] .= "<a href='" . $url . "'>" . $url . "</a><br><br>";
        $this->emailData['contentHtml'] .= "Esta mensagem foi enviada a você pela empresa XXX.<br>Você está recebendo porque está cadastrado no banco de dados da empresa XXX. Nenhum e-mail enviado pela empresa XXX tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.<br><br>";
    }

    private function emailText() {
        $url = URLADM . "conf-email/index?key=" . $this->databaseResult[0]['conf_email'];
        $this->emailData['contentText'] = "Prezado(a) {$this->firstName}\n\n";
        $this->emailData['contentText'] .= "Agradecemos a sua solicitação de cadastramento em nosso site!\n\n";
        $this->emailData['contentText'] .= "Para que possamos liberar o seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicanco no link abaixo ou cole o link no navegador: \n\n";
        $this->emailData['contentText'] .= $url . "\n\n";
        $this->emailData['contentText'] .= "Esta mensagem foi enviada a você pela empresa XXX.\nVocê está recebendo porque está cadastrado no banco de dados da empresa XXX. Nenhum e-mail enviado pela empresa XXX tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.\n\n";
    }


}

?>