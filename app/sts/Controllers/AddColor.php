<?php
namespace App\sts\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * Controller AddColor responsável por cadastrar cor
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AddColor
{
    /** @var array $dados Recebe os dados que devem ser enviados para VIEW */
    private $dados;

    /** @var array $dadosForm Recebe os dados do formulário */
    private $dadosForm;

    public function index() {

        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if(!empty($this->dadosForm['AddColor'])){
            unset($this->dadosForm['AddColor']);
            $createNewColor = new \App\sts\Models\StsAddColor();
            $createNewColor->create($this->dadosForm);
            if($createNewColor->getResultado()) {
                $urlDestino = URL . "add-color/index";
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dadosForm;
                $this->viewNewColor();
            }
        } else {
            $this->viewNewColor();
        }
    }

       private function viewNewColor() {  

            $carregarView = new \App\sts\core\ConfigView("sts/Views/colors/addColor", $this->dados);
            $carregarView->renderizar();   
       }

}

?>