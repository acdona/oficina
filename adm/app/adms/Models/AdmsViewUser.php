<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsViewUser Model. Responsible for viewing the user.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsViewUser
{    
    private $databaseResult;
    private bool $result;
    private int $id;

    function getResult(): bool {
        return $this->result;
    }
    
    function getDatabaseResult() {
        return $this->databaseResult;
    }

    public function viewUser($id) {
        $this->id = (int) $id;
        $viewUser = new \App\adms\Models\helper\AdmsRead();
        $viewUser->fullRead("SELECT usu.id, usu.name, usu.nickname, usu.email, usu.username, usu.image,
                sit.name name_sit,
                cor.color,
                lev.name name_lev
                FROM adms_users usu
                LEFT JOIN adms_sits_users AS sit ON sit.id=usu.adms_sits_user_id
                LEFT JOIN adms_colors AS cor ON cor.id=sit.adms_color_id
                INNER JOIN adms_access_levels As lev ON lev.id=usu.adms_access_level_id
                WHERE usu.id=:id AND lev.order_levels >:order_levels
                LIMIT :limit", "id={$this->id}&order_levels=".$_SESSION['order_levels']."&limit=1");
                
        $this->databaseResult = $viewUser->getReadingResult();
        if($this->databaseResult){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Usuário não encontrado</div>";
            $this->result = false;
        }
    }
}

?>