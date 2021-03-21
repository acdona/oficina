<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsViewTypesPages Model. Responsible for viewing the types of pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsViewTypesPages
{

    private $databaseResult;
    private bool $result;
    private int $id;
    
    function getDatabaseResult()
    {
        return $this->databaseResult;
    }

    function getResult(): bool
    {
        return $this->result;
    }

    public function viewTypesPages($id) {
        $this->id = (int) $id;
        $viewTypesPages = new \App\adms\Models\helper\AdmsRead();
        $viewTypesPages->fullRead("SELECT id, type, name, order_type_pg, note
                FROM adms_types_pgs
                WHERE id=:id
                LIMIT :limit", "id={$this->id}&limit=1");
        $this->databaseResult = $viewTypesPages->getReadingResult();
        if($this->databaseResult){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Tipo de página não encontrado!</div>";
            $this->result = false;
        }
    }

}

?>