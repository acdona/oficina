<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * AdmsViewPages Model. Responsible for viewing the pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsViewPages
{

    private $databaseResult;
    private bool $result;
    private int $id;

    function getResult(): bool {
        return $this->result;
    }

    function getDatabaseResult() {
        return $this->databaseResult;
    }

    public function viewPages($id) {
        $this->id = (int) $id;
        $viewPages = new \App\adms\Models\helper\AdmsRead();
        $viewPages->fullRead("SELECT pg.id, pg.controller, pg.method, pg.menu_controller, pg.menu_method, pg.page_name, pg.public, pg.icon, pg.note,
                tpg.type type_tpg, tpg.name name_tpg,
                sit.name name_sit, clr.color name_color
                FROM adms_pages pg
                LEFT JOIN adms_types_pgs AS tpg ON tpg.id=pg.adms_types_pgs_id
                LEFT JOIN adms_sits_pgs AS sit ON sit.id=pg.adms_sits_pgs_id
                INNER JOIN adms_colors AS clr ON clr.id=sit.adms_color_id
                WHERE pg.id=:id
                LIMIT :limit", "id={$this->id}&limit=1");

        $this->databaseResult = $viewPages->getReadingResult();
        if ($this->databaseResult) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Página não encontrado</div>";
            $this->result = false;
        }
    }

}

?>