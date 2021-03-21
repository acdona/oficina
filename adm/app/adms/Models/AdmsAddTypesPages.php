<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsAddTypesPages Model. Responsible for adding the tupes of pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsAddTypesPages
{

    private array $data;
    private array $dataExitVal;
    private bool $result;
    private $databaseResult;

    function getResult(): bool {
        return $this->result;
    }

    public function create(array $data = null) {
        $this->data = $data;

        $this->dataExitVal['note'] = $this->data['note'];
        unset($this->data['note']);

        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->validateData($this->data);
        if ($valEmptyField->getResult()) {
            $this->add();
        } else {
            $this->result = false;
        }
    }

    private function add() {
        if ($this->viewLastTypesPages()) {
            $this->data['note'] = $this->dataExitVal['note'];
            $this->data['created'] = date("Y-m-d H:i:s");

            $createTypePage = new \App\adms\Models\helper\AdmsCreate();
            $createTypePage->exeCreate("adms_types_pgs", $this->data);

            if ($createTypePage->getCreateResult()) {
                $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Tipo de página cadastrado com sucesso!</div>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Tipo de página não cadastrado com sucesso. Tente mais tarde!</div>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }

    private function viewLastTypesPages() {
        $viewLastTypesPages = new \App\adms\Models\helper\AdmsRead();
        $viewLastTypesPages->fullRead("SELECT order_type_pg FROM adms_types_pgs ORDER BY order_type_pg DESC");
        $this->databaseResult = $viewLastTypesPages->getReadingResult();
        if ($this->databaseResult) {
            $this->data['order_type_pg'] = $this->databaseResult[0]['order_type_pg'] + 1;
            return true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Tipo de página não cadastrado com sucesso. Tente mais tarde!</div>";
            return false;
        }
    }

}

?>