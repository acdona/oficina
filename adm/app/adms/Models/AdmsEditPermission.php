<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsEditPermission Model. Responsible for editin permissions. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsEditPermission
{

    
    private bool $result;
    private $databaseResult;
    private $id;
    private $data;

    function getResult(): bool {
        return $this->result;
    }

    public function editPermission($id = null) {

        $this->id = (int) $id;
        $viewPermission = new \App\adms\Models\helper\AdmsRead();
        $viewPermission->fullRead("SELECT lev_pag.id, lev_pag.permission
                        FROM adms_levels_pages lev_pag
                        INNER JOIN adms_access_levels AS lev ON lev.id=lev_pag.adms_access_level_id
                        WHERE lev_pag.id =:id
                        AND lev.order_levels >:order_levels
                        LIMIT :limit",
                "id={$this->id}&order_levels=" . $_SESSION['order_levels'] . "&limit=1");
        $this->databaseResult = $viewPermission->getReadingResult();

        if ($this->databaseResult) {
            $this->edit();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Registro não encontrado!</div>";
            $this->result = false;
        }
    }

    private function edit() {
        if ($this->databaseResult[0]['permission'] == 1) {
            $this->data['permission'] = 2;
        } else {
            $this->data['permission'] = 1;
        }
        $this->data['modified'] = date("Y-m-d H:i:s");

        $upPermission = new \App\adms\Models\helper\AdmsUpdate();
        $upPermission->exeUpdate("adms_levels_pages", $this->data, "WHERE id=:id", "id={$this->id}");
        if ($upPermission->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Permissão editada com sucesso!</div>";
            $this->result = false;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Permissão não editada com sucesso!</div>";
            $this->result = false;
        }
    }


}

?>