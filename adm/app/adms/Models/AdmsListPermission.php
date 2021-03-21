<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsListPermission Model. Responsible for listing access permisions. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsListPermission
{

    
    private $databaseResult;
    private bool $result;
    private $pag;
    private int $level;
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

    public function listPermission($pag = null, $level = null) {

        $this->pag = (int) $pag;
        $this->level = (int) $level;

        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-permission/index', "?level={$this->level}");
        $pagination->condition($this->pag, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id) AS num_result FROM adms_levels_pages WHERE adms_access_level_id =:adms_access_level_id", "adms_access_level_id=" . $this->level);
        $this->resultPg = $pagination->getResult();

        $listPermission = new \App\adms\Models\helper\AdmsRead();
        $listPermission->fullRead("SELECT lev_pag.id, lev_pag.permission, lev_pag.order_level_page, lev_pag.adms_access_level_id, lev_pag.adms_page_id,
                pag.page_name
                FROM adms_levels_pages lev_pag
                LEFT JOIN adms_pages AS pag ON pag.id=lev_pag.adms_page_id
                INNER JOIN adms_access_levels AS lev ON lev.id=lev_pag.adms_access_level_id
                WHERE lev_pag.adms_access_level_id =:adms_access_level_id
                AND lev.order_levels >:order_levels
                ORDER BY lev_pag.order_level_page ASC
                LIMIT :limit OFFSET :offset", "adms_access_level_id=" . $this->level . "&order_levels=" . $_SESSION['order_levels'] . "&limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->databaseResult = $listPermission->getReadingResult();
        if ($this->databaseResult) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Nenhuma permissão para o nível acesso encontrada!</div>";
            $this->result = false;
        }
    }


}

?>