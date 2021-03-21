<?php
namespace App\adms\Models\helper;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsSlug Helper. Responsible for replacing special characters.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsSlug
{
    private string $name;
    private array $format;

    public function slug($name) {
        $this->name = (string) $name;

        $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:,\\\'<>°ºª';
        $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                ';
        $this->name = strtr(utf8_decode($this->name), utf8_decode($this->format['a']), $this->format['b']);
        $this->name = str_replace(" ", "-", $this->name);
        $this->name = str_replace(array('-----', '----', '---', '--'), '-', $this->name);
        $this->name = strtolower($this->name);

        return $this->name;
    }

    

}

?>