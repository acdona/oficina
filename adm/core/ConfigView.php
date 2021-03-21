<?php
namespace Core;

use Dompdf\Dompdf;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * ConfigView class Responsible for loading the Views.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class ConfigView
{

       /** @var string $name Receives the VIEW address that should be loaded */
       private string $name;
       /** @var array $data Receive data to send VIEW */
       private $data;
   
        /**
        * Receive the VIEW address and data.
        * @param string $name View addres that should be loaded
        * @param array $data Data that VIEW should receive.
        */
       public function __construct($name, array $data = null)
       {
           $this->name = $name; 
           $this->data = $data;
         
       }
   
        /**
        * Load the VIEW.
        * Check that the file exists. If it exists, charge it, if it doesn't stop charging.
        * 
        * @return void
        */
       public function render() {
           if(file_exists('app/' . $this->name . '.php')){
            include 'app/adms/Views/include/head.php';
            include 'app/adms/Views/include/header.php';
            include 'app/adms/Views/include/start_content.php';
            include 'app/adms/Views/include/sidebar.php';
            include 'app/' . $this->name . '.php';
            include 'app/adms/Views/include/end_content.php';
            include 'app/adms/Views/include/footer.php';
          
           } else {
               // die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato com o administrador " . EMAILADM . "<br>");
              echo "Erro ao carregar a view: {$this->name}";
              // when finished delete the lines above -> only  development version  
              // $urlRedirect = URLADM . "error/index";
              // header("Location: $urlRedirect");
           }
       }


       public function renderLogin() {
            if(file_exists('app/' . $this->name . '.php')){
                include 'app/adms/Views/include/header_login.php';
                include 'app/' . $this->name . '.php';
                include 'app/adms/Views/include/footer_login.php';
                //     include 'app/adms/Views/include/libraries_js.php';
            } else {
                // die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato com o administrador " . EMAILADM . "<br>");
            echo "Erro ao carregar a view: {$this->name}";
            // when finished delete the lines above -> only  development version
            // $urlRedirect = URLADM . "error/index";
            // header("Location: $urlRedirect");
            }
         }


    public function generatePdf()
    {
        if (file_exists('app/' . $this->name . '.php')) {
            $domPdf = new Dompdf();
            include 'app/' . $this->name . '.php';
        }else{
            echo "Erro ao carregar a Página: {$this->name}";
        }
    }

}

?>