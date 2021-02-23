<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe NivelAcesso responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class NivelAcesso
{

    public function listAtivo() {
        echo "Página listar Nivel de Acesso<br>";
    }

}

?>