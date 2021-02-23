<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe AdmsListConfEmails responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsListConfEmails
{

    private $resultadoBd;
    private bool $resultado;

    function getResultado() {
        return $this->resultado;
    }
    
    function getResultadoBd() {
        return $this->resultadoBd;
    }
    
    public function listConfEmails() {

        $listConfEmails = new \App\adms\Models\helper\AdmsRead();
        $listConfEmails->fullRead("SELECT id, title, name, email
                FROM adms_confs_emails
                ORDER BY id DESC");

        $this->resultadoBd = $listConfEmails->getResult();
        if ($this->resultadoBd) {
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "Nenhum e-mail encontrado!<br>";
            $this->resultado = false;
        }
    }

}

?>