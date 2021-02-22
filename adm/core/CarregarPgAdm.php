<?php
namespace Core;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe pagar carregar página adms
 * 
 * @author ACD
 */
class CarregarPgAdm
{
 
     //para receber a controller
     private string $urlController;
     //para receber o método
     private string $urlMetodo;
     //para receber o parâmetro
     private string $urlParametro;
     private string $classe;
     private $pgPublica;
     private array $pgRestrita;
     
    public function carregarPg($urlController = null, $urlMetodo = null, $urlParametro = null){
        $this->urlController = $urlController;
        $this->urlMetodo = $urlMetodo;
        $this->urlParametro = $urlParametro;
        
        $this->pgPublica();

        if (class_exists($this->classe)) {

            $this->carregarMetodo();
        } else {
            $this->urlController = $this->slugController(CONTROLLER);
            $this->urlMetodo = $this->slugMetodo(METODO);
            $this->urlParametro = "";
            $this->classe = "\\App\\adms\\Controllers\\" . $this->urlController;
            $this->carregarMetodo();
        }   
    }    
       
    private function carregarMetodo() {
        $classCarregar = new $this->classe();
        if(method_exists($classCarregar, $this->urlMetodo)){
            $classCarregar->{$this->urlMetodo}($this->urlParametro);
            
        }else{
            //die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM . "!<br>");
           
            $urlDestino = URL . "error/index";
            header("Location: $urlDestino");
        }        
    }

    private function pgPublica() {
        $this->pgPublica = ["Home", "SobreEmpresa", "Error", "AccountCategory", "ListAccountCategory", "AddAccountCategory", "ViewAccountCategory", "EditAccountCategory", "DeleteAccountCategory", "ListCategory", "AddCategory", "EditCategory", "ViewCategory", "DeleteCategory", "AddUsers", "ListColors", "EditColor", "ViewColor", "AddColor", "DeleteColor", "ListCities", "ViewCity","ListUsers", "ViewUser","EditUser", "DeleteUser", "EditUserImage", "EditSitsUser", "ListSitsUsers", "ViewSitsUser", "DeleteSitsUser", "AddSitsUser"];

        if(in_array($this->urlController, $this->pgPublica)) {
            $this->classe = "\\App\adms\\Controllers\\" . $this->urlController;
        } else {
            $this->pgRestrita();
        }
    }

    private function pgRestrita() {
        $this->pgRestrita = ["Dashboard"];
        if(in_array($this->urlController, $this->pgRestrita)) {
            $this->verificarLogin();
        } else {
            $_SESSION['msg'] = "Erro: Página não encontrada!<br>";
            $urlDestino = URL . "error/index";
            header("Location: $urlDestino");
        }
    }

    private function verificarLogin() {
        if(isset($_SESSION['user_id']) AND isset($_SESSION['user_name']) AND isset($_SESSION['user_email'])) {
            $this->classe = "\\App\\adms\\Controllers\\" . $this->urlController;
        } else {
            $_SESSION['msg'] = "Erro: Página não encontrada!<br>";
            $urlDestino = URL . "home/index";
            header("Location: $urlDestino");
        }
    }

    private function slugController($slugController) {
        //Converter para minusculo
        $this->slugController = strtolower($slugController);
        //Converter o traço para espaço em braco
        $this->slugController = str_replace("-", " ", $this->slugController);
        //Converter a primeira letra de cada palavra para maiusculo
        $this->slugController = ucwords($this->slugController);
        //Retirar o espaço em braco
        $this->slugController = str_replace(" ", "", $this->slugController);

        return $this->slugController;
    }

    private function slugMetodo($slugMetodo) {
        $this->slugMetodo = $this->slugController($slugMetodo);
        //Converter para minusculo a primeira letra
        $this->slugMetodo = lcfirst($this->slugMetodo);

        return $this->slugMetodo;
    }
} 
?>