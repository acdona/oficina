<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsListPages Model. Responsible for listing the pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsListPages
{

    private $databaseResult;
    private bool $result;
    private $pag;
    private $limitResult = 40;
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

    public function listPages($pag = null) {

        $this->pag = (int) $pag;
        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-pages/index');
        $pagination->condition($this->pag, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id) AS num_result FROM adms_pages");
        $this->resultPg = $pagination->getResult();

        $listPages = new \App\adms\Models\helper\AdmsRead();
        $listPages->fullRead("SELECT pg.id, pg.page_name,
                tpg.type type_tpg, tpg.name name_tpg,
                sit.name name_sit, clr.color name_color
                FROM adms_pages pg
                LEFT JOIN adms_types_pgs AS tpg ON tpg.id=pg.adms_types_pgs_id
                LEFT JOIN adms_sits_pgs AS sit ON sit.id=pg.adms_sits_pgs_id
                INNER JOIN adms_colors AS clr ON clr.id=sit.adms_color_id
                ORDER BY id DESC
                LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->databaseResult = $listPages->getReadingResult();
        if ($this->databaseResult) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Nenhuma página encontrada!</div>";
            $this->result = false;
        }
    }

}

?>