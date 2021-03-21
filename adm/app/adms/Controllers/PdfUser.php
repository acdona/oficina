<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * PdfUser . Responsible for printing users.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class PdfUser {

    private $data;

    public function generatePdf() {
        $listUsers = new \App\adms\Models\AdmsListUserPdf();
        $this->data = $listUsers->generatePdf();
       // var_dump($this->data); exit("dentro da control");
        $carregarView = new \Core\ConfigView("adms/Views/users/generatePdfUser", $this->data);
        $carregarView->generatePdf();
    }   

}

?>
