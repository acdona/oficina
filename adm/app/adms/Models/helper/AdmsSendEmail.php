<?php
namespace App\adms\Models\helper;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * AdmsSendEmail Helper. Responsible for sending email
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsSendEmail
{

    private array $data;
    private array $dataInfoEmail;
    private array $databaseResult;
    private bool $result;
    private string $fromEmail;
    private int $optionConfEmail;

    function getResult(): bool {
        return $this->result;
    }

    function getFromEmail(): string {
        return $this->fromEmail;
    }

    public function sendEmail($data, $optionConfEmail) {
        $this->optionConfEmail = $optionConfEmail;
        $this->data = $data;
        $this->infoPhpMailer();
        $this->sendEmailPhpMailer();
    }

    private function infoPhpMailer() {
        $confEmail = new \App\adms\Models\helper\AdmsRead();
        $confEmail->fullRead("SELECT name, email, host, username, password, smtpsecure, port FROM adms_confs_emails WHERE id =:id LIMIT :limit", "id={$this->optionConfEmail}&limit=1");
        $this->databaseResult = $confEmail->getReadingResult();
        
        $this->dataInfoEmail['host'] = $this->databaseResult[0]['host'];
        $this->dataInfoEmail['fromEmail'] = $this->databaseResult[0]['email'];
        $this->fromEmail = $this->dataInfoEmail['fromEmail'];
        $this->dataInfoEmail['fromName'] = $this->databaseResult[0]['name'];
        $this->dataInfoEmail['username'] = $this->databaseResult[0]['username'];
        $this->dataInfoEmail['password'] = $this->databaseResult[0]['password'];
        $this->dataInfoEmail['smtpsecure'] = $this->databaseResult[0]['smtpsecure'];
        $this->dataInfoEmail['port'] = $this->databaseResult[0]['port'];
    }

    private function sendEmailPhpMailer() {
        $mail = new PHPMailer(true);
        try {
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->Host = $this->dataInfoEmail['host'];
            $mail->SMTPAuth = true;
            $mail->Username = $this->dataInfoEmail['username'];
            $mail->Password = $this->dataInfoEmail['password'];
            $mail->SMTPSecure = $this->dataInfoEmail['smtpsecure'];
            $mail->Port = $this->dataInfoEmail['port'];

            $mail->setFrom($this->dataInfoEmail['fromEmail'], $this->dataInfoEmail['fromName']);
            $mail->addAddress($this->data['toEmail'], $this->data['toName']);

            $mail->isHTML(true);
            $mail->Subject = $this->data['subject'];
            $mail->Body = $this->data['contentHtml'];
            $mail->AltBody = $this->data['contentText'];

            $mail->send();
            $this->result = true;
        } catch (Exception $ex) {
            $this->result = false;
        }
    }

}
