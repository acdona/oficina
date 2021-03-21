<?php

namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 *  AdmsViewFormLevel Model. Responsible for viewing the form level.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsViewFormLevel
{
    
    private $databaseResult;
    private bool $result;

    function getResult(): bool {
        return $this->result;
    }

    function getDatabaseResult() {
        return $this->databaseResult;
    }

    public function viewFormLevel() {
       
        $viewFormLevel = new \App\adms\Models\helper\AdmsRead();
        $viewFormLevel->fullRead("SELECT form.id, form.adms_access_level_id,
                lev.name name_lev
                FROM adms_levels_forms form
                INNER JOIN adms_access_levels AS lev ON lev.id=form.adms_access_level_id
                LIMIT :limit", "limit=1");

        $this->databaseResult = $viewFormLevel->getReadingResult();
        if ($this->databaseResult) {
            $this->result = true;
           
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Nível de acesso, para formulário novo usuário, não encontrado!</div>";
            $this->result = false;
        }
    }
}