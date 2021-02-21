<?php
namespace App\sts\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * ViewColor Controller responsible for viewing a color.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class ViewColor
{
    /** @var int $id Recebe um inteiro referente ao ID da cetagoria */
    private int $id;
    
    /** @var array $dados Recebe os dados que devem ser enviados para VIEW */
    private $dados;

    public function index($id) {
        $this->id = $id;
        
        if (!empty($this->id)) {
            
            $viewColor = new \App\sts\Models\StsViewColor();
            $viewColor->viewColor($this->id);
       
            if ($viewColor->getResultado()) {
                $this->dados['viewColor'] = $viewColor->getResultadoBd();
                $this->viewColor();
            } else {
                $urlDestino = URL . "list-colors/index";
                header("Location: $urlDestino");
            }
        } else {
            $_SESSION['msg'] = "Cor não encontrada!<br>";
            $urlDestino = URL . "list-colors/index";
            header("Location: $urlDestino");
        }
    }
    
    private function viewColor() {
       
        $carregarView = new \App\sts\core\ConfigView("sts/Views/colors/viewColor", $this->dados);
        $carregarView->renderizar();
    }

}

?>