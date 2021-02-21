<?php
namespace App\sts\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * StsListCategory Model responsible for listing the categories.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsListCategory
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
        $paginacao = new \App\sts\Models\helper\StsPagination(URL . 'list-category/index');

        $paginacao->condition($this->pag, $this->limitResult);
        $paginacao->pagination("SELECT COUNT(cat.id) AS num_result FROM sts_categories cat");
        $this->resultPg =$paginacao->getResult();

        $listCategory = new \App\sts\Models\helper\StsRead();
        $listCategory->fullRead("SELECT cat.id, cat.name 
                FROM sts_categories cat 
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