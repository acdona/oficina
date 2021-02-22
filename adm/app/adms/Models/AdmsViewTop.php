<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe AdmsViewTop responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsViewTop extends Conn
{

    private object $conn;
    private $dados;

    public function viewTop() {
        $this->conn = $this->connect();
        $query_home_top = "SELECT id, title_top, subtitle_top, text_btn_top, link_btn_top, image_top FROM sts_homes_tops LIMIT 1";
        $result_home_top = $this->conn->prepare($query_home_top);
        $result_home_top->execute();
        $this->dados = $result_home_top->fetch();
        return $this->dados;
    }
   
    public function editTop($dados) {
        $this->dados = $dados;
        $this->conn = $this->connect();
        $query_top = "UPDATE sts_homes_tops SET tittle_top=:title_top, subtitle_top=:subtitle_top, text_btn_top=:text_btn_top, link_btn_top=:link_btn_top, modified=NOW() WHERE id=:id";
        $edit_top = $this->conn->prepare($query_top);
        $edit_top->bindParam(':title_top', $this->dados['title_top']);
        $edit_top->bindParam(':subtitle_top', $this->dados['subtitle_top']);
        $edit_top->bindParam(':text_btn_top', $this->dados['text_btn_top']);
        $edit_top->bindParam(':link_btn_top', $this->dados['link_btn_top']);
        $edit_top->bindParam(':id', $this->dados['id'], PDO::PARAM_INT);
        $edit_top->execute();
        
        if($edit_top->rowCount()){
            $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Conteúdo do topo da página home editado com sucesso!</div>';
            return true;
        }else{
            $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro: Conteúdo do topo da página home não editado com sucesso!</div>';
            return false;
        }
    }

}

?>