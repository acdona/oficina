<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe AdmsViewConfEmails responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsViewConfEmails
{

    private $resultadoBd;
    private bool $resultado;
    private int $id;

    function getResultado(): bool {
        return $this->resultado;
    }
    
    function getResultadoBd() {
        return $this->resultadoBd;
    }

    public function viewConfEmails($id) {
        $this->id = (int) $id;
        $viewConfEmails = new \App\adms\Models\helper\AdmsRead();
        $viewConfEmails->fullRead("SELECT id, title, name, email, host, username, smtpsecure, port
                FROM adms_confs_emails 
                WHERE id=:id
                LIMIT :limit", "id={$this->id}&limit=1");
                
        $this->resultadoBd = $viewConfEmails->getResult();
        if($this->resultadoBd){
            $this->resultado = true;
        }else{
            $_SESSION['msg'] = "E-mail não encontrado!<br>";
            $this->resultado = false;
        }
    }


}

?>