<?php
namespace App\sts\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Controller SobreEmpresa responsável por  
 * mostrar a tela sobre-empresa
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class SobreEmpresa
    {
        /** @var array $dados Recebe os dados que devem ser enviados para VIEW */
        private array $dados;

        /**
         * Instanciar a MODELS e receber o retorno
         * Instanciar a classe responsável em carregar a VIEW e enviar os dados para VIEW
         * 
         * @return void
         */
        public function index():void {
            $list = new  \App\sts\Models\StsSobreEmpresa();
            $this->dados['sts_sobres_empresas'] = $list->index();

            $viewFooter = new \App\sts\Models\StsFooter();
            $this->dados['footer'] = $viewFooter->view();

            $viewError = new \App\sts\Models\StsError();
            $this->dados['erro'] = $viewError->view();

            $carregarView = new \Core\ConfigView("sts/Views/sobreEmpresa/sobreEmpresa", $this->dados) ;
            $carregarView->renderizar();
        }
    }
 

?>