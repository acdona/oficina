<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * AdmsAddCategory Model responsible for editing a category.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsAddCategory
{

    private array $dados;
    private bool $resultado;

    function getResultado() {
        return $this->resultado;
    }

    public function create(array $dados = null) {
        $this->dados = $dados;
        $valCampoVazio = new \App\adms\Models\helper\AdmsValCampoVazio();
        $valCampoVazio->validarDados($this->dados);

        if ($valCampoVazio->getResultado()) {
            $this->valInput();
        } else {
            $this->resultado = true;
        }
    }

    private function valInput() {
        $valCategory = new \App\adms\Models\helper\AdmsValCategory();
        $valCategory->validarCategory($this->dados['name']);
      
        if ($valCategory->getResultado()) {
            $this->add();
        } else {
            $this->resultado = false;
        }
    }

    private function add() {
        $this->dados['name'] = $this->dados['name'];
        $this->dados['created'] = date("Y-m-d H:i:s");
        $createCategory = new \App\adms\Models\helper\AdmsCreate();
        $createCategory->exeCreate("adms_categories", $this->dados);

        if ($createCategory->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Categoria cadastrada com sucesso!</div>";
            $this->resultado = true;
        }else {
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Categoria não cadastrada</div>";
            $this->resultado = false;
        }

    }
}

?>