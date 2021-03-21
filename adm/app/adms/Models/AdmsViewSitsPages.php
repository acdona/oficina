<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsViewSitsPages Model. Responsible for viewing the situations of the pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public  
 *
*/
class AdmsViewSitsPages
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

    public function viewSitsPages($id) {
        $this->id = (int) $id;
        $viewSitsPages = new \App\adms\Models\helper\AdmsRead();
        $viewSitsPages->fullRead("SELECT sit.id, sit.name,
                cor.color
                FROM adms_sits_pgs sit
                LEFT JOIN adms_colors AS cor ON cor.id=sit.adms_color_id
                WHERE sit.id=:id
                LIMIT :limit", "id={$this->id}&limit=1");
                
        $this->databaseResult = $viewSitsPages->getReadingResult();
        if($this->databaseResult){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Situação de página não encontrada!</div>";
            $this->result = false;
        }
    }

}

?>