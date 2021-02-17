<?php
namespace App\sts\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * StsDeleteColor Model responsible for deleting a color.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsDeleteColor
{

    private bool $resultado;
    private int $id;
    private $resultadoBd;

    function getResultado(): bool {
        return $this->resultado;
    }
    
    public function deleteColor($id) {
        $this->id = (int) $id;
        /**Verifica se a Cor existe E se alguma situação do usuário está utilizando a mesma */
        if ($this->viewColor() AND $this->checkSitsUser()) {
            $deleteColor = new \App\sts\Models\helper\StsDelete();
            $deleteColor->exeDelete("sts_colors", "WHERE id =:id", "id={$this->id}");
            
            if ($deleteColor->getResult()) {
                $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Cor apagada com sucesso!</div>";
                $this->resultado = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Cor não apagada!</div>";
                $this->resultado = false;
            }
        } else {
            $this->resultado = false;
        }
    }

    /**Verifica se a Cor existe */
    private function viewColor() {
        $viewColor = new \App\sts\Models\helper\StsRead();
        $viewColor->fullRead("SELECT id FROM sts_colors 
                WHERE id=:id
                LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultadoBd = $viewColor->getResult();
        var_dump($this->resiltadoBd);
        if ($this->resultadoBd) {
            return true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Cor não encontrada!</div>";
            return false;
        }
    }
    /** Verifica se alguma situação do usuário está usando a cor a ser apagada */
    private function checkSitsUser() {
        $checkSitsUser = new \App\sts\Models\helper\StsRead();
        $checkSitsUser->fullRead("SELECT id FROM sts_sits_users WHERE sts_color_id=:sts_color_id LIMIT :limit", "sts_color_id={$this->id}&limit=1");
     
        if($checkSitsUser->getResult()){
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: A cor não pode ser apagada, ela está sendo usada por um situação do usuário!</div>";
            return false;
        }else{
            return true;
        }
    }

}

?>