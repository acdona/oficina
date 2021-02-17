<?php
namespace App\sts\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * StsListCities Model responsible for listing the cities.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsListCities
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

    public function ListCities($pag = null) {

        $this->pag = (int) $pag;
        $paginacao = new \App\sts\Models\helper\StsPagination(URL . 'list-cities/index');

        $paginacao->condition($this->pag, $this->limitResult);
        $paginacao->pagination("SELECT COUNT(cit.id) AS num_result FROM sts_cities cit");
        $this->resultPg =$paginacao->getResult();


        $ListCities  = new \App\sts\Models\helper\StsRead();
        $ListCities->fullRead("SELECT id, code, name, fs 
                               FROM sts_cities
                               LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$paginacao->getOffset()}
                               ");

        $this->resultadoBd = $ListCities->getResult();
        if($this->resultadoBd) {
            $this->resultado = true;
        }else{
            $_SESSION['msg'] = "Nenhuma cidade encontrada!<br>";
            $this->resultado = false;
        }    
    }

}

?>