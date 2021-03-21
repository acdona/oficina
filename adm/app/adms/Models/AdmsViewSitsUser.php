<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsViewSitsUser Model. Responsible for viewing the user's situation.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsViewSitsUser
{

    private $dtabaseResult;
    private bool $result;
    private int $id;

    function getResult(): bool {
        return $this->result;
    }
    
    function getDatabaseResult() {
        return $this->databaseResult;
    }

    public function viewSitsUser($id) {
        $this->id = (int) $id;
        $viewSitsUser = new \App\adms\Models\helper\AdmsRead();
        $viewSitsUser->fullRead("SELECT sit.id, sit.name, sit.adms_color_id,
                cor.name name_cor, cor.color
                FROM adms_sits_users sit
                LEFT JOIN adms_colors AS cor ON cor.id=sit.adms_color_id
                WHERE sit.id=:id
                LIMIT :limit", "id={$this->id}&limit=1");
                
        $this->databaseResult = $viewSitsUser->getReadingResult();
        if($this->databaseResult){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Situação para usuário não encontrado!</div>";
            $this->result = false;
        }
    }

}

?>