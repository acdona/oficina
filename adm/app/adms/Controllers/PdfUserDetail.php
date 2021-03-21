<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * PdfUserDetail Controller. Responsible for printing the user detail. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class PdfUserDetail
{
    /** @var array $data Receives the data that must be sent to VIEW. */
    private $data;

    /** @var int $id Receive an integer reffering the user ID. */
    private int $id;

       public function viewUserPdf($id) {
        $this->id = $id;

        $userDetail = new \App\adms\Models\AdmsListUserPdf();
        $this->data = $userDetail->viewUserDetail($this->id);
       // var_dump($this->data); exit;
        $loadView = new \Core\ConfigView("adms/Views/users/viewUserPdf", $this->data);
        $loadView->generatePdf();

    }

}

?>