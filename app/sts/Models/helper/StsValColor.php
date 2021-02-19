<?php
namespace App\sts\Models\helper;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * Classe StsValColor responsável por validar se a cor existe
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsValColor
{

    private string $colorName;
    private $edit;
    private $id;
    private bool $resultado;
    private $resultadoBd;

    function getResultado(): bool {
        return $this->resultado;
    }

    public function valColor($colorname, $edit = null, $id = null) {
        $this->colorName = $colorname;
        
        $this->edit = $edit;
        $this->id = $id;
   
        $valColor = new \App\sts\Models\helper\StsRead();

        if (($this->edit == true) AND (!empty($this->id))) {
            $valColor->fullRead("SELECT id, name, color
                                      FROM sts_colors 
                                      WHERE (name =:name) AND
                                      id <>:id
                                      LIMIT :limit", 
                                      "name={$this->colorName}&id={$this->id}&limit=1");
                                    
        } else {
            $valColor->fullRead("SELECT id, name, color FROM sts_colors WHERE name =:name LIMIT :limit", "name={$this->colorName}&limit=1");
            
        }

        $this->resultadoBd = $valColor->getResult();

        if (!$this->resultadoBd) {
            $this->resultado = true;
        } else {
            
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Esta cor já está cadastrada!</div>";
            $this->resultado = false;
        }
    }

}

?>