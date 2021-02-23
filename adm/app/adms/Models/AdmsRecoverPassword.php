<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe AdmsRecoverPassword responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsRecoverPassword
{

    private array $dados;
    private $resultadoBd;
    private bool $resultado;
    private string $firstName;
    private array $emailData;
    private array $saveData;

    function getResultado() {
        return $this->resultado;
    }

    public function recoverPassword(array $dados = null) {
        $this->dados = $dados;

        $valCampoVazio = new \App\adms\Models\helper\AdmsValCampoVazio();
        $valCampoVazio->validarDados($this->dados);
        if($valCampoVazio->getResultado()){
            $this->valUser();
        }else{
            $this->resultado = false;
        }
        
    }

     private function valUser() {
        $newRecoverPass = new \App\adms\Models\helper\AdmsRead();
        $newRecoverPass->fullRead("SELECT id, name, email, recover_password
                FROM adms_users
                WHERE email =:email
                LIMIT :limit",
                "email={$this->dados['email']}&limit=1");

        $this->resultadoBd = $newRecoverPass->getResult();
        if ($this->resultadoBd) {
            if ($this->valKeyRecoverPass()) {
                $this->sendEmail();
            } else {
                $_SESSION['msg'] = "Erro: Link não enviado, tente novamente!<br>";
                $this->resultado = false;
            }
        } else {
            $_SESSION['msg'] = "Erro: E-mail não cadastrado!<br>";
            $this->resultado = false;
        } 
    }

    private function valKeyRecoverPass() {
        if (empty($this->resultadoBd[0]['recover_password']) OR $this->resultadoBd[0]['recover_password'] == NULL) {

            $this->saveData['recover_password'] = password_hash(date("Y-m-d H:i:s"), PASSWORD_DEFAULT);
            $this->saveData['modified'] = date("Y-m-d H:i:s");

            $up_recover_pass = new \App\adms\Models\helper\AdmsUpdate();
            $up_recover_pass->exeUpdate("adms_users", $this->saveData, "WHERE id=:id", "id={$this->resultadoBd[0]['id']}");

            if ($up_recover_pass->getResult()) {
                $this->resultadoBd[0]['recover_password'] = $this->saveData['recover_password'];
                return true;
            } else {
                return false;
            }     
        } else {
            return true;
        }
    }

    private function sendEmail() {
        $sendEmail = new \App\adms\Models\helper\AdmsSendEmail();
        $this->emailHtml();
        $this->emailText();
        $sendEmail->sendEmail($this->emailData, 2);
        if ($sendEmail->getResultado()) {
            $_SESSION['msg'] = "Enviado e-mail com instruções para recuperar a senha. Acesse a sua caixa de e-mail para recuperar a senha!";
            $this->resultado = true;
        } else {
            $this->fromEmail = $sendEmail->getFromEmail();
            $_SESSION['msg'] = "Erro: E-mail com as instruções para recuperar a senha não enviado, tente novamente ou entre em contato com o e-mail {$this->fromEmail}!";
            $this->resultado = false;
        }
    }

    private function emailHtml() {
        $name = explode(" ", $this->resultadoBd[0]['name']);
        $this->firstName = $name[0];

        $this->emailData['toEmail'] = $this->resultadoBd[0]['email'];
        $this->emailData['toName'] = $this->firstName;
        $this->emailData['subject'] = "Recuperar senha";
        $url = URLADM . "update-password/index?chave=" . $this->resultadoBd[0]['recover_password'];

        $this->emailData['contentHtml'] = "Prezado(a) {$this->firstName}<br><br>";
        $this->emailData['contentHtml'] .= "Você solicitou uma alteração de senha!<br><br>";
        $this->emailData['contentHtml'] .= "Para continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço abaixo no seu navegador: <br><br>";
        $this->emailData['contentHtml'] .= "<a href='" . $url . "'>" . $url . "</a><br><br>";
        $this->emailData['contentHtml'] .= "Se você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma, até que você ative esse código.<br><br>";
    }

    private function emailText() {
        $url = URLADM . "update-password/index?chave=" . $this->resultadoBd[0]['recover_password'];
        $this->emailData['contentText'] = "Prezado(a) {$this->firstName}\n\n";
        $this->emailData['contentText'] .= "Você solicitou uma alteração de senha!\n\n";
        $this->emailData['contentText'] .= "Para continuar o processo de recuperação de seua senha, clique no link abaixo ou cole o endereço abaixo no seu navegador: \n\n";
        $this->emailData['contentText'] .= $url . "\n\n";
        $this->emailData['contentText'] .= "Se você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma, até que você ative esse código.\n\n";
    }

}

?>