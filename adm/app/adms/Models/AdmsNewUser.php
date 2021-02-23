<?php
namespace App\adms\Models;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe AdmsNewUser responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsNewUser
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
            $this->resultado = false;
        }
    }
    
    private function valInput() {
        
        
        $valEmail = new \App\adms\Models\helper\AdmsValEmail();
        $valEmail->validarEmail($this->dados['email']);
             
        $valEmailSingle = new \App\adms\Models\helper\AdmsValEmailSingle();
        $valEmailSingle->validarEmailSingle($this->dados['email']);

        $valPassword = new \App\adms\Models\helper\AdmsValPassword();
        $valPassword->validarPassword($this->dados['password']);
        
        $valUserSingleLogin = new \App\adms\Models\helper\AdmsValUserSingleLogin();
        $valUserSingleLogin->validarUserSingleLogin($this->dados['email']);
       
        if($valEmail->getResultado() AND $valEmailSingle->getResultado() AND $valPassword->getResultado() AND $valUserSingleLogin->getResultado()){
      
            $this->add();
            
        }else{
            
            $this->resultado = false;
        }
    }

    private function add() {
        $this->dados['password'] = password_hash($this->dados['password'], PASSWORD_DEFAULT);
        $this->dados['username'] = $this->dados['email'];
        $this->dados['conf_email'] = password_hash($this->dados['password'] . date("Y-m-d H:i:s"), PASSWORD_DEFAULT);
        //$this->dados['adms_sits_user_id'] = 3;
        $this->dados['created'] = date("Y-m-d H:i:s");
    
         $createUser = new \App\adms\Models\helper\AdmsCreate();
        $createUser->exeCreate("adms_users", $this->dados);
        
        if ($createUser->getResult()) {
            
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Usuário cadastrado com sucesso!</div>";
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Usuário não cadastrado!</div>";
            $this->resultado = false;
        }
    }

}

?>