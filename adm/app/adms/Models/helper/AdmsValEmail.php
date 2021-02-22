<?php
namespace App\adms\Models\helper;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Helper AdmsValEmail responsável por validar o email.
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
    private bool $resultado;

    function getResultado(): bool {
        return $this->resultado;
    }
    
    public function validarEmail($email) {
        $this->email = $email;
        
        if(filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $this->resultado = true;
        }else{
            $_SESSION['msg'] = "Erro: E-mail inválido!";
            $this->resultado = false;            
        }
    }

}

?>