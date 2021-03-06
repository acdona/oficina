<?php
namespace App\sts\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * Controller - Error page.
 *
 * @author acd
 */
class Error
{
    /** @var array $dados Recebe os dados que devem ser enviados para VIEW */
    private array $dados;

    /**
     * Instanciar a classe responsável em carregar a View
     * 
     * @return void
     */
    public function index(): void {

        $this->dados = [];
        $viewError = new \App\sts\Models\StsError();
        $this->dados['error'] = $viewError->view();
        
        /** Carregar o rodapé */
        $viewFooter = new \App\sts\Models\StsFooter();
        $this->dados['footer'] = $viewFooter->view();
  
        $carregarView = new \Core\ConfigView("sts/Views/error/error", $this->dados);
        $carregarView->renderizar();
    }

 }
