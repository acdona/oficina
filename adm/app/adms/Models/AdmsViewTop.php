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

    public function viewTopo() {
        $this->conn = $this->connect();
        $query_home_topo = "SELECT id, titulo_topo, subtitulo_topo, text_btn_topo, link_btn_topo, imagem_topo FROM scrs_homes_topos LIMIT 1";
        $result_home_topo = $this->conn->prepare($query_home_topo);
        $result_home_topo->execute();
        $this->dados = $result_home_topo->fetch();
        return $this->dados;
    }
    
    public function editTopo($dados) {
        $this->dados = $dados;
        $this->conn = $this->connect();
        $query_topo = "UPDATE scrs_homes_topos SET titulo_topo=:titulo_topo, subtitulo_topo=:subtitulo_topo, text_btn_topo=:text_btn_topo, link_btn_topo=:link_btn_topo, modified=NOW() WHERE id=:id";
        $edit_topo = $this->conn->prepare($query_topo);
        $edit_topo->bindParam(':titulo_topo', $this->dados['titulo_topo']);
        $edit_topo->bindParam(':subtitulo_topo', $this->dados['subtitulo_topo']);
        $edit_topo->bindParam(':text_btn_topo', $this->dados['text_btn_topo']);
        $edit_topo->bindParam(':link_btn_topo', $this->dados['link_btn_topo']);
        $edit_topo->bindParam(':id', $this->dados['id'], PDO::PARAM_INT);
        $edit_topo->execute();
        
        if($edit_topo->rowCount()){
            $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Conteúdo do topo da página home editado com sucesso!</div>';
            return true;
        }else{
            $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro: Conteúdo do topo da página home não editado com sucesso!</div>';
            return false;
        }
    }

}

?>