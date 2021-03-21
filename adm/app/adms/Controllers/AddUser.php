<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AddUser Controller responsible for adding an user. 
 * 
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 * 
 * @access public
 *
*/
class AddUser
{
    /** @var array $data Receives data from the database.*/
    private $data;

    /** @var array $formData Receives form data. */
    private $formData;

    /**
     * Função index.
     *
     * @return void
     */
    public function index() {
        
        /** Receives form data. */
        $this->formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        /** Checks that the form data is not empty. */
        if(!empty($this->formData['AddUser'])){

            /** If empty, destroy the variable */
            unset($this->formData['AddUser']);

            /** Instantiate models to add user */
            $addUser = new \App\adms\Models\AdmsAddUsers();
            
            /** Creates a new user with the form data. */
            $addUser->create($this->formData);

            /** If the record returns true, load the user list. */
            if($addUser->getResult()) {
                $urlRedirect = URLADM . "list-users/index";
                header("Location: $urlRedirect");
            } else {

                /** If the record return true, reload the form. */
                $this->data['form'] = $this->formData;
                $this->viewAddUser();
            }
        } else { /**If form data is empty, reload the form. */
            $this->viewAddUser();
        }
    }

    /**
     * viewNewUser function. Loads the registration form with the values, 
     * so you don't have to retype.
     *
     * @return void
    */
    private function viewAddUser() {  
       
        /** Instantiates the MODEL create user */
        $listSelect = new \App\adms\Models\AdmsAddUsers();

        /** Loads the method to show the select. */
        $this->data['select'] = $listSelect->listSelect();

        $this->data['sidebarActive'] = "list-users";

        /** Loads the View addUser */
        $loadView = new \Core\ConfigView("adms/Views/users/addUser", $this->data);

        /** Loads the rendering in the ConfigController to view the form. */
        $loadView->render();   
    }

}

?>