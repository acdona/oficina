<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe AdmsViewHome responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsViewHome extends Conn
{

    private object $conn;
    private $dados;
    
    public function viewHome() {
        $this->conn = $this->connect();
        $this->viewTop();
        $this->viewServ();
        $this->viewAcao();
        $this->viewContato();
        return $this->dados;
    }
    xxx
    private function viewTop() {
        $query_home_top = "SELECT title_top, subtitle_top, text_btn_top, link_btn_top, image_top FROM sts_homes_tops LIMIT 1";
        $result_home_top = $this->conn->prepare($query_home_top);
        $result_home_top->execute();
        $this->dados['top'] = $result_home_top->fetch();
    }
    
    private function viewServ() {
        $query_home_serv = "SELECT title_serv, subtitle_serv, icon_one_serv, tittle_one_serv, desc_one_serv, icon_two_serv, title_two_serv, desc_two_serv, icon_three_serv, title_thee_serv, desc_three_serv FROM sts_homes_servs LIMIT 1";
        $result_home_serv = $this->conn->prepare($query_home_serv);
        $result_home_serv->execute();
        $this->dados['serv'] = $result_home_serv->fetch();
    }
    
    private function viewAcao() {
        $query_home_acao = "SELECT title_action, subtitle_action, desc_action, text_btn_action, link_btn_action, image_action FROM sts_homes_actions LIMIT 1";
        $result_home_acao = $this->conn->prepare($query_home_acao);
        $result_home_acao->execute();
        $this->dados['acao'] = $result_home_acao->fetch();
    }
    
    private function viewContato() {
        $query_home_contato = "SELECT title_contact, subtitle_contact, address_contac, phone_contact, email_contact FROM sts_homes_contacts LIMIT 1";
        $result_home_contato = $this->conn->prepare($query_home_contato);
        $result_home_contato->execute();
        $this->dados['contato'] = $result_home_contato->fetch();
    }

}

?>