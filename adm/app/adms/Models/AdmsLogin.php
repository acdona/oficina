<?php
namespace App\adms\Models;

use PDO;

/**
 * Classe AdmsLogin responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsLogin extends helper\AdmsConn
{

    private array $dados;
    private object $conn;
    private $resultadoBd;
    private bool $resultado;
    
    function getResultado() {
        return $this->resultado;
    }
    
    public function login(array $dados = null) {
        $this->dados = $dados;
        var_dump($this->dados);
        $this->conn = $this->connect();

        $query_val_login = "SELECT id, name, nickname, email, password, image
            FROM adms_users
            WHERE user =:user 
            LIMIT 1";
        $result_val_login = $this->conn->prepare($query_val_login);
        $result_val_login->bindParam(':user', $this->dados['user'], PDO::PARAM_STR);
        $result_val_login->execute();
        $this->resultadoBd = $result_val_login->fetch();
        var_dump($this->resultadoBd);
        if($this->resultadoBd){
            $this->validarSenha();
        }else{
            $_SESSION['msg'] = "Erro: Usuário não encontrado!<br>";
            $this->resultado = false;
        }
    }
    
    private function validarSenha() {
        if(password_verify($this->dados['password'], $this->resultadoBd['password'])){
            $_SESSION['user_id'] = $this->resultadoBd['id'];
            $_SESSION['user_name'] = $this->resultadoBd['name'];
            $_SESSION['user_nickname'] = $this->resultadoBd['nickname'];
            $_SESSION['user_email'] = $this->resultadoBd['email'];
            $_SESSION['user_image'] = $this->resultadoBd['image'];
            $this->resultado = true;
        }else{
            $_SESSION['msg'] = "Erro: Usuário ou senha incorreta!<br>";
            $this->resultado = false;
        }
    }

}

?>
