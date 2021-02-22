<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * EditColor Controller responsible for editing a color.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class EditColor
{
    /** @var array $dados Recebe os dados que devem ser enviados para VIEW */
    private array $dados=[];

    /** @var array $dadosForm Recebe os dados do formulário */
    private $dadosForm;

    /** @var int $id Recebe um inteiro referente ao  ID da categoria. */
    private $id;

    /** Função index que recebe  id da cor */
    public function index($id) {
        $this->id = (int) $id;

        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        /** Se o id não for vazio e os dados do formulário estiverem vazios */
        if (!empty($this->id) AND (empty($this->dadosForm['EditColor']))) {
            /** Instancia a model */
            $viewColor = new \App\adms\Models\AdmsEditColor();
            /** Carrega viewColor da Model */
            $viewColor->viewColor($this->id);
            if ($viewColor->getResultado()) {
                $this->dados['form'] = $viewColor->getResultadoBd();
                $this->viewColor();
            } else {
                $urlDestino = URL . "list-colors/index";
                header("Location: $urlDestino");
            }
        } else {
            $this->editColor();
        }
    }

    private function viewColor() {       
   
        $carregarView = new \App\adms\core\ConfigView("adms/Views/colors/editColor", $this->dados);
        $carregarView->renderizar();
    }

    private function editColor() {
        if (!empty($this->dadosForm['EditColor'])) {
            unset($this->dadosForm['EditColor']);
            $editColor = new \App\adms\Models\AdmsEditColor();
            $editColor->update($this->dadosForm);
            if ($editColor->getResultado()) {
                $urlDestino = URL . "list-colors/index";
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dadosForm;
                $this->viewColor();
            }
        } else {
            $_SESSION['msg'] = "Cor não encontrada!<br>";
            $urlDestino = URL . "list-colors/index";
            header("Location: $urlDestino");
        }
    }

}

?>