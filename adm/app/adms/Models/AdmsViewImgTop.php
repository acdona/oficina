<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe AdmsViewImgTop responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsViewImgTop
{

    private object $conn;
    private $dados;

    public function viewImgTop() {
        $this->conn = $this->connect();
        $query_home_top = "SELECT id, image_top FROM sts_homes_tops LIMIT 1";
        $result_home_top = $this->conn->prepare($query_home_top);
        $result_home_top->execute();
        $this->dados = $result_home_top->fetch();
        return $this->dados;
    }

    public function editImgTop($dados) {
        $this->dados = $dados;
        $this->conn = $this->connect();
        $query_top = "UPDATE sts_homes_tops SET image_top=:image_top, modified=NOW() WHERE id=:id";
        $edit_top = $this->conn->prepare($query_top);
        $edit_top->bindParam(':image_top', $this->dados['imagem_nova']['name']);
        $edit_top->bindParam(':id', $this->dados['id'], PDO::PARAM_INT);
        $edit_top->execute();

        if ($edit_top->rowCount()) {
            if ($this->upload()) {
                $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Imagem do topo da página home editado com sucesso!</div>';
                return true;
            } else {
                $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro: Imagem do topo da página home não editado com sucesso!</div>';
                return false;
            }
        } else {
            $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro: Imagem do topo da página home não editado com sucesso!</div>';
            return false;
        }
    }
xxx
    private function upload() {
        //Diretório onde o arquivo será salvo
        $diretorio = "app/adms/assets/images/home_top/";

        if (move_uploaded_file($this->dados['imagem_nova']['tmp_name'], $diretorio . $this->dados['imagem_nova']['name'])) {
            $this->apagarImagem();
            return true;
        } else {
            return false;
        }
    }
    
    private function apagarImagem() {
        $img_antiga = "app/adms/assets/images/home_top/" . $this->dados['image_top'];
        unlink($img_antiga);
    }


}

?>