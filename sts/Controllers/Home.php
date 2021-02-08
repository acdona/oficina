<?php
namespace App\sts\Controllers;

if (!defined('48b5t9')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Controller Home responsável pelo carregamengto da página inicial
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class Home
{
    private array $dados;

    public function index(){

        $home = new \App\sts\Models\StsHome();
        $home->index();
        
        $this->dados=[];
        $carregarView = new \Core\ConfigView("sts/Views/home/home",$this->dados);
        $carregarView->renderizar();
    }
    

}

?>