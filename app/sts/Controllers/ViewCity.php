<?php
namespace App\sts\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * ViewCity Controller responsible for viewing a city.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class ViewCity
{
    /** @var int $id Recebe um inteiro referente ao ID da cetagoria */
    private int $id;
    
    /** @var array $dados Recebe os dados que devem ser enviados para VIEW */
    private $dados;

    public function index($id) {
        $this->id = $id;
        
        if (!empty($this->id)) {
            
            $viewCity = new \App\sts\Models\StsViewCity();
            $viewCity->viewCity($this->id);
       
            if ($viewCity->getResultado()) {
                $this->dados['viewCity'] = $viewCity->getResultadoBd();
                $this->viewCity();
            } else {
                $urlDestino = URL . "list-cities/index";
                header("Location: $urlDestino");
            }
        } else {
            $_SESSION['msg'] = "Cidade não encontrada!<br>";
            $urlDestino = URL . "list-cities/index";
            header("Location: $urlDestino");
        }
    }
    
    private function viewCity() {
       
        $carregarView = new \App\sts\core\ConfigView("sts/Views/cities/viewCity", $this->dados);
        $carregarView->renderizar();
    }

}

?>