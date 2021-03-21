<?php
namespace Core;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * LoadAdmPageLevel Responsible for checking whether the page is public or restricted.
 * 
 * @author ACD
 */
class LoadAdmPageLevel
{
 
    private string $urlController;
    private string $urlMethod;
    private string $urlParameter;
    private string $class;
    private array $resultPage;
    private array $resultLevelPage;
  
    public function loadPage($urlController = null, $urlMethod = null, $urlParameter = null){
        $this->urlController = $urlController;
        $this->urlMethod = $urlMethod;
        $this->urlParameter = $urlParameter;
        
        $this->searchPage();
 
    }    

    private function searchPage() {
        $searchPage = new \App\adms\Models\helper\AdmsRead();
        $searchPage->fullRead("SELECT pag.id, pag.public,
                typ.type
                FROM adms_pages pag
                INNER JOIN adms_types_pgs AS typ ON typ.id=pag.adms_types_pgs_id
                WHERE pag.controller =:controller
                AND method =:method
                LIMIT :limit",
                "controller={$this->urlController}&method={$this->urlMethod}&limit=1");
        $this->resultPage = $searchPage->getReadingResult();
        if ($this->resultPage) {
            if ($this->resultPage[0]['public'] == 1) {
                $this->class = "\\App\\" . $this->resultPage[0]['type'] . "\\Controllers\\" . $this->urlController;
                $this->loadMethod();
            } else {
                $this->verificarLogin();
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Página não encontrada!</div>";
            $urlRedirect = URLADM . "dashboard/index";
            header("Location: $urlRedirect");
        }
    }

    private function loadMethod() {
        $classLoad = new $this->class();
        if (method_exists($classLoad, $this->urlMethod)) {
            $classLoad->{$this->urlMethod}($this->urlParameter);
        } else {
            die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM . "!<br>");
        }
    }

    private function verificarLogin() {
        if (isset($_SESSION['user_id']) AND isset($_SESSION['user_name']) AND isset($_SESSION['user_email']) AND isset($_SESSION['adms_access_level_id']) AND isset($_SESSION['order_levels'])) {
            $this->searchLevelPage();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Para acessar a página realize o login!</div>";
            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");
        }
    }

    private function searchLevelPage() {
        $searchLevelPage = new \App\adms\Models\helper\AdmsRead();
        $searchLevelPage->fullRead("SELECT id, permission
                FROM adms_levels_pages
                WHERE adms_page_id =:adms_page_id
                AND adms_access_level_id =:adms_access_level_id
                AND permission =:permission
                LIMIT :limit",
                "adms_page_id={$this->resultPage[0]['id']}&adms_access_level_id=" . $_SESSION['adms_access_level_id'] . "&permission=1&limit=1");
        $this->resultLevelPage = $searchLevelPage->getReadingResult();
        if ($this->resultLevelPage) {
            $this->class = "\\App\\" . $this->resultPage[0]['type'] . "\\Controllers\\" . $this->urlController;
            $this->loadMethod();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Sem permissão de acessar a página!</div>";
            $urlRedirect = URLADM . "dashboard/index";
            header("Location: $urlRedirect");
        }
    }

   
} 
?>