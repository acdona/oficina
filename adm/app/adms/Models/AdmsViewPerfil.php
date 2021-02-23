<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe AdmsViewPerfil responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsViewPerfil
{

    private $resultadoBd;
    private bool $resultado;


    function getResultado(): bool {
        return $this->resultado;
    }
    function getResultadoBd() {
        return $this->resultadoBd;
    }
 
    public function viewPerfil() {
        $viewUser = new \App\adms\Models\helper\AdmsRead();
        $viewUser->fullRead("SELECT id, name, nickname, email, username, image_user 
                             FROM adms_users 
                             WHERE id=:id 
                             LIMIT :limit", "id={$_SESSION['user_id']}&limit=1");

        $this->resultadoBd = $viewUser->getResult();
        if($this->resultadoBd) {
            $this->resultado = true;
        }else {
            $_SESSION['msg'] = "Usuário não encontrado<br>";
            $this->resultado = false;
        }
    }
 

}

?>