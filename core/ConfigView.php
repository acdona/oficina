<?php
namespace Core;

if (!defined('48b5t9')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe ConfigView responsável por 
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
    private array $dados;

    public function __construct($nome, array $dados)
    {
      $this->nome = $nome;
      $this->dados = $dados;

    }

    /** Verifica se a View existe */
    public function renderizar()
    {
        if(file_exists('app/' . $this->nome . '.php')) {
          include 'app/sts/Views/include/header.php';
          include 'app/' . $this->nome . '.php';
          include 'app/sts/Views/include/footer.php';
    
      }else {
         echo "Página não encontrada: {$this->nome}<br>";
         die("Página não encontrada!");
        }        
        
    }
}

?>