<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsListGroupsPages Model. Responsible for listing the groups of page. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsListGroupsPages
{

    private $databaseResult;
    private bool $result;
    private $pag;
    private $limitResult = 40;
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

    public function listGroupsPages($pag = null)
    {
        $this->pag = (int) $pag;
        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-groups-pages/index');
        $pagination->condition($this->pag, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id) AS num_result FROM adms_groups_pgs");
        $this->resultPg = $pagination->getResult();

        $listGroupsPages = new \App\adms\Models\helper\AdmsRead();
        $listGroupsPages->fullRead("SELECT id, name, order_group_pg
                    FROM adms_groups_pgs
                    ORDER BY order_group_pg ASC
                    LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}");
        $this->databaseResult = $listGroupsPages->getReadingResult();
        if($this->databaseResult){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Nenhum grupo de página encontrado!</div>";
            $this->result = false;
        }
    }

}

?>