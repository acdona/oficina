<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsError Models Responsible for errorpage 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsError
{

    /** @var array $dataError Receives data that is returned from the database */
    private array $dataError;

    /**
     * @method view Responsible for loading error records from the database.
     */
    public function view() {
        
        // $viewError = new \App\adms\Models\helper\AdmsRead();
        // $viewError->fullRead("SELECT title_error, description, image_error
        //         FROM adms_errors
        //         LIMIT :limit", "limit=1");
        // $this->dataError = $viewError->getResult();
        // return $this->dataError[0];
        echo "Passou pela Models de Erro!";
        return;
    }

}

?>
    
