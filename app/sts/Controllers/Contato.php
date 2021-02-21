<?php
 
    namespace App\sts\Controllers;

    if (!defined('R4F5CC')) {
        header("Location: /");
        die("Erro: Página não encontrada!");
    }

    /**
     * Controller da página de Contato
     * 
     * @author ACD
     */
    class Contato
    {
        /** @var array $data Recebe os dados que devem ser enviados para VIEW */
        private array $data; 
        
        /** @var $dataForm Recebe os dados do formulário */
        private $dataForm;
        
        
        /**
         * Instanciar a classe responsável em carregar a View
         * @return void
         */
        public function index(): void {

           $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
           if(!empty($this->dataForm['CreatContMsg'])) {
               unset($this->dataForm['CreatContMsg']);
               $createContactMsg = new \App\sts\Models\StsContato();
               if($createContactMsg->create($this->dataForm)){

               } else {
                   $this->data['form'] = $this->dataForm;
               }
           }

           $viewContact = new \App\sts\Models\StsContato();
           $this->data['address'] = $viewContact->view();

           $viewFooter = new \App\sts\Models\StsFooter();
           $this->data['footer'] = $viewFooter->view();

        //    $viewError = new \App\sts\Models\StsError();
        //    $this->dados['erro'] = $viewError->view();

           $carregarView = new \Core\ConfigView("sts/Views/contato/contato", $this->data);
           $carregarView->renderizar();
        }
    }
?>