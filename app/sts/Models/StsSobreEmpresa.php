<?php
namespace App\sts\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * StsSobreEmpresa Model responsible for the company page.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsSobreEmpresa
{
    /**
     * Instancia a classe genérica no helper, responsável por buscar os registros no banco de dados
     * Possui a QUERY responsável em buscar os registro no BD.
     * @return array Retorna o registro do banco de dados com informações para página sobre empresa.
     */
    public function index():array {
        $listSobreEmpresa = new \App\sts\Models\helper\StsRead();
        $listSobreEmpresa->fullRead("SELECT id, title, description, image
                                    FROM sts_about_companies 
                                    WHERE sts_situation_id =:sts_situation_id LIMIT :limit", "sts_situation_id=1&limit=5");
        return $listSobreEmpresa->getResult();

    }
}