<?php
namespace App\sts\Models\helper;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * Helper StsValUserSingle responsável por validar o usuário
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsValUserSingle
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

    public function validarUserSingle($username, $edit = null, $id = null) {
      
        $this->userName = $username;
        
        $this->edit = $edit;
        
        $this->id = $id;
   
        $valUserSingle = new \App\sts\Models\helper\StsRead();

        if (($this->edit == true) AND (!empty($this->id))) {
            $valUserSingle->fullRead("SELECT id
                                      FROM sts_users 
                                      WHERE (username =:username) OR email =:email AND
                                      id <>:id
                                      LIMIT :limit", 
                                      "username={$this->userName}&email={$this->userName}&id={$this->id}&limit=1");
                                    
        }ELSE {
            $valUserSingle->fullRead("SELECT id FROM sts_users WHERE username =:username LIMIT :limit", "username={$this->userName}&limit=1");

        }

        $this->resultadoBd = $valUserSingle->getResult();

        if (!$this->resultadoBd) {
            $this->resultado = true;
        } else {
            
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Este usuário já está cadastrado!</div>";
            $this->resultado = false;
        }
    }

}

?>