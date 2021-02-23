<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe AdmsUpdatePassword responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsUpdatePassword
{

    private $resultadoBd;
    private bool $resultado;
    private string $chave;
    private array $saveData;
    private array $dados;

    function getResultado() {
        return $this->resultado;
    }

    public function validarChave($chave) {
        $this->chave = $chave;

        $viewChaveUpPass = new \App\adms\Models\helper\AdmsRead();
        $viewChaveUpPass->fullRead("SELECT id
                FROM adms_users
                WHERE recover_password =:recover_password
                LIMIT :limit",
                "recover_password={$this->chave}&limit=1");

        $this->resultadoBd = $viewChaveUpPass->getResult();
        if ($this->resultadoBd) {
            $this->resultado = true;
            return true;
        } else {
            $_SESSION['msg'] = "Erro: Link inválido, solicite novo link <a href='" . URLADM . "recover-password/index'>clique aqui</a>!";
            $this->resultado = false;
            return false;
        }
    }

    public function editPassword(array $dados) {
        $this->dados = $dados;
        $valCampoVazio = new \App\adms\Models\helper\AdmsValCampoVazio();
        $valCampoVazio->validarDados($this->dados);
        if($valCampoVazio->getResultado()){            
            $this->valInput();
        }else{
            $this->resultado = false;
        }
    }
    
    private function valInput() {
        $valPassword= new \App\adms\Models\helper\AdmsValPassword();
        $valPassword->validarPassword($this->dados['password']);
        if($valPassword->getResultado()){
            //echo "Continuar alteração da senha<br>";
            //$this->resultado = true;
            if($this->validarChave($this->dados['chave'])){
                $this->updatePassword();
            }else{
                $_SESSION['msg'] = "Erro: Link inválido, solicite novo link <a href='" . URLADM . "recover-password/index'>clique aqui</a>!";
            $this->resultado = false;
            }            
        }else{
            $this->resultado = false;
        }
    }
    
    private function updatePassword() {
        $this->saveData['recover_password'] = null;
        $this->saveData['password'] = password_hash($this->dados['password'], PASSWORD_DEFAULT);
        $this->saveData['modified'] = date("Y-m-d H:i:s");
        
        $upPassword = new \App\adms\Models\helper\AdmsUpdate();
        $upPassword->exeUpdate("adms_users", $this->saveData, "WHERE id=:id", "id={$this->resultadoBd[0]['id']}");
        if($upPassword->getResult()){
            $_SESSION['msg'] = "Senha atualizada com sucesso!<br>";
            $this->resultado = true;
        }else{
            $_SESSION['msg'] = "Erro: Senha não atualizada, tente novamente!<br>";
            $this->resultado = false;            
        }
        
    }

}

?>