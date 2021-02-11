<?php
namespace App\sts\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Models StsListAccountcategory responsável pelo  
 * coleta de informações do banco de dados 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsListAccountcategory
{
    // /** @var array $data Recebe o registro do banco de dados */
    private array $data;

    /** variáveis a cadastrar que trazem a paginação
     * 
     */
    private $resultadoBd;
    private bool $resultado;
    private $pag;    
    private $limitResult = 2;
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

        /**
     * Instancia a classe genérica no helper responsável em buscar os registro no banco de dados.
     * Possui a QUERY responsável em buscar os registros no BD.
     * @return array Retorna o registro do banco de dados com informações para página Home
     */
    public function index(): array {
        $this->ListAccountcategory();
        return $this->data;
    }

    public function ListAccountcategory($pag = null) {

        $this->pag = (int) $pag;
        $paginacao = new \App\sts\Models\helper\StsPagination(URL . 'list-accountcategory/index');

        $paginacao->condition($this->pag, $this->limitResult);
        $paginacao->pagination("SELECT COUNT(acat.id) AS num_result FROM sts_account_categories acat");
        $this->resultPg =$paginacao->getResult();

        $listAccountcategory = new \App\sts\Models\helper\StsRead();
        $listAccountcategory->fullRead("SELECT acat.id, acat.name 
                FROM sts_account_categories acat 
                LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$paginacao->getOffset()}");
        $this->resultadoBd = $listAccountcategory->getResult(); 
           
        // if ($this->resultadoBd) {
        //     $this->resultado = true;
        // } else {
        //     $_SESSION['msg'] = "Nenhum usuário encontrado!<br>";
        //     $this->resultado = false;
        // }  
        $this->resultado = true;
    }
}
?>
