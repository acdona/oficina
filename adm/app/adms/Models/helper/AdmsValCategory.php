<?php
namespace App\adms\Models\helper;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * Classe AdmsValCategory responsável por validar a categoria
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsValCategory
{

    private string $categoryName;
    private $edit;
    private $id;
    private bool $resultado;
    private $resultadoBd;

    function getResultado(): bool {
        return $this->resultado;
    }

    public function validarCategory($categoryname, $edit = null, $id = null) {
        $this->categoryName = $categoryname;
        
        $this->edit = $edit;
        $this->id = $id;
   
        $valCategory = new \App\adms\Models\helper\AdmsRead();

        if (($this->edit == true) AND (!empty($this->id))) {
            $valCategory->fullRead("SELECT id, name 
                                      FROM adms_categories 
                                      WHERE (name =:name) AND
                                      id <>:id
                                      LIMIT :limit", 
                                      "name={$this->categoryName}&id={$this->id}&limit=1");
                                    
        } else {
            $valCategory->fullRead("SELECT id, name FROM adms_categories WHERE name =:name LIMIT :limit", "name={$this->categoryName}&limit=1");

        }

        $this->resultadoBd = $valCategory->getResult();

        if (!$this->resultadoBd) {
            $this->resultado = true;
        } else {
            
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Esta categoria já está cadastrada!</div>";
            $this->resultado = false;
        }
    }

}

?>