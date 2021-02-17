<?php

namespace App\sts\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Controller - Home page.
 *
 * @author acd
 */
class Home
{

    /** @var array $dados Recebe os dados que devem ser enviados para VIEW */
    private array $dados;

    /**
     * Instanciar a MODELS e receber o retorno
     * Instantiar a classe responsável em carregar a View e enviar os dados para View.
     * 
     * @return void
     */
    public function index(): void {
        
        $home = new \App\sts\Models\StsHome();
        $this->dados['sts_homes'] = $home->index();
        
        $viewFooter = new \App\sts\Models\StsFooter();
        $this->dados['footer'] = $viewFooter->view();
        
        $carregarView = new \Core\ConfigView("sts/Views/home/home", $this->dados);
        $carregarView->renderizar();
    }

}