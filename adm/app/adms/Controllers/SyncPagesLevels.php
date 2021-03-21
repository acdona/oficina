<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * SyncPagesLevels Controller. Responsible for the synchronization of page levels.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class SyncPagesLevels
{

    public function index() {
        $syncPagesLevels= new \App\adms\Models\AdmsSyncPagesLevels();
        $syncPagesLevels->syncPagesLevels();     
        
        $urlRedirect = URLADM . "list-access-levels/index";
        header("Location: $urlRedirect");
       
   }

}

?>