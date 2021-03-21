<?php
namespace App\adms\Models\helper;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * AdmsValColor responsável por validar se a cor existe
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsValColor
{

    private string $colorName;
    private $edit;
    private $id;
    private bool $result;
    private $databaseResult;

    function getResult(): bool {
        return $this->result;
    }

    public function valColor($colorname, $edit = null, $id = null) {
        $this->colorName = $colorname;
        
        $this->edit = $edit;
        $this->id = $id;
   
        $valColor = new \App\adms\Models\helper\AdmsRead();

        if (($this->edit == true) AND (!empty($this->id))) {
            $valColor->fullRead("SELECT id, name, color
                                      FROM adms_colors 
                                      WHERE (name =:name) AND
                                      id <>:id
                                      LIMIT :limit", 
                                      "name={$this->colorName}&id={$this->id}&limit=1");
                                    
        } else {
            $valColor->fullRead("SELECT id, name, color FROM adms_colors WHERE name =:name LIMIT :limit", "name={$this->colorName}&limit=1");
            
        }

        $this->databaseResult = $valColor->getReadingResult();

        if (!$this->databaseResult) {
            $this->result = true;
        } else {
            
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Esta cor já está cadastrada!</div>";
            $this->result = false;
        }
    }

}

?>