<?php
namespace App\adms\Models;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

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
class AdmsLogin extends Conn
{

    private object $conn;
    private $dados;
    private $resultadoBd;
    private bool $resultado = false;
    
    function getResultado(): bool {
        return $this->resultado;
    }

    xxx
    public function login(array $dados = null) {
        $this->dados = $dados;
        $this->conn = $this->connect();
        $query_val_login = "SELECT id, name, nickname, email, password, image FROM adms_users WHERE user =:user LIMIT 1";
        $result_val_login = $this->conn->prepare($query_val_login);
        $result_val_login->bindParam(':user', $this->dados['user'], PDO::PARAM_STR);
        $result_val_login->execute();
        $this->resultadoBd = $result_val_login->fetch();
        if($this->resultadoBd){
            $this->validarSenha();
        }else{
            $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro: Usuário não encontrado!</div>';
            $this->resultado = false;
        }               
    }
    
    private function validarSenha() {
        if(password_verify($this->dados['password'], $this->resultadoBd['password'])){
            $_SESSION['user_id'] = $this->resultadoBd['id'];
            $_SESSION['user_name'] = $this->resultadoBd['name'];
            $_SESSION['user_email'] = $this->resultadoBd['email'];
            $_SESSION['user_nickname'] = $this->resultadoBd['nickname'];
            $_SESSION['user_image'] = $this->resultadoBd['image'];
            $this->resultado = true;
        }else{
            $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro: Usuário ou senha incorreta!</div>';
            $this->resultado = false;
        }
    }


}

?>