<?php
namespace App\sts\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Model StsEditUser responsável por  editar usuário
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsEditUser
{

    private $resultadoBd;
    private bool $resultado;
    private int $id;
    private array $dados;
    private array $dadosExitVal;
    private $listRegistryEdit;

    function getResultado(): bool {
        return $this->resultado;
    }

    function getResultadoBd() {
        return $this->resultadoBd;
    }

    public function viewUser($id) {
        $this->id = (int) $id;
        $viewUser = new \App\sts\Models\helper\StsRead();
        $viewUser->fullRead("SELECT id, name, nickname, email, username, sts_sits_user_id
                FROM sts_users
                WHERE id=:id
                LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultadoBd = $viewUser->getResult();
        if ($this->resultadoBd) {
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Usuário não encontrado!</div>";
            $this->resultado = false;
        }
    }

    public function update(array $dados) {
        $this->dados = $dados;

        $this->dadosExitVal['nickname'] = $this->dados['nickname'];
        unset($this->dados['nickname']);

        $valCampoVazio = new \App\sts\Models\helper\StsValCampoVazio();
        $valCampoVazio->validarDados($this->dados);
        
        if ($valCampoVazio->getResultado()) {
            $this->valInput();
        } else {
            $this->resultado = false;
        }
    }

    private function valInput() {
        $valEmail = new \App\sts\Models\helper\StsValEmail();
        $valEmail->validarEmail($this->dados['email']);

        $valEmailSingle = new \App\sts\Models\helper\StsValEmailSingle();
        $valEmailSingle->validarEmailSingle($this->dados['email'], true, $this->dados['id']);

        $valUserSingle = new \App\sts\Models\helper\StsValUserSingle();
        $valUserSingle->validarUserSingle($this->dados['username'], true, $this->dados['id']);

        if ($valEmail->getResultado() AND $valEmailSingle->getResultado() AND $valUserSingle->getResultado()) {
            //$_SESSION['msg'] = "Editar Usuário!<br>";
            //$this->resultado = false;
            $this->edit();
        } else {
            $this->resultado = false;
        }
    }

    private function edit() {
        $this->dados['nickname'] = $this->dadosExitVal['nickname'];
        $this->dados['modified'] = date("Y-m-d H:i:s");

        $upUser = new \App\sts\Models\helper\StsUpdate();
        $upUser->exeUpdate("sts_users", $this->dados, "WHERE id =:id", "id={$this->dados['id']}");

        if ($upUser->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Usuário editado com sucesso!</div>";
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Usuário não editado!</div>";
            $this->resultado = false;
        }
    }

    public function listSelect() {
        $list = new \App\sts\Models\helper\StsRead();
        $list->fullRead("SELECT id id_sit, name name_sit FROM sts_sits_users ORDER BY name ASC");
        $registry['sit'] = $list->getResult();

        $this->listRegistryEdit = ['sit' => $registry['sit']];

        return $this->listRegistryEdit;
    }

}

?>