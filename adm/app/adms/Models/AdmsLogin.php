<?php
namespace App\adms\Models;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe AdmsLogin responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsLogin extends helper\AdmsConn
{

    private array $dados;
    private $resultadoBd;
    private bool $resultado = false;
    
    function getResultado(): bool {
        return $this->resultado;
    }

    function getResultadoBd() {
        return $this->resultadoBd;
    }

    public function login(array $dados=null) {
        $this->dados = $dados;
    
        
        $viewUser = new \App\adms\Models\helper\AdmsRead();
        $viewUser->fullRead("SELECT id, name, nickname, email, password, image 
                              FROM adms_users
                              WHERE username =:username OR email =:email
                              LIMIT :limit",
                              "username={$this->dados['username']}&email={$this->dados['username']}&limit=1");
                          
      
        $this->resultadoBd = $viewUser->getResult();
      
         
        if($this->resultadoBd){
            $this->validarSenha();

           
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Usuário não encontrado</div>";
            $this->resultado = false;
        }
          
    }
    
    private function validarSenha() {
  
        if(password_verify($this->dados['password'], $this->resultadoBd[0]['password'])){
            $_SESSION['user_id'] = $this->resultadoBd[0]['id'];
            $_SESSION['user_name'] = $this->resultadoBd[0]['name'];
            $_SESSION['user_email'] = $this->resultadoBd[0]['email'];
            $_SESSION['user_nickname'] = $this->resultadoBd[0]['nickname'];
            $_SESSION['user_image'] = $this->resultadoBd[0]['image'];
            $this->resultado = true;
        }else{
            $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro: Usuário ou senha incorreta!</div>';
            $this->resultado = false;
        }
    }


}

?>