<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe AdmsListSitsPages. Responsible for listing situations of the pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsListSitsPages
{

    private $databaseResult;
    private bool $result;
    private $pag;
    private $limitResult = 40;
    private $resultPg;
    
    function getDatabaseResult() {
        return $this->databaseResult;
    }

    function getResult(): bool {
        return $this->result;
    }

    function getResultPg() {
        return $this->resultPg;
    }

    public function listSitsPages($pag = null) {
        $this->pag = (int) $pag;
        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-sits-pages/index');
        $pagination->condition($this->pag, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id) AS num_result FROM adms_sits_pgs");
        $this->resultPg = $pagination->getResult();
        
        $listSitsPages = new \App\adms\Models\helper\AdmsRead();
        $listSitsPages->fullRead("SELECT sit.id, sit.name,
                    cor.color
                    FROM adms_sits_pgs sit
                    LEFT JOIN adms_colors AS cor ON cor.id=sit.adms_color_id
                    LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}");
        $this->databaseResult = $listSitsPages->getReadingResult();
        if($this->databaseResult){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Nenhuma situação de página encontrada!</div>";
            $this->result = false;
        }
    }

}

?>