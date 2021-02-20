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


    /**
     * Instancia a classe genérica no helper responsável em buscar os registro no banco de dados.
     * Possui a QUERY responsável em buscar os registros no BD.
     * @return array Retorna o registro do banco de dados com informações para página Home
     */
    public function index(): array {
        $this->viewTop();
 
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
    
   
}
?>