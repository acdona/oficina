<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsAddSitsUser Model. Responsible for adding user's situation.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsAddSitsUser
{

    private array $data;
    private bool $result;
    private $listRegistryAdd;

    function getResult() {
        return $this->result;
    }

    public function create(array $data = null) {
        $this->data = $data;
        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->validateData($this->data);
        if ($valEmptyField->getResult()) {
            $this->add();
        } else {
            $this->result = false;
        }
    }

    private function add() {
        $this->data['created'] = date("Y-m-d H:i:s");
        
        $createUser = new \App\adms\Models\helper\AdmsCreate();
        $createUser->exeCreate("adms_sits_users", $this->data);

        if ($createUser->getCreateResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Situação para usuário cadastrado com sucesso!</div>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Situação para usuário não cadastrado com sucesso. Tente mais tarde!</div>";
            $this->result = false;
        }
    }
    
    public function listSelect() {
        $list = new \App\adms\Models\helper\AdmsRead();
        $list->fullRead("SELECT id id_cor, name name_cor FROM adms_colors ORDER BY name ASC");
        $registry['cor'] = $list->getReadingResult();
        
        $this->listRegistryAdd = ['cor' => $registry['cor']];
        
        return $this->listRegistryAdd;
    }


}

?>