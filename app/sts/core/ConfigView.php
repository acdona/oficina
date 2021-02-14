<?php
namespace App\sts\core;

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
            $viewFooter = new \App\sts\Models\StsFooter();
            $this->dados['footer'] = $viewFooter->view();
            include 'app/sts/Views/include/head.php';
            include 'app/sts/Views/include/menu.php';
            include 'app/' . $this->nome . '.php';
            include 'app/sts/Views/include/footer.php';
            include 'app/sts/Views/include/libraries_js.php';
            
        } else {
            //die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM . "!<br>");
            echo "Erro ao carregar view: {$this->nome}<br>";
        }
    }

    // public function renderizarLogin() {
    //     if (file_exists('app/' . $this->nome . '.php')) {
    //         include 'app/sts/Views/include/head.php';
    //         include 'app/' . $this->nome . '.php';
    //         include 'app/sts/Views/include/footer.php';
    //     } else {
    //         //die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM . "!<br>");
    //         echo "Erro ao carregar view: {$this->nome}<br>";
    //     }
    // }
  
}
