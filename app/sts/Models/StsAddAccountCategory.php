<?php
namespace App\sts\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * Model StsAddAccountCategory responsável por cadastrar Categoria
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsAddAccountCategory
{

    private array $dados;
    private bool $resultado;

    function getResultado() {
        return $this->resultado;
    }

    public function create(array $dados = null) {
        $this->dados = $dados;
        $valCampoVazio = new \App\sts\Models\helper\StsValCampoVazio();
        $valCampoVazio->validarDados($this->dados);

        if ($valCampoVazio->getResultado()) {
            $this->valInput();
        } else {
            $this->resultado = true;
        }
    }

    private function valInput() {
        $valAccountCategory = new \App\sts\Models\helper\StsValAccountCategory();
        $valAccountCategory->validarAccountCategory($this->dados['name']);
      
        if ($valAccountCategory->getResultado()) {
            $this->add();
        } else {
            $this->resultado = false;
        }
    }

    private function add() {
        $this->dados['name'] = $this->dados['name'];
        $this->dados['created'] = date("Y-m-d H:i:s");
        $createAccountCategory = new \App\sts\Models\helper\StsCreate();
        $createAccountCategory->exeCreate("sts_account_categories", $this->dados);

        if ($createAccountCategory->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Categoria cadastrada com sucesso!</div>";
            $this->resultado = true;
        }else {
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Categoria não cadastrada</div>";
            $this->resultado = false;
        }

    }
}

?>