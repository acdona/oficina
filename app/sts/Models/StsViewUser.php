<?php
namespace App\sts\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Model StsViewUser responsável por mostrar usuário
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsViewUser
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

    public function viewUser($id) {
        $this->id = (int) $id;
        $viewUser = new \App\sts\Models\helper\StsRead();
        $viewUser->fullRead("SELECT usu.id, usu.name, usu.nickname, usu.email, usu.username, usu.image_user,
                sit.name name_sit,
                cor.color
                FROM sts_users usu
                LEFT JOIN sts_sits_users AS sit ON sit.id=usu.sts_sits_user_id
                LEFT JOIN sts_colors AS cor ON cor.id=sit.sts_color_id
                WHERE usu.id=:id
                LIMIT :limit", "id={$this->id}&limit=1");
                
        $this->resultadoBd = $viewUser->getResult();
        if($this->resultadoBd){
            $this->resultado = true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Usuário não encontrado</div>";
            $this->resultado = false;
        }
    }
}

?>