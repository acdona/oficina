<?php
namespace App\sts\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * AddUser Controller responsible for adding an user. 
 * 
 * Específica a versão da classe/função.
 * @version 1.0
 *
 * Específica o autor do código/classe/função.
 * @author Antonio Carlos Doná
 * 
 * Específica o tipo de acesso(public, protected e private).
 * @access public
 *
 * @copyright Específica os direitos autorais.
 * @deprecated Específica elementos que não devem ser usados.
 * @exemple Definir arquivo de exemplo, $path/to/example.php
 * @ignore Igonarar código
 * @internal Documenta função interna do código
 * @link link do código http://www.exemplo.com
 * @see
 * @since
 * @tutorial
 * @name Específica o apelido(alias).
 * @package Específica o nome do pacote pai, isto ajuda na organização das classes.
 * @param Específica os paramêtros muito usado em funções.
 * @return Específica o tipo de retorno muito usado em funções.
 * @subpackage Específica o nome do pacote filho.
 * Inline { @internal
 *
*/
class AddUser
{
    /** @var array $dados Recebe os dados do banco de dados*/
    private array $dados=[];

    /** @var array $dadosForm Recebe os dados do formulário */
    private $dadosForm;

    /**
     * Função index.
     *
     * @return void
     */
    public function index() {
        /** Recebe os dados vindo do formulário */
        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        /** Verifica se os dados do formulário, não está vazio */
        if(!empty($this->dadosForm['AddUser'])){
            /** Se estiver vazio, destrói a variável */
            unset($this->dadosForm['AddUser']);
            /** Instancia a Models para adicionar usuário */
            $createNewUser = new \App\sts\Models\StsAddUser();
            /** Cria novo usuário com os dados do formulário */
            $createNewUser->create($this->dadosForm);
            /** Se retornou verdadeiro o cadastro no banco de dados
             * recarrega a página  */
            if($createNewUser->getResultado()) {
                $urlDestino = URL . "add-user/index";
                header("Location: $urlDestino");
            } else {
                /** Caso falhe, recarrega o formulário */
                $this->dados['form'] = $this->dadosForm;
                $this->viewNewUser();
            }
        } else { /**Se estiver vazio carrega a página */
            $this->viewNewUser();
        }
    }


    /**
     * Função viewNewUser. Carrega o formulário de cadastro
     * com os valores de $dados, para não precisar redigitar
     *
     * @return void
    */
    private function viewNewUser() {  
        /** Carrega a View addUser */
        $carregarView = new \App\sts\core\ConfigView("sts/Views/user/addUser", $this->dados);
        /** Chama na ConfigController o renderizar, para mostrar a view(formulário) */
        $carregarView->renderizar();   
    }

}

?>