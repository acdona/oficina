<?php
namespace App\sts\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * StsListUsers Model responsible for listing the users.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsListUsers
{
      /** variáveis a cadastrar que trazem a paginação
     * 
     */
      
    private int $pag;    
    private int $limitResult = 5;
    private string $resultPg;

    /** @var array $resultadoBd Recebe o resultado do banco de dados */
    private array $resultadoBd;

    /** @var bool $resultado Retorna se consulta ao banco de dados funcionou */
    private bool $resultado;

    function getResultado(): bool {
        return $this->resultado;
    }

    function getResultadoBd() {
        return $this->resultadoBd;
    }

    function getResultPg() {
        return $this->resultPg;
    }

    public function listUsers($pag = null) {
        
        $this->pag = (int) $pag;
        $paginacao = new \App\sts\Models\helper\StsPagination(URL . 'list-users/index');

        $paginacao->condition($this->pag, $this->limitResult);
        $paginacao->pagination("SELECT COUNT(usu.id) AS num_result 
                                FROM sts_users usu
                                ");
        $this->resultPg =$paginacao->getResult();


        $ListUsers  = new \App\sts\Models\helper\StsRead();
        $ListUsers->fullRead("SELECT usu.id, usu.name, usu.email,
                              sit.name name_sit,
                              cor.color
                               FROM sts_users usu
                               LEFT JOIN sts_sits_users AS sit ON sit.id=usu.sts_sits_user_id
                               LEFT JOIN sts_colors AS cor ON cor.id = sit.sts_color_id
                               LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$paginacao->getOffset()}
                               ");
        
        $this->resultadoBd = $ListUsers->getResult();
        if($this->resultadoBd) {
            $this->resultado = true;
        }else{
            $_SESSION['msg'] = "Nenhum usuário encontrado!<br>";
            $this->resultado = false;
        }    
    }

}

?>