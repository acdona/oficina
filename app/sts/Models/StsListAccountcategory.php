<?php
namespace App\sts\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Models StsListAccountCategory responsável pelo  
 * coleta de informações do banco de dados 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsListAccountCategory
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
        $paginacao = new \App\sts\Models\helper\StsPagination(URL . 'list-account-category/index');

        $paginacao->condition($this->pag, $this->limitResult);
        $paginacao->pagination("SELECT COUNT(acat.id) AS num_result FROM sts_account_categories acat");
        $this->resultPg =$paginacao->getResult();

        $listAccountCategory = new \App\sts\Models\helper\StsRead();
        $listAccountCategory->fullRead("SELECT acat.id, acat.name 
                FROM sts_account_categories acat 
                LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$paginacao->getOffset()}");
        $this->resultadoBd = $listAccountCategory->getResult(); 
           
        if ($this->resultadoBd) {
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "Nenhum usuário encontrado!<br>";
            $this->resultado = false;
        }  
        
    }
}
?>
