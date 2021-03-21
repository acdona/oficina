<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsListTypesPages Model. Responsible for listing the types of pages.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsListTypesPages   
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

    public function listTypesPages($pag = null)
    {
        $this->pag = (int) $pag;
        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-types-pages/index');
        $pagination->condition($this->pag, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id) AS num_result FROM adms_types_pgs");
        $this->resultPg = $pagination->getResult();

        $listTypesPages = new \App\adms\Models\helper\AdmsRead();
        $listTypesPages->fullRead("SELECT id, type, name, order_type_pg
                    FROM adms_types_pgs
                    ORDER BY order_type_pg ASC
                    LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}");
        $this->databaseResult = $listTypesPages->getReadingResult();
        if($this->databaseResult){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Nenhum tipo de página encontrado!</div>";
            $this->result = false;
        }
    }

}

?>