<?php
namespace Core;

/**
 * Classe ConfigController responsável por carregar e manipular a URL
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
    private string $url;
    private array $urlConjunto;
    private string $urlController;
    private string $urlMetodo;
    private string $urlParametro;
    private string $classe;
    private string $slugController;
    private string $slugMetodo;
    private string $urlLimpa;
    private array $format;

    public function __construct()
    {
        $this->configAdm();
        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
            echo "Página que o usuário quer acessar: " . $this->url . "<br>";
            $this->url = $this->limparUrl($this->url);
            echo "Url Limpa: " . $this->url . "<br>";
            $this->urlConjunto = explode("/", $this->url);
            var_dump($this->urlConjunto);
     
            if (isset($this->urlConjunto[0])) {
                $this->urlController = $this->slugController($this->urlConjunto[0]);
            } else {
                $this->urlController = $this->slugController(CONTROLLER);
            }

            if (isset($this->urlConjunto[1])) {
                $this->urlMetodo = $this->slugMetodo($this->urlConjunto[1]);
            } else {
                $this->urlController = $this->slugController(CONTROLLER);
                $this->urlMetodo = $this->slugMetodo(METODO);
            }

            if (isset($this->urlConjunto[2])) {
                $this->urlParamentro = $this->urlConjunto[2];
            } else {
                $this->urlParametro = "";
            }

        }else {
            echo "Criar a página default<br>";
            $this->urlController = $this->slugController(CONTROLLER);
            $this->urlMetodo = $this->slugMetodo(METODO);
            $this->urlParametro = "";
        }
        echo "Controller: {$this->urlController}<br>";
        echo "Método: {$this->urlMetodo}<br>";
        echo "Parâmetro: {$this->urlParametro}<br>";    
    }

    private function slugController($slugController) {
        //Converter para minúsculo
        $this->slugController = strtolower($slugController);
        //Converter o traço para espaço em braco
        $this->slugController = str_replace("-", " ", $this->slugController);
        //Converter a primeira letra de cada palavra para maiúsculo
        $this->slugController = ucwords($this->slugController);
        //Retirar o espaço em branco
        $this->slugController = str_replace(" ", "", $this->slugController);

        return $this->slugController;
    }

    private function slugMetodo($slugMetodo) {
        $this->slugMetodo = $this->slugController($slugMetodo);
        //Converter para minúsculo a primeira letra
        $this->slugMetodo = lcfirst($this->slugMetodo);

        return $this->slugMetodo;
    }

    private function limparUrl($url) {
        //Eliminar as tags
        $this->urlLimpa = strip_tags($url);
        //Eliminar espaços em branco
        $this->urlLimpa = trim($this->urlLimpa);
        //Eliminar a barra no final da URL
        $this->urlLimpa = rtrim($this->urlLimpa, "/");
        $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
        $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr--------------------------------';
        $this->urlLimpa = strtr(utf8_decode($this->urlLimpa), utf8_decode($this->format['a']), $this->format['b']);
        
        return $this->urlLimpa;
    }

    public function carregar()
    {
        $this->classe = "\\App\\adms\\Controllers\\" . $this->urlController;
        $classCarregar = new $this->classe();
        $classCarregar->{$this->urlMetodo}();
         }
}

?>