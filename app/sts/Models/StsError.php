<?php
namespace App\sts\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Models StsError responsável pelo controle de erros
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsError
{

    /** @var array $dataError Recebe os dados que são retornado do BD */
    private array $dataError;

    public function view() {
        $viewError = new \App\sts\Models\helper\StsRead();
        $viewError->fullRead("SELECT title_error, description, image_error
                FROM sts_errors
                LIMIT :limit", "limit=1");
        $this->dataError = $viewError->getResult();
        return $this->dataError[0];
    }

}
?>