<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsListStsServices Model responsible for listing the categories.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsListStsServices
{
    /** variáveis a cadastrar que trazem a paginação
     * 
     */
    private $resultadoBd;
    private bool $resultado;
    private $pag;    
    private $limitResult = 5;
    private $resultPg;

    function getResultado() {
        return $this->resultado;
    }
    function getResultadoBd() {
        return $this->resultadoBd;
    }
   
    function getResultPg() {
        return $this->resultPg;
    }
    
    public function listStsServices($pag = null) {

        $this->pag = (int) $pag;
        $paginacao = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-sts-services/index');

        $paginacao->condition($this->pag, $this->limitResult);
        $paginacao->pagination("SELECT COUNT(sserv.id) AS num_result FROM sts_homes_services sserv");
        $this->resultPg =$paginacao->getResult();
        
        $listStsServices = new \App\adms\Models\helper\AdmsRead();
        $listStsServices->fullRead("SELECT id, title_serv, subtitle_serv, icone_one_serv, title_one_serv, desc_one_serv, icon_two_serv, title_two_serv, desc_two_serv, icon_three_serv, title_three_serv, desc_three_serv 
                FROM sts_homes_services 
                LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$paginacao->getOffset()}");
        $this->resultadoBd = $listStsServices->getResult(); 
           
        if ($this->resultadoBd) {
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "Nenhum usuário encontrado!<br>";
            $this->resultado = false;
        }  
        var_dump($this->resultadoBd);
    }
    

}

?>