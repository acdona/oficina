<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsListAccountCategory Model responsible for listing the account categories.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsListAccountCategory
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
    
    public function listAccountCategory($pag = null) {

        $this->pag = (int) $pag;
        $paginacao = new \App\adms\Models\helper\AdmsPagination(URL . 'list-account-category/index');

        $paginacao->condition($this->pag, $this->limitResult);
        $paginacao->pagination("SELECT COUNT(acat.id) AS num_result FROM adms_account_categories acat");
        $this->resultPg =$paginacao->getResult();

        $listAccountCategory = new \App\adms\Models\helper\AdmsRead();
        $listAccountCategory->fullRead("SELECT acat.id, acat.name 
                FROM adms_account_categories acat 
                LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$paginacao->getOffset()}");
        $this->resultadoBd = $listAccountCategory->getResult(); 
           
        if ($this->resultadoBd) {
            $this->resultado = true;
        } else {
          
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Nenhuma Categoria encontrada!</div>";
            $this->resultado = false;
        }  
        
    }
}
?>
