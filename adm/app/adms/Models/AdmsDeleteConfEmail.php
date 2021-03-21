<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsDeleteConfEmail Model. Responsible for deleting the email configuration.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsDeleteConfEmail
{

    private bool $result;
    private int $id;
    private $databaseResult;

    function getResult(): bool {
        return $this->result;
    }

    public function deleteConfEmail($id) {
        $this->id = (int) $id;

        if ($this->viewConfEmail()) {
            $deleteConfEmail = new \App\adms\Models\helper\AdmsDelete();
            $deleteConfEmail->exeDelete("adms_confs_emails", "WHERE id =:id", "id={$this->id}");

            if ($deleteConfEmail->getResult()) {
                $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Email apagado com sucesso!</div>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Erro: Email não apagado!</div>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }

    private function viewConfEmail() {
        $viewConfEmail = new \App\adms\Models\helper\AdmsRead();
        $viewConfEmail->fullRead("SELECT id FROM adms_confs_emails
                WHERE id=:id
                LIMIT :limit", "id={$this->id}&limit=1");

        $this->databaseResult = $viewConfEmail->getReadingResult();
        if ($this->databaseResult) {
            return true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: E-mail não encontrado!</div>";
            return false;
        }
    }


}

?>