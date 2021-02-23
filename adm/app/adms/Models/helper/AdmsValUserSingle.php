<?php
namespace App\adms\Models\helper;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe AdmsValUserSingle responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsValUserSingle
{

    private string $userName;
    private $edit;
    private $id;
    private bool $resultado;
    private $resultadoBd;

    function getResultado(): bool {
        return $this->resultado;
    }

    public function validarUserSingle($username, $edit = null, $id = null) {
        $this->userName = $username;
        $this->edit = $edit;
        $this->id = $id;
   
        $valUserSingle = new \App\adms\Models\helper\AdmsRead();
        if (($this->edit == true) AND (!empty($this->id))) {
            $valUserSingle->fullRead("SELECT id 
                                      FROM adms_users 
                                      WHERE (username =:username OR email =:email) AND
                                      id <>:id
                                      LIMIT :limit", 
                                      "username={$this->userName}&email={$this->userName}&id={$this->id}&limit=1");
        }ELSE {
            $valUserSingle->fullRead("SELECT id FROM adms_users WHERE username =:username LIMIT :limit", "username={$this->userName}&limit=1");
        }

        

        $this->resultadoBd = $valUserSingle->getResult();
        if (!$this->resultadoBd) {
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "Erro: Este usuário já está cadastrado!";
            $this->resultado = false;
        }
    }

}

?>