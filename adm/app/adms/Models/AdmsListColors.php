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
      /** variáveis a cadastrar que trazem a paginação
     * 
     */
    
    private $pag;    
    private $limitResult = 5;
    private $resultPg;

    /** @var array $resultadoBd Recebe o resultado do banco de dados */
    private array $resultadoBb;

    /** @var bool $resultado Retorna se consulta ao banco de dados funcionou */
    private bool $resultado;

    function getResultado(): bool {
        return $this->resultado;
    }

    function getResultBd() {
        return $this->resultadoBd;
    }

    function getResultPg() {
        return $this->resultPg;
    }

    public function ListColors($pag = null) {

        $this->pag = (int) $pag;
        $paginacao = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-colors/index');

        $paginacao->condition($this->pag, $this->limitResult);
        $paginacao->pagination("SELECT COUNT(cor.id) AS num_result FROM adms_colors cor");
        $this->resultPg =$paginacao->getResult();


        $ListColors  = new \App\adms\Models\helper\AdmsRead();
        $ListColors->fullRead("SELECT id, name, color 
                               FROM adms_colors
                               LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$paginacao->getOffset()}
                               ");

        $this->resultadoBd = $ListColors->getResult();
        if($this->resultadoBd) {
            $this->resultado = true;
        }else{
            $_SESSION['msg'] = "Nenhuma cor encontrada!<br>";
            $this->resultado = false;
        }    
    }

}

?>