<?php
namespace App\adms\Models\helper;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsButton Helper. Responsible for turning the buttons on/off.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsButton
{

    private $result;
    private $data;

    public function buttonPermission(array $data) {
        $this->data = $data;

        foreach ($this->data as $key => $button) {
            extract($button);  
         
            $viewButton = new \App\adms\Models\helper\AdmsRead();
            $viewButton->fullRead("SELECT pag.id id_pag 
                                   FROM adms_pages pag 
                                   INNER JOIN adms_levels_pages AS lev_pag ON lev_pag.adms_page_id=pag.id 
                                   WHERE        pag.menu_controller =:menu_controller 
                                   AND          pag.menu_method =:menu_method 
                                   AND          lev_pag.permission = 1 
                                   AND          lev_pag.adms_access_level_id =:adms_access_level_id 
                                   LIMIT :limit","menu_controller=$menu_controller&menu_method=$menu_method&adms_access_level_id=" . $_SESSION['adms_access_level_id']."&limit=1");
                                   
        
            if($viewButton->getReadingResult()){
                $this->result[$key] = true;
            }else{
                $this->result[$key] = false;
            }
        }
       return $this->result;
    }

}

?>