<?php
namespace App\sts\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Model StsEditSitsUser responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsEditSitsUser
{

    private $resultadoBd;
    private bool $resultado;
    private int $id;
    private array $dados;
    private $listRegistryEdit;

    function getResultado(): bool {
        return $this->resultado;
    }

    function getResultadoBd() {
        return $this->resultadoBd;
    }

    public function viewSitsUser($id) {
        $this->id = (int) $id;
        $viewSitsUser = new \App\sts\Models\helper\StsRead();
        $viewSitsUser->fullRead("SELECT id, name, sts_color_id
                FROM sts_sits_users
                WHERE id=:id
                LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultadoBd = $viewSitsUser->getResult();
        if ($this->resultadoBd) {
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Situação de usuário não encontrado!</div>";
            $this->resultado = false;
        }
    }

    public function update(array $dados) {
        $this->dados = $dados;

        $valCampoVazio = new \App\sts\Models\helper\StsValCampoVazio();
        $valCampoVazio->validarDados($this->dados);
        if ($valCampoVazio->getResultado()) {
            $this->edit();
        } else {
            $this->resultado = false;
        }
    }

    private function edit() {
        $this->dados['modified'] = date("Y-m-d H:i:s");

        $upUser = new \App\sts\Models\helper\StsUpdate();
        $upUser->exeUpdate("sts_sits_users", $this->dados, "WHERE id =:id", "id={$this->dados['id']}");

        if ($upUser->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Situação para usuário editado com sucesso!</div>";
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Situação para usuário não editado com sucesso!</div>";
            $this->resultado = false;
        }
    }
    
    public function listSelect() {
        $list = new \App\sts\Models\helper\StsRead();
        $list->fullRead("SELECT id id_cor, name name_cor FROM sts_colors ORDER BY name ASC");
        $registry['cor'] = $list->getResult();
        
        $this->listRegistryEdit = ['cor' => $registry['cor']];
        
        return $this->listRegistryEdit;
    }


}

?>