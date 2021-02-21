<?php
namespace App\sts\Models\helper;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe StsValPassword responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsValPassword
{

    private string $password;
    private bool $resultado;

    function getResultado(): bool {
        return $this->resultado;
    }

    public function validarPassword($password) {
        $this->password = (string) $password;

        if (stristr($this->password, "'")) {
            $_SESSION['msg'] = "Erro: Caracter ( ' ) utilizado na senha inválido!";
            $this->resultado = false;
        } else {
            if (stristr($this->password, " ")) {
                $_SESSION['msg'] = "Erro: Proibido utilizar espaço em branco no campo senha!";
                $this->resultado = false;
            } else {
                $this->valExtensPassword();
            }
        }
    }

    private function valExtensPassword() {
        if ((strlen($this->password) < 6)) {
            $_SESSION['msg'] = "Erro: A senha deve ter no mínimo 6 caracteres!";
            $this->resultado = false;
        } else {
            $this->valValuePassword();
        }
    }

    private function valValuePassword() {
        if (preg_match('/^(?=.*[0-9])(?=.*[a-zA-Z])[a-zA-Z0-9]{6,}$/', $this->password)) {
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "Erro: A senha deve ter letras e números!";
            $this->resultado = false;
        }
    }


}

?>