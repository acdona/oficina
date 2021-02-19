<?php
namespace App\sts\Models\helper;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Helper StsValEmailSingle responsável por verificar se o email existe no bd
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsValEmailSingle
{

    private string $email;
    private $edit;
    private $id;
    private bool $resultado;
    private $resultadoBd;

    function getResultado(): bool {
        return $this->resultado;
    }

    public function validarEmailSingle($email, $edit = null, $id = null) {
        $this->email = $email;
        $this->edit = $edit;
        $this->id = $id;

        $valEmailSingle = new \App\sts\Models\helper\StsRead();
        if (($this->edit == true) AND (!empty($this->id))) {
            $valEmailSingle->fullRead("SELECT id
                    FROM sts_users
                    WHERE (email =:email OR username =:username) AND
                    id <>:id
                    LIMIT :limit", "email={$this->email}&username={$this->email}&id={$this->id}&limit=1");
        } else {
            $valEmailSingle->fullRead("SELECT id FROM sts_users WHERE email =:email LIMIT :limit", "email={$this->email}&limit=1");
        }

        $this->resultadoBd = $valEmailSingle->getResult();
        if (!$this->resultadoBd) {
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "Erro: Este e-mail já está cadastrado!";
            $this->resultado = false;
        }
    }

}

?>