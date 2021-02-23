<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AddUsers Controller responsible for adding an user. 
 * 
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 * 
 * @access public
 *
*/
class AddUsers
{
    /** @var array $dados Recebe os dados do banco de dados*/
    private $dados;

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
            $addUser = new \App\adms\Models\AdmsAddUsers();
            
            /** Cria novo usuário com os dados do formulário */
            $addUser->create($this->dadosForm);

            /** Se retornou verdadeiro o cadastro no banco de dados
             * carrega a página de listar usuários  */
            if($addUser->getResultado()) {
                $urlDestino = URLADM . "list-users/index";
                header("Location: $urlDestino");
            } else {

                /** Caso falhe, recarrega o formulário */
                $this->dados['form'] = $this->dadosForm;
                $this->viewAddUser();
            }
        } else { /**Se estiver vazio carrega a página */
            $this->viewAddUser();
        }
    }

    /**
     * Função viewNewUser. Carrega o formulário de cadastro
     * com os valores de $dados, para não precisar redigitar
     *
     * @return void
    */
    private function viewAddUser() {  
       
        /** instancia a model de criar usuário */
        $listSelect = new \App\adms\Models\AdmsAddUsers();

        /** chama o método para mostrar o select */
        $this->dados['select'] = $listSelect->listSelect();

        /** Carrega a View addUser */
        $carregarView = new \App\adms\core\ConfigView("adms/Views/user/addUser", $this->dados);

        /** Chama na ConfigController o renderizar, para mostrar a view(formulário) */
        $carregarView->renderizar();   
    }

}

?>