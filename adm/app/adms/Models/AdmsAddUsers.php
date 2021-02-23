<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * AdmsAddUsers Model responsible for adding an user.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsAddUsers
{
    /** @var array $dados Recebe os dados do banco de dados */
    private array $dados;

    /** @var bool $resultado Verifica se os dados não estão vazios */
    private bool $resultado;

    /** classificar essas variáveis após implementar o email */
    private string $fromEmail;
    private string $firstName;
    private array $emailData;

    /** @var array $listRegistry Recebe a array para o select situação do usuário */
    private array $listRegistryAdd;

    function getResultado() {
        return $this->resultado;
    }
    /** Função create para adicionar usuários
     * @param $dados
     */
    public function create(array $dados = null) {
        $this->dados = $dados;

        /** Instancia o helper para validar campo vazio */
        $valCampoVazio = new \App\adms\Models\helper\AdmsValCampoVazio();

        /** Valida os dados enviados pela control */
        $valCampoVazio->validarDados($this->dados);

        /** Se for verdadeito carregar o validar usuário */
        if ($valCampoVazio->getResultado()) {
            $this->valInput();
        } else {
            $this->resultado = false;
        }
    }

    /** Função que valida se o usuário já existe na tabela */
    private function valInput() {

        /** Instancia o helper que verifica se email é válido */
        $valEmail = new \App\adms\Models\helper\AdmsValEmail();
        $valEmail->validarEmail($this->dados['email']);

        /** Instancia o helper que verifica se email já existe */
        $valEmailSingle = new \App\adms\Models\helper\AdmsValEmailSingle();
        $valEmailSingle->validarEmailSingle($this->dados['email']);

        /** Instancia o helper que valida a senha */
        $valPassword = new \App\adms\Models\helper\AdmsValPassword();
        $valPassword->validarPassword($this->dados['password']);
             
        /** Instancia o helper que verifica se usuário já existe */
        $valUserSingle = new \App\adms\Models\helper\AdmsValUserSingleLogin();
        $valUserSingle->validarUserSingleLogin($this->dados['username']);
        
        /** Se todas validações deram certo, carrega o add */
        if ($valEmail->getResultado() AND $valEmailSingle->getResultado() AND $valPassword->getResultado() AND $valUserSingle->getResultado()) {
            $this->add();
        } else {
            $this->resultado = false;
        }
    }

    private function add() {
        $this->dados['password'] = password_hash($this->dados['password'], PASSWORD_DEFAULT);
        $this->dados['conf_email'] = password_hash($this->dados['password'] . date("Y-m-d H:i:s"), PASSWORD_DEFAULT);
        $this->dados['created'] = date("Y-m-d H:i:s");

        $createUser = new \App\adms\Models\helper\AdmsCreate();
        $createUser->exeCreate("adms_users", $this->dados);

        if ($createUser->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Usuário cadastrado com sucesso!</div>";
            $this->resultado = true;
        }else {
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Usuário não cadastrado!</div>";
            $this->resultado = false;
        }

    }
    /** Function responsible for retrieving data from the database and returning to the page selection 
     *  Function is same thing what Role
    */
    public function listSelect()
    {
        $list = new \App\adms\Models\helper\AdmsRead();
        /** Serach for situation in the database */
        $list->fullRead("SELECT id id_sit, name name_sit FROM adms_sits_users ORDER by name ASC");
        /** Creates an array of the user situation */
        $registry['sit'] = $list->getResult();
        /** Create a new array of the user situation */
        /** For exemple: If  there was two consults
         *  $list->fullRead("SELECT id id_sit, name name_sit FROM outro ORDER by name ASC");
         *  would be like this :
         *  $registry['outro'] = array('outro', 'banco', 'de', 'dados');
         *  $this->listRegistryAdd = ['sit' => $registry['sit'] ,'outro' => $registry['outro']];
         */
      
        $this->listRegistryAdd = ['sit' => $registry['sit']];
        return $this->listRegistryAdd;
    }
}

?>