<?php
namespace App\sts\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe StsViewSitsUser responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsViewSitsUser
{

    private $resultadoBd;
    private bool $resultado;
    private int $id;

    function getResultado(): bool {
        return $this->resultado;
    }
    
    function getResultadoBd() {
        return $this->resultadoBd;
    }

    public function viewSitsUser($id) {
        $this->id = (int) $id;
        $viewSitsUser = new \App\sts\Models\helper\StsRead();
        $viewSitsUser->fullRead("SELECT sit.id, sit.name, sit.sts_color_id,
                cor.name name_cor, cor.color
                FROM sts_sits_users sit
                LEFT JOIN sts_colors AS cor ON cor.id=sit.sts_color_id
                WHERE sit.id=:id
                LIMIT :limit", "id={$this->id}&limit=1");
                
        $this->resultadoBd = $viewSitsUser->getResult();
        if($this->resultadoBd){
            $this->resultado = true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Situação para usuário não encontrado!</div>";
            $this->resultado = false;
        }
    }

}

?>