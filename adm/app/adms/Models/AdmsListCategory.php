<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsListCategory Model responsible for listing the categories.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsListCategory
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
    
    public function listCategory($pag = null) {

        $this->pag = (int) $pag;
        $paginacao = new \App\adms\Models\helper\AdmsPagination(URL . 'list-category/index');

        $paginacao->condition($this->pag, $this->limitResult);
        $paginacao->pagination("SELECT COUNT(cat.id) AS num_result FROM adms_categories cat");
        $this->resultPg =$paginacao->getResult();

        $listCategory = new \App\adms\Models\helper\AdmsRead();
        $listCategory->fullRead("SELECT cat.id, cat.name 
                FROM adms_categories cat 
                LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$paginacao->getOffset()}");
        $this->resultadoBd = $listCategory->getResult(); 
           
        if ($this->resultadoBd) {
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "Nenhum usuário encontrado!<br>";
            $this->resultado = false;
        }  
        
    }
    

}

?>