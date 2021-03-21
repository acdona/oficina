<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsListConfEmails Model. Responsible for listing email confirmation. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsListConfEmails
{

    private $databaseResult;
    private bool $result;
    private $pag;
    private $limitResult = 5;
    private $resultPg;

    function getResult() {
        return $this->result;
    }
    
    function getDatabaseResult() {
        return $this->databaseResult;
    }

    function getResultPg() {
        return $this->resultPg;
    }
    
    
    public function listConfEmails($pag = null) {

        $this->pag = (int) $pag;
        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-conf-emails/index');
        $pagination->condition($this->pag, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id) AS num_result FROM adms_confs_emails");
        $this->resultPg = $pagination->getResult();


        $listConfEmails = new \App\adms\Models\helper\AdmsRead();
        $listConfEmails->fullRead("SELECT id, title, name, email
                FROM adms_confs_emails
                ORDER BY id DESC
                LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->databaseResult = $listConfEmails->getReadingResult();
        if ($this->databaseResult) {
            $this->result = true;
        } else {
            
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Nenhum e-mail encontrado!</div>";
            $this->result = false;
        }
    }

}

?>