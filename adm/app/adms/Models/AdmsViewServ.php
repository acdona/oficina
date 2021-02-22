<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe AdmsViewServ responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsViewServ
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
    
    

    public function viewServ($id) {

        $this->id = (int) $id;
        $viewServ = new \App\adms\Models\helper\AdmsRead();
        $viewServ->fullRead("SELECT id, title_serv, subtitle_serv, icone_one_serv, title_one_serv, desc_one_serv, icon_two_serv, title_two_serv, desc_two_serv, icon_three_serv, title_three_serv, desc_three_serv 
                             FROM sts_homes_services 
                             LIMIT :limit", "id={$this->id}&limit=1"); 
        
        $this->resultadoBd = $viewServ->getResult();

        if($this->resultadoBd){
            $this->resultado = true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Serviço não encontrado</div>";
            $this->resultado = false;
        }
    }

}

?>