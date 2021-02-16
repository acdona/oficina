<?php
namespace App\sts\Controllers;


/**
 * Classe ListColors responsável por listar as cores
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class ListColors
{
    /** @var array $dados Recebe os dados que devem ser enviados para VIEW */
    private array $dados=[];

    public function index() {

        $listColors = new \App\sts\Models\StsListColors();
        $listColors->listColors();
        if($listColors->getResult()) {
            $this->dados['listColors']   = $listColors->getResultDb();
        }else {
            $this->dados['listColors']   = [];
        }
        $carregarView = new \App\sts\core\ConfigView("sts/Views/colors/listColors" , $this->dados);
        $carregarView->renderizar();
    }

}

?>