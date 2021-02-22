<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsListUsers Model responsible for listing the users.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsListUsers
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
        $paginacao = new \App\adms\Models\helper\AdmsPagination(URL . 'list-users/index');

        $paginacao->condition($this->pag, $this->limitResult);
        $paginacao->pagination("SELECT COUNT(usu.id) AS num_result 
                                FROM adms_users usu
                                ");
        $this->resultPg =$paginacao->getResult();


        $ListUsers  = new \App\adms\Models\helper\AdmsRead();
        $ListUsers->fullRead("SELECT usu.id, usu.name, usu.email,
                              sit.name name_sit,
                              cor.color
                               FROM adms_users usu
                               LEFT JOIN adms_sits_users AS sit ON sit.id=usu.adms_sits_user_id
                               LEFT JOIN adms_colors AS cor ON cor.id = sit.adms_color_id
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