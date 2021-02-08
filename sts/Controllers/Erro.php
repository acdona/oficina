<?php
namespace App\sts\Controllers;

if (!defined('48b5t9')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Controller Erro responsável pelo carregamengto da página de erro
 * Carregada quando não extste a classse ou o método
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class Erro
{
    private array $dados;
    
    public function index(){
        
        $this->dados = [];
        $carregarView = new \Core\ConfigView("sts/Views/erro/erro", $this->dados);
        $carregarView->renderizar();
    }
}

?>