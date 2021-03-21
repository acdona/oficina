<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsListSitsUsers Model. Responsible for listing the user's situation.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsListSitsUsers
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
    
    public function listSitsUsers($pag = null) {
        
        $this->pag = (int) $pag;
        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-sits-users/index');
        $pagination->condition($this->pag, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id) AS num_result FROM adms_sits_users");
        $this->resultPg = $pagination->getResult();

        $listSitsUsers = new \App\adms\Models\helper\AdmsRead();
        $listSitsUsers->fullRead("SELECT sit.id, sit.name, sit.adms_color_id,
                cor.color
                FROM adms_sits_users sit
                LEFT JOIN adms_colors AS cor ON cor.id=sit.adms_color_id
                LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->databaseResult = $listSitsUsers->getReadingResult();
        if ($this->databaseResult) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Nenhum situação para usuário encontrado!</div>";
            $this->result = false;
        }
    }

}

?>