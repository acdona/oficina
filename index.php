<?php
    //Inicia uma nova sessão
    session_start();
    
    // Inicializa o buffer e bloqueia qualquer saída para o navegador
    ob_start();
    
    //Define uma chave de segurança para todas as páginas do projeto
    define('R4F5CC', true);

    //carrega o autoload
    require './vendor/autoload.php';
    
    //Atribui um apelelido para rota da classe
    use Core\ConfigController as Home;
    
    //Instancia a classe ConfigController
    $url = new Home();
    
    //Instanciar o método
    $url->carregar();

?>