<?php
namespace App\sts\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * Model StsEditColor responsible for editing the color.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsEditColor
{

    /** @var array $resultadoBd Recebe o resultado do banco de dados */
    private array $resultadoBd;

    /** @var bool $resultado Retorna se consulta ao banco de dados funcionou */
    private bool $resultado;

    /** @var int $id Recebe um inteiro do ID  */
    private int $id;

    /** @var array $dados Recebe os dados que devem ser enviados para VIEW */
    private array $dados;

    function getResultado(): bool {
        return $this->resultado;
    }

    function getResultadoBd() {
        return $this->resultadoBd;
    }

    public function viewColor($id) {
        $this->id = (int) $id;
        $viewColor = new \App\sts\Models\helper\StsRead();
        $viewColor->fullRead("SELECT id, name, color
                FROM sts_colors
                WHERE id=:id
                LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultadoBd = $viewColor->getResult();
        if ($this->resultadoBd) {
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "Cor não encontrada!<br>";
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
        $valColor = new \App\sts\Models\helper\StsValColor();
        $valColor->valColor($this->dados['name']);
        
        if ($valColor->getResultado()) {
            $this->edit();
        } else {
            $this->resultado = false;
        }
    }


    private function edit() {
        $this->dados['modified'] = date("Y-m-d H:i:s");

        $upColor = new \App\sts\Models\helper\StsUpdate();
        $upColor->exeUpdate("sts_colors", $this->dados, "WHERE id =:id", "id={$this->dados['id']}");

        if ($upColor->getResult()) {
        
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Cor editada com sucesso!</div>";
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Cor não editada!</div>";
            
            $this->resultado = false;
        }
    }

}

?>