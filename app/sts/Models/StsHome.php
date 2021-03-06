<?php
namespace App\sts\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * StsFooter Model responsible for the home page.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsHome
{
    /** @var array $data Recebe o registro do banco de dados */
    private array $data;
    /** @var array $dataTop Recebe o registro do banco de dados relacionado ao topo da página */
    private array $dataTop;
    /** @var array $dataServ Recebe o registro do banco de dados relacionado aos serviços */
    private array $dataServ;
    /** @var array $dataAction Recebe o registro do banco de dados relacionado a ação */
    private array $dataAction;
    /** @var array $dataDet Recebe o registro do banco de dados relacionado a detalhes do serviço */
    private array $dataDet;


    /**
     * Instancia a classe genérica no helper responsável em buscar os registro no banco de dados.
     * Possui a QUERY responsável em buscar os registros no BD.
     * @return array Retorna o registro do banco de dados com informações para página Home
     */
    public function index(): array {
        $this->viewTop();
        $this->viewTop();
        $this->viewServ();
        $this->viewAction();
        $this->viewDet();
 
        return $this->data;

    }

    private function viewTop() {
        $viewTop = new \App\sts\Models\helper\StsRead();
        $viewTop->fullRead("SELECT id, title_top, description_top, link_btn_top, txt_btn_top, image_top
                FROM sts_homes_tops
                LIMIT :limit", "limit=1");
        $this->dataTop = $viewTop->getResult();
        $this->data['top'] = $this->dataTop[0];
    }
    
    private function viewServ() {
        $viewServ = new \App\sts\Models\helper\StsRead();
        $viewServ->fullRead("SELECT id, title_serv, description_serv, icon_one_serv, title_one_serv, description_one_serv, icon_two_serv, title_two_serv, description_two_serv, icon_three_serv, title_three_serv, description_three_serv
                FROM sts_homes_servs
                LIMIT :limit", "limit=1");
        $this->dataServ = $viewServ->getResult();
        $this->data['serv'] = $this->dataServ[0];
    }
    
    private function viewAction() {
        $viewAction = new \App\sts\Models\helper\StsRead();
        $viewAction->fullRead("SELECT id, title_action, subtitle_action, description_action, link_btn_action, txt_btn_action, image_action
                FROM sts_homes_actions
                LIMIT :limit", "limit=1");
        $this->dataAction = $viewAction->getResult();
        $this->data['action'] = $this->dataAction[0];
    }
    
    private function viewDet() {
        $viewDet = new \App\sts\Models\helper\StsRead();
        $viewDet->fullRead("SELECT id, title_det, subtitle_det, description_det, image_det
                FROM sts_homes_dets
                LIMIT :limit", "limit=1");
        $this->dataDet = $viewDet->getResult();
        $this->data['det'] = $this->dataDet[0];
    }
}
?>