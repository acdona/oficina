<?php
namespace App\sts\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe StsListSitsUsers responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsListSitsUsers
{

    private $resultadoBd;
    private bool $resultado;
    private $pag;
    private $limitResult = 40;
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
    
    public function listSitsUsers($pag = null) {
        
        $this->pag = (int) $pag;
        $paginacao = new \App\sts\Models\helper\StsPagination(URLADM . 'list-sits-users/index');
        $paginacao->condition($this->pag, $this->limitResult);
        $paginacao->pagination("SELECT COUNT(id) AS num_result FROM sts_sits_users");
        $this->resultPg = $paginacao->getResult();

        $listSitsUsers = new \App\sts\Models\helper\StsRead();
        $listSitsUsers->fullRead("SELECT sit.id, sit.name, sit.sts_color_id,
                cor.color
                FROM sts_sits_users sit
                LEFT JOIN sts_colors AS cor ON cor.id=sit.sts_color_id
                LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$paginacao->getOffset()}");

        $this->resultadoBd = $listSitsUsers->getResult();
        if ($this->resultadoBd) {
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Nenhum situação para usuário encontrado!</div>";
            $this->resultado = false;
        }
    }

}

?>