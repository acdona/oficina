<?php
namespace App\sts\Models\helper;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * Classe StsValAccountCategory responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsValAccountCategory
{

    private string $accountCategoryName;
    private $edit;
    private $id;
    private bool $resultado;
    private $resultadoBd;

    function getResultado(): bool {
        return $this->resultado;
    }

    public function validarAccountCategory($accountcategoryname, $edit = null, $id = null) {
        $this->accountCategoryName = $accountcategoryname;
        
        $this->edit = $edit;
        $this->id = $id;
   
        $valAccountCategory = new \App\sts\Models\helper\StsRead();

        if (($this->edit == true) AND (!empty($this->id))) {
            $valAccountCategory->fullRead("SELECT id, name 
                                      FROM sts_account_categories 
                                      WHERE (name =:name) AND
                                      id <>:id
                                      LIMIT :limit", 
                                      "name={$this->accountCategoryName}&id={$this->id}&limit=1");
                                    
        } else {
            $valAccountCategory->fullRead("SELECT id, name FROM sts_account_categories WHERE name =:name LIMIT :limit", "name={$this->accountCategoryName}&limit=1");

        }

        $this->resultadoBd = $valAccountCategory->getResult();

        if (!$this->resultadoBd) {
            $this->resultado = true;
        } else {
            
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Esta categoria já está cadastrada!</div>";
            $this->resultado = false;
        }
    }

}

?>