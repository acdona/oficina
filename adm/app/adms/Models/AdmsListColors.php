<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsListColors Model responsible for listing the colors.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsListColors
{
    /**
     *  Variables to register that bring the pagnation
     * 
     */
    private $pag;    
    private $limitResult = 5;
    private $resultPg;

    /** @var array $databaseResult Receive the result from the database. */
    private array $databaseResult;

    /** @var bool $result Checks whetter the database query worked.. */
    private bool $result;

    function getResult(): bool {
        return $this->result;
    }

    function getDatabaseResult() {
        return $this->databaseResult;
    }

    function getResultPg() {
        return $this->resultPg;
    }

    public function ListColors($pag = null) {

        $this->pag = (int) $pag;
        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-colors/index');

        $pagination->condition($this->pag, $this->limitResult);
        $pagination->pagination("SELECT COUNT(cor.id) AS num_result FROM adms_colors cor");
        $this->resultPg =$pagination->getResult();


        $ListColors  = new \App\adms\Models\helper\AdmsRead();
        $ListColors->fullRead("SELECT id, name, color 
                               FROM adms_colors
                               LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}
                               ");

        $this->databaseResult = $ListColors->getReadingResult();
        if($this->databaseResult) {
            $this->result = true;
        }else{
            
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Nenhuma cor encontrada!</div>";
            $this->result = false;
        }    
    }

}

?>