<?php
namespace App\adms\Models\helper;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Helper AdmsValUserSingleLogin responsável por validar o usuário
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
    /** @var string $userName Recebe o username  */
    private string $userName;

    /** @var  $edit */
    private $edit;

    /** @var  int $id Recebe o ID do isuário */
    private $id;

    /** @var  bool $resultado Recebe verdadeiro ou falso na pesquisa do banco de dados */
    private bool $resultado;

    /** @var  array $resultadoBd Recebe os dados do banco de dados */
    private array  $resultadoBd;

    function getResultado(): bool {
        return $this->resultado;
    }

    public function validarUserSingleLogin($username, $edit = null, $id = null) {
      
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

        $this->resultadoBd = $valUserSingleLogin->getResult();
        

        if (!$this->resultadoBd) {
            $this->resultado = true;
        } else {
            
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Este e-mail já está cadastrado!</div>";
            $this->resultado = false;
        }
    }

}

?>