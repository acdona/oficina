<?php
namespace Core;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe para carregar as Views
 * 
 * @author ACD
 */
class ConfigView
{
 
    /** @var string $nome Recebe o endereço da VIEW que deve ser carregada */
    private string $nome;
    /** @var array $dados Recebe os dados que a VIEW deve receber */
    private $dados;

     /**
     * Receber o endereço da VIEW e os dados.
     * @param string $nome Endereço da VIEW que deve ser carregada
     * @param array $dados Dados que a VIEW deve receber.
     */
    public function __construct($nome, array $dados = null)
    {
        $this->nome = $nome; 
        $this->dados = $dados;
      
    }

     /**
     * Carregar a VIEW.
     * Verificar se o arquivo existe e carrega caso exista, não existindo, para o carregamento
     * 
     * @return void
     */
    public function renderizar() {
        if(file_exists('app/' . $this->nome . '.php')){
            include 'app/adms/Views/include/head.php';
            include 'app/adms/Views/include/menu.php';
            include 'app/' . $this->nome . '.php';
            include 'app/adms/Views/include/footer.php';
            include 'app/adms/Views/include/libraries_js.php';
        } else {
            //die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato com o administrador " . EMAILADM . "<br>");
           // echo "Erro ao carregar a view: {$this->nome}";
           
           $urlDestino = URL . "error/index";
           header("Location: $urlDestino");
        }
    }

    public function renderizarLogin() {
        if(file_exists('app/' . $this->nome . '.php')){
            include 'app/adms/Views/include/head.php';
            include 'app/' . $this->nome . '.php';
            include 'app/adms/Views/include/footer.php';
        } else {
            //die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato com o administrador " . EMAILADM . "<br>");
            
            $urlDestino = URL . "error/index";
            header("Location: $urlDestino");
            //echo "Erro ao carregar a view: {$this->nome}";
        }
    }
 
}
 
?>