<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * AdmsAddUsers Model. Responsible for adding an user.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsAddUsers
{
    /** @var array $data Receives data from the database. */
    private array $data;

    /** @var bool $result Checks if the data is not empty. */
    private bool $result;

    /** Email variables */
    private string $fromEmail;
    private string $firstName;
    private array $emailData;

    /** @var array $listRegistry Receives the array for the user's select situation. */
    private array $listRegistryAdd;

    function getResult() {
        return $this->result;
    }
    /** creater function. To add user.
     * @param $data
     */
    public function create(array $data = null) {
        $this->data = $data;

        /** Instantiate helper to validate empty field */
        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();

        /** Validates the data sent by the controller */
        $valEmptyField->validatedata($this->data);

        /** If it is true to load the validate user. */
        if ($valEmptyField->getResult()) {
            $this->valInput();
        } else {
            $this->result = false;
        }
    }

    /** Function that validates if the user already exists in the table. */
    private function valInput() {

        /** Instantiates the helper that checks if the email is valid */
        $valEmail = new \App\adms\Models\helper\AdmsValEmail();
        $valEmail->validateEmail($this->data['email']);

        /** Instantiates the helper that check if the email already exists in the table. */
        $valEmailSingle = new \App\adms\Models\helper\AdmsValEmailSingle();
        $valEmailSingle->validateEmailSingle($this->data['email']);

        /** Instantiates the helper that checks if the password is valid */
        $valPassword = new \App\adms\Models\helper\AdmsValPassword();
        $valPassword->validatePassword($this->data['password']);
             
        /** Instanctiates the helper that checks if the user already exists in the table. */
        $valUserSingle = new \App\adms\Models\helper\AdmsValUserSingleLogin();
        $valUserSingle->validateUserSingleLogin($this->data['username']);
      
        /** If all validation returns true, load the add method. */
        if ($valEmail->getResult() AND $valEmailSingle->getResult() AND $valPassword->getResult() AND $valUserSingle->getResult()) {
            $this->add();
        } else {
            $this->result = false;
        }
    }

    private function add() {
        $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);
        $this->data['conf_email'] = password_hash($this->data['password'] . date("Y-m-d H:i:s"), PASSWORD_DEFAULT);
        $this->data['created'] = date("Y-m-d H:i:s");

        $createUser = new \App\adms\Models\helper\AdmsCreate();
        $createUser->exeCreate("adms_users", $this->data);

        if ($createUser->getCreateResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Usuário cadastrado com sucesso!</div>";
            $this->result = true;
        }else {
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Usuário não cadastrado!</div>";
            $this->result = false;
        }

    }
    /** Function responsible for retrieving data from the database and returning to the page selection 
    */
    public function listSelect()
    {
        $list = new \App\adms\Models\helper\AdmsRead();
        /** Search for situation in the database */
        $list->fullRead("SELECT id id_sit, name name_sit FROM adms_sits_users ORDER by name ASC");
        /** Creates an array of the user situation */
        $registry['sit'] = $list->getReadingResult();
        /** Search for access level in the database */
        $list->fullRead("SELECT id id_lev, name name_lev 
        FROM adms_access_levels 
        WHERE order_levels >:order_levels
        ORDER by name ASC", "order_levels=" . $_SESSION['order_levels']);
        /** Creates an new array of the user situation */
        $registry['lev'] = $list->getReadingResult();


        /** Create a new array of the user situation */
        /** For exemple: If  there was two consults
         *  $list->fullRead("SELECT id id_sit, name name_sit FROM outro ORDER by name ASC");
         *  would be like this :
         *  $registry['outro'] = array('outro', 'banco', 'de', 'data');
         *  $this->listRegistryAdd = ['sit' => $registry['sit'] ,'outro' => $registry['outro']];
         */
      
        $this->listRegistryAdd = ['sit' => $registry['sit'], 'lev' => $registry['lev']];
        return $this->listRegistryAdd;
    }
}

?>