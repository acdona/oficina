<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * StsListContactsPage Model. Responsible for listing the contacts pages.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsListContactsPage   
{

    private $databaseResult;
    private bool $result;
    private $pag;
    private $limitResult = 5;
    private $resultPg;

    function getDatabaseResult()
    {
        return $this->databaseResult;
    }

    function getResult(): bool
    {
        return $this->result;
    }

    function getResultPg()
    {
        return $this->resultPg;
    }

    public function listContactsPage($pag = null)
    {
        $this->pag = (int) $pag;
        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-contacts-page/index');
        $pagination->condition($this->pag, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id) AS num_result FROM sts_contacts");
        $this->resultPg = $pagination->getResult();

        $listContactsPage = new \App\adms\Models\helper\AdmsRead();
        $listContactsPage->fullRead("SELECT id, title_opening_hours, opening_hours, title_address, address_one, address_two, phone
                    FROM sts_contacts
                    ORDER BY title_opening_hours ASC
                    LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}");
        $this->databaseResult = $listContactsPage->getReadingResult();
        if($this->databaseResult){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Nenhum dado de contato de página encontrado!</div>";
            $this->result = false;
        }
    }

}

?>