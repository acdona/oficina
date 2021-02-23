<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe AdmsEditPerfilPassword responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsEditPerfilPassword
{

    private $resultadoBd;
    private bool $resultado;
    private $dadosExitVal;
    private array $dados;

    function getResultadoBd() {
        return $this->resultadoBd;
    }

    function getResultado() {
        return $this->resultado;
    }
 
    public function viewPerfilPassword()
    {
       $viewPerfil = new \App\adms\Models\helper\AdmsRead();
       $viewPerfil->fullRead("SELECT id 
                              FROM adms_users 
                              WHERE id=:id 
                              LIMIT :limit ", "id={$_SESSION['user_id']}&limit=1");
        $this->resultadoBd = $viewPerfil->getResult();
        if($this->resultadoBd) {
                $this->resultado = true;

        } else { 
            $_SESSION['msg'] = "Erro: Usuário não encontrado!<br>" ;
            $this->resultado = false;
        }
    }

    public function update(array $dados) {
        $this->dados = $dados;
   
        $valCampoVazio = new \App\adms\Models\helper\AdmsValCampoVazio();
        $valCampoVazio->validarDados($this->dados);
        if ($valCampoVazio->getResultado()) {
            $this->valInput();
        } else {
            $this->resultado = false;
        }
    }
    private function valInput() {
        $valPassword = new \App\adms\Models\helper\AdmsValPassword();
        $valPassword->validarPassword($this->dados['password']);

        if ($valPassword->getResultado() ) {
            $this->edit();
           
        } else {
            $this->resultado = false;
        }
    }

    private function edit() {
        $this->dados['password'] = password_hash($this->dados['password'], PASSWORD_DEFAULT);
        $this->dados['modified'] = date("Y-m-d H:i:s");

        $upUser = new \App\adms\Models\helper\AdmsUpdate();
        $upUser->exeUpdate("adms_users", $this->dados, "WHERE id =:id", "id={$_SESSION['user_id']}");

        if ($upUser->getResult()) {
            $_SESSION['msg'] = "Senha editada com sucesso!<br>";
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "Erro: Senha não editada!<br>";
            $this->resultado = false;
        }
    }

}

?>