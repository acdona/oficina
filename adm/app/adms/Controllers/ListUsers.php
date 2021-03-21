<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * ListUsers Controller responsible for listing users.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class ListUsers
{
    /** @var array $data Receives the data that must be sent to the VIEW user list. */
    private array $data;
   
    /** @var int $pag Receive an integer for the page. */
    private int $pag;

    public function index($pag = null) {
        
        $this->pag = (int) $pag ? $pag : 1;

        $listUsers = new \App\adms\Models\AdmsListUsers();
        $listUsers->listUsers($this->pag);

        if($listUsers->getResult()) {
            $this->data['listUsers'] = $listUsers->getDatabaseResult();
            $this->data['pagination'] = $listUsers->getResultPg();
        }else {
            $this->data['listUsers'] = [];
            $this->data['pagination'] = null;
        }

        $button = ['pdf_user_detail' => ['menu_controller' => 'pdf-user-detail',    'menu_method' => 'view-user-pdf'],
                   'pdf_user'        => ['menu_controller' => 'pdf-user',           'menu_method' => 'generate-pdf'],
                   'add_user'        => ['menu_controller' => 'add-user',           'menu_method' => 'index'],
                   'view_user'       => ['menu_controller' => 'view-user',          'menu_method' => 'index'],
                   'edit_user'       => ['menu_controller' => 'edit-user',          'menu_method' => 'index'],
                   'delete_user'     => ['menu_controller' => 'delete-user',        'menu_method' => 'index']];
        
        $listButton = new \App\adms\Models\helper\AdmsButton();
       
        $this->data['button'] = $listButton->buttonPermission($button);
   //  var_dump($this->data); exit;
        $this->data['sidebarActive'] = "list-users";
        $loadView = new \Core\ConfigView("adms/Views/users/listUsers" , $this->data);
        $loadView->render();
    }

}

?>