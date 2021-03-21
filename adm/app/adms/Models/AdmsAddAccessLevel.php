<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsAddAccessLevel Model. Responsible for adding a access level.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsAddAccessLevel
{

    private array $data;
    private bool $result;
    private $databaseResult;

    function getResult() {
        return $this->result;
    }

    public function create(array $data = null) {
        $this->data = $data;
        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->validateData($this->data);

        if ($valEmptyField->getResult()) {
            $this->add();
        } else {
            $this->result = false;
        }
    }

    private function add() {
        if($this->viewLastAccessLevel()) {
            $this->data['created'] = date("Y-m-d H:i:s");

            $createAccessLevel = new \App\adms\Models\helper\AdmsCreate();
            $createAccessLevel->exeCreate("adms_access_levels", $this->data);

            if ($createAccessLevel->getCreateResult()) {
                $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Nível de acesso cadastrado com sucesso!</div>";
                $this->result = true;
            }else {
                $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Nível de acesso não cadastrado!</div>";
                $this->result = false;
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Nível de acesso não cadastrado!</div>";
            $this->result = false;
        }
    }

    private function viewLastAccessLevel()
    {
         $viewLastAccessLevel= new \App\adms\Models\helper\AdmsRead();
         $viewLastAccessLevel->fullRead("SELECT order_levels FROM adms_access_levels ORDER BY order_levels DESC");
         $this->databaseResult=$viewLastAccessLevel->getReadingResult();
         if($this->databaseResult) {
            $this->data['order_levels'] =$this->databaseResult[0]['order_levels'] + 1;
            return true;
         }else {
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Nível de acesso não cadastrado!</div>";
             return false;

         }

    }
}

?>