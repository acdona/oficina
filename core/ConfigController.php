<?php
namespace Core;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Recebe a URL e manipula 
 * 
 * @author ACD
 */
class ConfigController extends Config {

    /** @var string $url Recebe a URL do htaccess */
    private string $url;
    
    /** @var array $urlConjunto Recebe a URL convertida para um array */
    private array $urlConjunto;

    /** @var string $urlController Recebe da URL o nome da controller */
    private string $urlController;

    /** @var string $urlMetodo Recebe da URL o método */
    private string $urlMetodo;

    /** @var string $urlParamentro Recebe da URL o parâmetro */
    private string $urlParametro;

    /** @var string $classe Recebe a classe */
    private string $classe;

    /** @var string $urlSlugController Recebe a controller convertida para o formato do nome da classe */
    private string $urlSlugController;

    /** @var array $slugMetodo Metodo */
    private string $slugMetodo;

    /** @var array $urlimpa Limpa */
    private string $urlLimpa;

    /** @var array $format Recebe o array de caracteres especiais que devem ser substituido */
    private array $format;
    
    public function __construct()
    {
        $this->configAdm();
        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);            

            $this->url = $this->limparUrl($this->url);      
            
            $this->urlConjunto = explode("/", $this->url);

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
                $this->urlParametro = $this->urlConjunto[2];
            } else {
                $this->urlParametro = "";
            }
        } else {

            $this->urlController = $this->slugController(CONTROLLER);
            
            $this->urlMetodo = $this->slugMetodo(METODO);
          
            $this->urlParametro = "";
            
        }
        echo "o Controle é: " . $this->urlController . "<br>";
        echo "o Método  é: " . $this->urlMetodo . "<br>";
        echo "o Parâmetro é: " . $this->urlParametro . "<br>";
        
    }

/**
     * Converter o valor obtido da URL "sobre-empresa" e converter no formato da classe "SobreEmpresa".
     * Utilizado as funções para converter tudo para minúsculo, converter o traço pelo espaço, converter cada letra da primeira palavra para maiúsculo, retirar os espaços em branco
     * @param string $slugController Nome da classe
     * @return string Retorna a controller "sobre-empresa" convertido para o nome da Classe "SobreEmpresa"
     */
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



/**  
     * Verificar se a classe existe.
     * Não existindo a classe atribuir a classe erro
     * 
     * @return void
     */
    public function carregar(): void {
        $this->classe = "\\App\\sts\\Controllers\\" . $this->urlController;
        if(class_exists($this->classe)){
            $this->carregarClasse();
        }else{
            $this->urlController = $this->slugController(CONTROLLERERRO);
            $this->carregarClasse();
        }
    }

     /**  
     * Verificar se o método existe, existindo o método carrega a página;
     * Não existindo o método, para o carregamento e apresenta mensagem de erro.
     * 
     * @return void
     */    
    private function carregarClasse(): void {
        $classeCarregar = new $this->classe();
        if(method_exists($classeCarregar, "index")){
            $classeCarregar->index();
        }else{
            die('Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador ' . EMAILADM . '<br>');
        }
    }
}