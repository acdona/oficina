<?php
namespace App\adms\core;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Description of ConfigView
 *
 * @author acd
 */
class ConfigView
{

    private string $nome;
    private $dados;

    public function __construct($nome, array $dados = null) {
        $this->nome = $nome;
        $this->dados = $dados;
    }

    public function renderizar() {
        
        if (file_exists('app/' . $this->nome . '.php')) {
           // $viewFooter = new \App\adms\Models\AdmsFooter();
           // $this->dados['footer'] = $viewFooter->view();
            include 'app/adms/Views/include/head.php';
           // include 'app/adms/Views/include/menu.php';
            include 'app/' . $this->nome . '.php';
            include 'app/adms/Views/include/footer.php';
           // include 'app/adms/Views/include/libraries_js.php';
            
        } else {
            //die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM . "!<br>");
            echo "Erro ao carregar view: {$this->nome}<br>";
            //$urlDestino = URL . "error/index";
            //header("Location: $urlDestino");
        }
    }

    public function renderizarLogin() {
        if (file_exists('app/' . $this->nome . '.php')) {
            include 'app/adms/Views/include/head_login.php';
            include 'app/' . $this->nome . '.php';
            include 'app/adms/Views/include/footer.php';
        } else {
            //die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM . "!<br>");
            echo "Erro ao carregar view: {$this->nome}<br>";
        }
    }
  
}
