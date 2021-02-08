<?php
namespace Core;

/**
 * Classe ConfigView responsável por carregar as páginas de View
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

    private string $nome;
    private $dados;

    public function __construct($nome, array $dados = null)
    {
        $this->nome = $nome;
        $this->dados = $dados;
        echo "Receber o endereço da VIEW: {$this->nome}<br>";
    }

    public function renderizar()
    {
        if (file_exists('app/' . $this->nome . '.php')) {
            include 'app/' . $this->nome . '.php';
        } else {
            //die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM . "!<br>");
            echo "Erro ao carregar view: {$this->nome}<br>";
        }
       
    }

}

?>