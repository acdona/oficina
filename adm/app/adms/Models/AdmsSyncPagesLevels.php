<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsSyncPagesLevels Model. Responsible for the synchronization of page levels.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsSyncPagesLevels
{

    private bool $result;
    private $listLevels;
    private $listPages;
    private int $levelId;
    private int $pageId;
    private int $public;
    private $listLevelPage;
    private $dataLevelPage;
    private $viewLastOrder;

    function getResult(): bool {
        return $this->result;
    }

    public function syncPagesLevels() {
        $listLevels = new \App\adms\Models\helper\AdmsRead();
        $listLevels->fullRead("SELECT id FROM adms_access_levels");
        $this->listLevels = $listLevels->getReadingResult();
        
        if ($this->listLevels) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Permissões sincronizadas com sucesso!</div>";
            $this->listPages();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Nenhum nível de acesso encontrado!</div>";
            $this->result = false;
        }
    }

    private function listPages() {
       
        $listPages = new \App\adms\Models\helper\AdmsRead();
        $listPages->fullRead("SELECT id, public FROM adms_pages");
        $this->listPages = $listPages->getReadingResult();
        
        if ($this->listPages) {
            
            $this->readLevels();
            
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Nenhuma página encontrada!</div>";
            $this->result = false;
        }
    }

    private function readLevels() {
        foreach ($this->listLevels as $level) {
            extract($level);
            $this->levelId = $id;
            
            $this->readPages();
        }
    }

    private function readPages() {
        
        foreach ($this->listPages as $page) {
            extract($page);
            $this->pageId = $id;
            $this->public = $public;
            $this->searchLevelPage();
        }
    }

    private function searchLevelPage() {
        $listLevelPage = new \App\adms\Models\helper\AdmsRead();
        $listLevelPage->fullRead("SELECT id FROM adms_levels_pages
                WHERE adms_access_level_id =:adms_access_level_id 
                AND adms_page_id =:adms_page_id",
                "adms_access_level_id={$this->levelId}&adms_page_id={$this->pageId}");
        $this->listLevelPage = $listLevelPage->getReadingResult();
        if (!$this->listLevelPage) {
            $this->addLevelPermission();
        }
    }

    private function addLevelPermission() {
        $this->dataLevelPage['permission'] = (($this->levelId == 1) OR ( $this->public == 1 )) ? 1 : 2;
        $this->searchLastOrder();
        $this->dataLevelPage['order_level_page'] = $this->viewLastOrder[0]['order_level_page'] + 1;
        $this->dataLevelPage['adms_access_level_id'] = $this->levelId;
        $this->dataLevelPage['adms_page_id'] = $this->pageId;
        $this->dataLevelPage['created'] = date("Y-m-d H:i:s");
        $addAccessLevel = new \App\adms\Models\helper\AdmsCreate();
        $addAccessLevel->exeCreate("adms_levels_pages", $this->dataLevelPage);
        
        if($addAccessLevel->getCreateResult()){
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Permissões sincronizadas com sucesso!</div>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Permissões não sincronizadas com sucesso!</div>";
            $this->result = false;
        }
    }
    
    private function searchLastOrder() {
        $viewLastOrder = new \App\adms\Models\helper\AdmsRead();
        $viewLastOrder->fullRead("SELECT order_level_page, adms_access_level_id 
                                  FROM adms_levels_pages 
                                  WHERE adms_access_level_id =:adms_access_level_id 
                                  ORDER BY order_level_page DESC 
                                  LIMIT :limit", "adms_access_level_id={$this->levelId}&limit=1");
        $this->viewLastOrder = $viewLastOrder->getReadingResult();
        if(!$this->viewLastOrder){
            $this->viewLastOrder[0]['order_level_page'] = 0;
        }
    }
}

?>