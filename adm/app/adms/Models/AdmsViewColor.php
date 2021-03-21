<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsViewColor Model responsible for viewing a category.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsViewColor
{

    private array $databaseResult;
    private bool $result;
    private int $id;

    function getResult(): bool {
        return $this->result;
    }
    
    function getDatabaseResult() {
        return $this->databaseResult;
    }

    public function viewColor($id) {
        $this->id = (int) $id;
        $viewColor = new \App\adms\Models\helper\AdmsRead();
        $viewColor->fullRead("SELECT id, name, color
                FROM adms_colors 
                WHERE id=:id
                LIMIT :limit", "id={$this->id}&limit=1");
                
        $this->databaseResult = $viewColor->getReadingResult();
 
        if($this->databaseResult){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Cor não encontrada!</div>";
            $this->result = false;
        }
    }

}

?>