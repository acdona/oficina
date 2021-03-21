<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsAddColor Model responsible for adding a color.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsAddColor
{

    private array $data;
    private bool $result;

    function getResult() {
        return $this->result;
    }

    public function create(array $data = null) {
        $this->data = $data;
        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->validateData($this->data);

        if ($valEmptyField->getResult()) {
            $this->valInput();
        } else {
            $this->result = false;
        }
    }

    private function valInput() {
        $valColor = new \App\adms\Models\helper\AdmsValColor();
        $valColor->valColor($this->data['name']);
      
        if ($valColor->getResult()) {
            $this->add();
        } else {
            $this->result = false;
        }
    }

    private function add() {
        $this->data['name'] = $this->data['name'];
        $this->data['color'] = $this->data['color'];
        $this->data['created'] = date("Y-m-d H:i:s");
        $createColor = new \App\adms\Models\helper\AdmsCreate();
        $createColor->exeCreate("adms_colors", $this->data);

        if ($createColor->getCreateResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Cor cadastrada com sucesso!</div>";
            $this->result = true;
        }else {
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Cor não cadastrada</div>";
            $this->result = false;
        }

    }
}

?>