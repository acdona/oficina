<?php
namespace App\sts\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * StsEditAccountCategory Model responsible for editing an account category.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsEditAccountCategory
{

    private $resultadoBd;
    private bool $resultado;
    private int $id;
    private array $dados;

    function getResultado(): bool {
        return $this->resultado;
    }

    function getResultadoBd() {
        return $this->resultadoBd;
    }

    public function viewAccountCategory($id) {
        $this->id = (int) $id;
        $viewAccountCategory = new \App\sts\Models\helper\StsRead();
        $viewAccountCategory->fullRead("SELECT id, name
                FROM sts_account_categories
                WHERE id=:id
                LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultadoBd = $viewAccountCategory->getResult();
        if ($this->resultadoBd) {
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "Categoria não encontrada!<br>";
            $this->resultado = false;
        }
    }

    public function update(array $dados) {
        $this->dados = $dados;

        $valCampoVazio = new \App\sts\Models\helper\StsValCampoVazio();
        $valCampoVazio->validarDados($this->dados);
        if ($valCampoVazio->getResultado()) {
            $this->valInput();
        } else {
            $this->resultado = false;
        }
    }

    private function valInput() {
        $valAccountCategory = new \App\sts\Models\helper\StsValAccountCategory();
        $valAccountCategory->validarAccountCategory($this->dados['name']);
      
        if ($valAccountCategory->getResultado()) {
            $this->edit();
        } else {
            $this->resultado = false;
        }
    }


    private function edit() {
        $this->dados['modified'] = date("Y-m-d H:i:s");

        $upAccountCategory = new \App\sts\Models\helper\StsUpdate();
        $upAccountCategory->exeUpdate("sts_account_categories", $this->dados, "WHERE id =:id", "id={$this->dados['id']}");

        if ($upAccountCategory->getResult()) {
        
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Categoria editada com sucesso!</div>";
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Categoria não editada!</div>";
            
            $this->resultado = false;
        }
    }

}

?>