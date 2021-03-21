<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsDeleteUser Model. Responsible for deleting the user.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsDeleteUser
{

    private bool $result;
    private int $id;
    private $databaseResult;
    private string $delDirectory;
    private string $delImg;

    function getResult(): bool {
        return $this->result;
    }

    public function deleteUser($id) {
        $this->id = (int) $id;

        if ($this->viewUsers()) {
            $deleteUser = new \App\adms\Models\helper\AdmsDelete();
            $deleteUser->exeDelete("adms_users", "WHERE id =:id", "id={$this->id}");

            if ($deleteUser->getResult()) {
                $this->deleteImg();
                $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Usuário apagado com sucesso!</div>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Usuário não apagado com sucesso!</div>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }

    private function viewUsers() {
        $viewUser = new \App\adms\Models\helper\AdmsRead();
        $viewUser->fullRead("SELECT usu.id, usu.image 
                FROM adms_users usu
                INNER JOIN adms_access_levels As lev ON lev.id=usu.adms_access_level_id
                WHERE usu.id=:id AND lev.order_levels >:order_levels
                LIMIT :limit", "id={$this->id}&order_levels=".$_SESSION['order_levels']."&limit=1");
           
        $this->databaseResult = $viewUser->getReadingResult();
        if ($this->databaseResult) {
            return true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Usuário não encontrado!</div>";
            return false;
        }
    }

    private function deleteImg() {
        if ((!empty($this->databaseResult[0]['image'])) OR ($this->databaseResult[0]['image'] != null)) {
            $this->delDirectory = "app/adms/assets/images/users/" . $this->databaseResult[0]['id'];
            $this->delImg = $this->delDirectory . "/" . $this->databaseResult[0]['image'];
            
            if(file_exists($this->delImg)){
                unlink($this->delImg);
            }
            
            if(file_exists($this->delDirectory)){
                rmdir($this->delDirectory);
            }
            
        }
    }


}

?>