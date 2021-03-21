<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsLogin Models responsible for login 
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

    private array $data;
    private $databaseResult;
    private bool $result = false;
    
    function getResult(): bool {
        return $this->result;
    }

    function getDatabaseResult() {
        return $this->databaseResult;
    }

    public function login(array $data=null) {
        $this->data = $data;
             
        $viewUser = new \App\adms\Models\helper\AdmsRead();
        $viewUser->fullRead("SELECT usu.id, usu.name, usu.nickname, usu.email, usu.password, usu.adms_sits_user_id, usu.image, lev.id id_lev, lev.order_levels
                              FROM adms_users usu
                              INNER JOIN adms_access_levels As lev ON lev.id=usu.adms_access_level_id
                              WHERE usu.username =:username OR usu.email =:email
                              LIMIT :limit",
                              "username={$this->data['username']}&email={$this->data['username']}&limit=1");
                          
      
        $this->databaseResult = $viewUser->getReadingResult();
      
        if($this->databaseResult){
            $this->valEmailPerm();
            
           
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Usuário não encontrado</div>";
            $this->result = false;
        }
          
    }

    private function valEmailPerm() {
       
        if ($this->databaseResult[0]['adms_sits_user_id'] == 3) {
            
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Necessário confirmar o e-mail, solicite novo e-mail <a href='" . URLADM . "new-conf-email/index'>clique aqui</a>!</div>";
            $this->result = false;
        } elseif ($this->databaseResult[0]['adms_sits_user_id'] == 5) {
            
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: E-mail descadastrado, entre em contato com a empresa!</div>";
            $this->result = false;
        } elseif ($this->databaseResult[0]['adms_sits_user_id'] == 2) {
            
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: E-mail inativo, entre em contato com a empresa!</div>";
            $this->result = false;
        } else {
            $this->validatePassword();
        }
    }
    
    private function validatePassword() {

        if(password_verify($this->data['password'], $this->databaseResult[0]['password'])){
            
            $_SESSION['user_id'] = $this->databaseResult[0]['id'];
            $_SESSION['user_name'] = $this->databaseResult[0]['name'];
            $_SESSION['user_email'] = $this->databaseResult[0]['email'];
            $_SESSION['user_nickname'] = $this->databaseResult[0]['nickname'];
            $_SESSION['user_image'] = $this->databaseResult[0]['image'];
            $_SESSION['adms_access_level_id'] = $this->databaseResult[0]['id_lev'];
            $_SESSION['order_levels'] = $this->databaseResult[0]['order_levels'];
          
            $this->result = true;
        }else{
            $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro: Usuário ou senha incorreta!</div>';
            $this->result = false;
        }
    }
}

?>