<?php
namespace App\adms\Models\helper;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsValEmail Helper. Responsible for validating the email.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsValEmail
{

    private string $email;
    private bool $result;

    function getResult(): bool {
        return $this->result;
    }
    
    public function validateEmail($email) {
        $this->email = $email;
        
        if(filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $this->result = true;
        }else{
            
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: E-mail inválido!</div>";
            $this->result = false;            
        }
    }

}

?>