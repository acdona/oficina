<?php
namespace App\sts\Models\helper;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe StsSlug responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsSlug
{
    private string $nome;
    private array $formato;

    public function slug($nome) {
        $this->nome = (string) $nome;

        $this->formato['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:,\\\'<>°ºª';
        $this->formato['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                ';
        $this->nome = strtr(utf8_decode($this->nome), utf8_decode($this->formato['a']), $this->formato['b']);
        $this->nome = str_replace(" ", "-", $this->nome);
        $this->nome = str_replace(array('-----', '----', '---', '--'), '-', $this->nome);
        $this->nome = strtolower($this->nome);

        return $this->nome;
    }

    

}

?>