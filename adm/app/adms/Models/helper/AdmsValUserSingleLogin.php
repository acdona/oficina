<?php
namespace App\adms\Models\helper;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsValUserSingleLogin Helper . Responsible for validating the user.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsValUserSingleLogin
{
    /** @var string $userName Receives the username. */
    private string $userName;

    /** @var  $edit */
    private $edit;

    /** @var  int $id Receives the user ID. */
    private $id;

    /** @var  bool $result Receives true or false when searching the database. */
    private bool $result;

    /** @var  array $databaseResult Receives user data from the database */
    private array  $databaseResult;

    function getResult(): bool {
        return $this->result;
    }

    public function validateUserSingleLogin($username, $edit = null, $id = null) {
      
        $this->userName = $username;
        
        $this->edit = $edit;
        
        $this->id = $id;
   
        $valUserSingleLogin = new \App\adms\Models\helper\AdmsRead();

        if (($this->edit == true) AND (!empty($this->id))) {
            $valUserSingleLogin->fullRead("SELECT id 
                                      FROM adms_users 
                                      WHERE (username =:username OR email =:email) AND
                                      id <>:id
                                      LIMIT :limit", 
                                      "username={$this->userName}&email={$this->userName}&id={$this->id}&limit=1"
                                    );                                     
                                    
        } else {
            $valUserSingleLogin->fullRead("SELECT id FROM adms_users WHERE username =:username LIMIT :limit", "username={$this->userName}&limit=1");
        }

        $this->databaseResult = $valUserSingleLogin->getReadingResult();
        

        if (!$this->databaseResult) {
            $this->result = true;
        } else {
            
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Este usuário já está cadastrado!</div>";
            $this->result = false;
        }
    }

}

?>