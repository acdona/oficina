<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsDeleteColor Model responsible for deleting a color.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsDeleteColor
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
            $deleteColor = new \App\adms\Models\helper\AdmsDelete();
            $deleteColor->exeDelete("adms_colors", "WHERE id =:id", "id={$this->id}");
            
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
        $viewColor = new \App\adms\Models\helper\AdmsRead();
        $viewColor->fullRead("SELECT id FROM adms_colors 
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
        $checkSitsUser = new \App\adms\Models\helper\AdmsRead();
        $checkSitsUser->fullRead("SELECT id FROM adms_sits_users WHERE adms_color_id=:adms_color_id LIMIT :limit", "adms_color_id={$this->id}&limit=1");
     
        if($checkSitsUser->getResult()){
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: A cor não pode ser apagada, ela está sendo usada por um situação do usuário!</div>";
            return false;
        }else{
            return true;
        }
    }

}

?>