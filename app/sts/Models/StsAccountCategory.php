<?php
namespace App\sts\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Models StsAccountCategory responsável pelo  
 * coleta de informações do banco de dados 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsAccountCategory
{
    /** @var array $data Recebe o registro do banco de dados */
    private array $data;

    /** variáveis a cadastrar que trazem a paginação
     * 
     */
    private $pag;
    private bool $resultado;
    private $limitResult = 2;
    private $resultPg;

    function getResultado() {
        return $this->resultado;
    }
   
    function getResultPg() {
        return $this->resultPg;
    }

   
    /**
     * Instancia a classe genérica no helper responsável em buscar os registro no banco de dados.
     * Possui a QUERY responsável em buscar os registros no BD.
     * @return array Retorna o registro do banco de dados com informações para página Home
     */
    public function index(): array {
        $this->viewCategory();
        return $this->data;
    }
    
    private function viewCategory($pag = null) {
        $this->pag = (int) $pag;
        $paginacao = new \App\sts\Models\helper\StsPagination(URL . 'account-category/index');
        $paginacao->condition($this->pag, $this->limitResult);
        $paginacao->pagination("SELECT COUNT(acat.id) AS num_result FROM sts_account_categories acat");
        $this->resultPg =$paginacao->getResult();

        $viewCategory = new \App\sts\Models\helper\StsRead();
        $viewCategory->fullRead("SELECT acat.id, acat.name 
                FROM sts_account_categories acat 
                LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$paginacao->getOffset()}");
        $this->data = $viewCategory->getResult(); 
           
        if ($this->data) {
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "Nenhum usuário encontrado!<br>";
            $this->resultado = false;
        }  
    }
}
?>
