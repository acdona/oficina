<?php
namespace Core;
if (!defined('48b5t9')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * Classe ConfigController responsável por receber e manipular a URL
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class ConfigController extends Config
{
    /** @var string $url Recebe a URL do htaccess */
    private string $url;

    /** @var array $urlConjunto Recebe a URL convertida para um array */
    private array $urlConjunto;

    /** @var string $urlController Recebe a controller */
    private string $urlController;

    /** @var string $urlParametro Recebe o parâmetro */
    private string $urlParametro;

    /** @var string $urlSlugController Manipula a URL tira os hífens */
    private string $urlSlugController;
    
    /** @var string $slugMetodo Manipula a URL  */
    private string $slugMetodo;

    private string $urlLimpa;

    /** @var array $format Utilizada na substituição de caracteres */
    private array $format;
    

    public function __construct() {
        $config = new \Core\Config();
        $config->config();
        if (!empty(filter_input(INPUT_GET, "url", FILTER_DEFAULT))) {
            $this->url = filter_input(INPUT_GET, "url", FILTER_DEFAULT);
            $this->limparUrl();
            $this->urlConjunto = explode("/", $this->url);
            if (isset($this->urlConjunto[0])) {
                $this->urlController = $this->slugController($this->urlConjunto[0]);
            } else {
                $this->urlController = CONTROLLER;
            }
            
            if(isset($this->urlConjunto[1])){
                $this->urlParamentro = $this->urlConjunto[1];
            }else{
                $this->urlParamentro = "";
            }
        }else{
            $this->urlController = CONTROLLER;
            $this->urlParamentro = "";
        }
    }

    /**
     * Função para limpar caracteres digitados na URL
     * 
     */
    private function limparUrl(){
         //Eliminar as tags
         $this->url = strip_tags($this->url);
         //Eliminar espaços em branco
         $this->url = trim($this->url);
         //Eliminar a barra no final da URL
         $this->url = rtrim($this->url, "/");
 
         $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
         $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr--------------------------------';
         $this->url = strtr(utf8_decode($this->url), utf8_decode($this->format['a']), $this->format['b']);
    }

    private function slugController($slugController) {
        //Converter para minusculo
        $this->urlSlugController = strtolower($slugController);
        //Converter o traço para espaço em braco
        $this->urlSlugController = str_replace("-", " ", $this->urlSlugController);
        //Converter a primeira letra de cada palavra para maiusculo
        $this->urlSlugController = ucwords($this->urlSlugController);
        //Retirar o espaço em braco
        $this->urlSlugController = str_replace(" ", "", $this->urlSlugController);
        return $this->urlSlugController;
    }

    private function slugMetodo($slugMetodo) {
        $this->slugMetodo = $this->slugController($slugMetodo);
        //Converter para minusculo a primeira letra
        $this->slugMetodo = lcfirst($this->slugMetodo);

        return $this->slugMetodo;
    }

    public function carregar() {
        $classe = "\\App\\sts\\Controllers\\" . $this->urlController;
        $classeCarregar = new $classe();
        $classeCarregar->index();
    }
}

?>