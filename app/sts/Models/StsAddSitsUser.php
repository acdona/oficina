<?php
namespace App\sts\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe StsAddSitsUser responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsAddSitsUser
{

    private array $dados;
    private bool $resultado;
    private $listRegistryAdd;

    function getResultado() {
        return $this->resultado;
    }

    public function create(array $dados = null) {
        $this->dados = $dados;
        $valCampoVazio = new \App\sts\Models\helper\StsValCampoVazio();
        $valCampoVazio->validarDados($this->dados);
        if ($valCampoVazio->getResultado()) {
            $this->add();
        } else {
            $this->resultado = false;
        }
    }

    private function add() {
        $this->dados['created'] = date("Y-m-d H:i:s");
        
        $createUser = new \App\sts\Models\helper\StsCreate();
        $createUser->exeCreate("sts_sits_users", $this->dados);

        if ($createUser->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Situação para usuário cadastrado com sucesso!</div>";
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Situação para usuário não cadastrado com sucesso. Tente mais tarde!</div>";
            $this->resultado = false;
        }
    }
    
    public function listSelect() {
        $list = new \App\sts\Models\helper\StsRead();
        $list->fullRead("SELECT id id_cor, name name_cor FROM sts_colors ORDER BY name ASC");
        $registry['cor'] = $list->getResult();
        
        $this->listRegistryAdd = ['cor' => $registry['cor']];
        
        return $this->listRegistryAdd;
    }


}

?>