<?php
namespace App\sts\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * Model StsAddColor responsável por cadastrar Cor
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsAddColor
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
        $valColor = new \App\sts\Models\helper\StsValColor();
        $valColor->valColor($this->dados['name']);
      
        if ($valColor->getResultado()) {
            $this->add();
        } else {
            $this->resultado = false;
        }
    }

    private function add() {
        $this->dados['name'] = $this->dados['name'];
        $this->dados['color'] = $this->dados['color'];
        $this->dados['created'] = date("Y-m-d H:i:s");
        $createColor = new \App\sts\Models\helper\StsCreate();
        $createColor->exeCreate("sts_colors", $this->dados);

        if ($createColor->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Cor cadastrada com sucesso!</div>";
            $this->resultado = true;
        }else {
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Cor não cadastrada</div>";
            $this->resultado = false;
        }

    }
}

?>