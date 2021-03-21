<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsViewAccessLevel Model. Responsible for viewing an access level.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsViewAccessLevel
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

    public function viewAccessLevel($id) {
        $this->id = (int) $id;
        $viewAccessLevel = new \App\adms\Models\helper\AdmsRead();
        $viewAccessLevel->fullRead("SELECT id, name, order_levels
                FROM adms_access_levels 
                WHERE id=:id
                AND order_levels >=:order_levels
                LIMIT :limit", "id={$this->id}&order_levels=". $_SESSION['order_levels'] ."&limit=1");
                
        $this->databaseResult = $viewAccessLevel->getReadingResult();
 
        if($this->databaseResult){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Nível de acesso não encontrado!</div>";
            $this->result = false;
        }
    }

}

?>