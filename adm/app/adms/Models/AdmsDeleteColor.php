<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsDeleteColor Model. Responsible for deleting a color.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsDeleteColor
{

    private bool $result;
    private int $id;
    private $databaseResult;

    function getResult(): bool {
        return $this->result;
    }
    
    public function deleteColor($id) {
        $this->id = (int) $id;
        /**Check if the color exists and if any situation of the user is using the same. */
        if ($this->viewColor() AND $this->checkSitsUser()) {
            $deleteColor = new \App\adms\Models\helper\AdmsDelete();
            $deleteColor->exeDelete("adms_colors", "WHERE id =:id", "id={$this->id}");
            
            if ($deleteColor->getResult()) {
                $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Cor apagada com sucesso!</div>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Cor não apagada!</div>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }

    /**Checks if the color exists */
    private function viewColor() {
        $viewColor = new \App\adms\Models\helper\AdmsRead();
        $viewColor->fullRead("SELECT id FROM adms_colors 
                WHERE id=:id
                LIMIT :limit", "id={$this->id}&limit=1");

        $this->databaseResult = $viewColor->getReadingResult();
        
        if ($this->databaseResult) {
            return true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Cor não encontrada!</div>";
            return false;
        }
    }
    /** Checks if any user situation is using the color to be deleted. */
    private function checkSitsUser() {
        $checkSitsUser = new \App\adms\Models\helper\AdmsRead();
        $checkSitsUser->fullRead("SELECT id FROM adms_sits_users WHERE adms_color_id=:adms_color_id LIMIT :limit", "adms_color_id={$this->id}&limit=1");
     
        if($checkSitsUser->getReadingResult()){
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: A cor não pode ser apagada, ela está sendo usada por um situação do usuário!</div>";
            return false;
        }else{
            return true;
        }
    }

}

?>