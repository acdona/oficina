<?php
namespace App\sts\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * Model StsAddUser responsável por cadastrar Usuário
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsAddUser
{
    /** @var array $dados Recebe os dados do banco de dados */
    private array $dados;
    /** @var bool $resultado Verifica se os dados não estão vazios */
    private bool $resultado;

    function getResultado() {
        return $this->resultado;
    }
    /** Função create para adicionar usuários
     * @param $dados
     */
    public function create(array $dados = null) {
        $this->dados = $dados;
        /** Instancia o helper para validar campo vazio */
        $valCampoVazio = new \App\sts\Models\helper\StsValCampoVazio();
        /** Valida os dados enviados pela control */
        $valCampoVazio->validarDados($this->dados);
        /** Se for verdadeito carregar o validar usuário */
        if ($valCampoVazio->getResultado()) {
            $this->valInput();
        } else {
            $this->resultado = true;
        }
    }

    /** Função que valida se o usuário já existe na tabela */
    private function valInput() {
        /** Instancia o helper que verifica se usuário já existe */
        $valUser = new \App\sts\Models\helper\StsValUser();
        /** Verifica se o usuáro já existe */
        $valUser->validarUser($this->dados['name']);
      
        /** Se existe o usuário carrega a função add */
        if ($valUser->getResultado()) {
            $this->add();
        } else { /** Se não existe  */
            $this->resultado = false;
        }
    }

    private function add() {
        $this->dados['name'] = $this->dados['name'];
        $this->dados['created'] = date("Y-m-d H:i:s");
        $createUser = new \App\sts\Models\helper\StsCreate();
        $createUser->exeCreate("sts_user", $this->dados);

        if ($createUser->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Usuário cadastrado com sucesso!</div>";
            $this->resultado = true;
        }else {
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Usuário não cadastrado</div>";
            $this->resultado = false;
        }

    }
}

?>