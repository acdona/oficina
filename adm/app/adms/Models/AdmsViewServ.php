<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe AdmsViewServ responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsViewServ extends Conn
{

    private object $conn;
    private array $dados;

    public function viewServ() {
        $this->conn = $this->connect();
        $query_home_serv = "SELECT id, titulo_serv, subtitulo_serv, icone_um_serv, titulo_um_serv, desc_um_serv, icone_dois_serv, titulo_dois_serv, desc_dois_serv, icone_tres_serv, titulo_tres_serv, desc_tres_serv FROM scrs_homes_servicos LIMIT 1";
        $result_home_serv = $this->conn->prepare($query_home_serv);
        $result_home_serv->execute();
        $this->dados = $result_home_serv->fetch();
        return $this->dados;
    }
    
    public function editServ(array $dados = null) {
        $this->dados = $dados;
        $this->conn = $this->connect();
        $query_topo = "UPDATE scrs_homes_servicos SET titulo_serv=:titulo_serv, subtitulo_serv=:subtitulo_serv, icone_um_serv=:icone_um_serv, titulo_um_serv=:titulo_um_serv, desc_um_serv=:desc_um_serv, icone_dois_serv=:icone_dois_serv, titulo_dois_serv=:titulo_dois_serv, desc_dois_serv=:desc_dois_serv, icone_tres_serv=:icone_tres_serv, titulo_tres_serv=:titulo_tres_serv, desc_tres_serv=:desc_tres_serv, modified=NOW() WHERE id=:id";
        $edit_topo = $this->conn->prepare($query_topo);
        $edit_topo->bindParam(':titulo_serv', $this->dados['titulo_serv']);
        $edit_topo->bindParam(':subtitulo_serv', $this->dados['subtitulo_serv']);
        $edit_topo->bindParam(':icone_um_serv', $this->dados['icone_um_serv']);
        $edit_topo->bindParam(':titulo_um_serv', $this->dados['titulo_um_serv']);
        $edit_topo->bindParam(':desc_um_serv', $this->dados['desc_um_serv']);
        
        $edit_topo->bindParam(':icone_dois_serv', $this->dados['icone_dois_serv']);
        $edit_topo->bindParam(':titulo_dois_serv', $this->dados['titulo_dois_serv']);
        $edit_topo->bindParam(':desc_dois_serv', $this->dados['desc_dois_serv']);
        
        $edit_topo->bindParam(':icone_tres_serv', $this->dados['icone_tres_serv']);
        $edit_topo->bindParam(':titulo_tres_serv', $this->dados['titulo_tres_serv']);
        $edit_topo->bindParam(':desc_tres_serv', $this->dados['desc_tres_serv']);
        $edit_topo->bindParam(':id', $this->dados['id'], PDO::PARAM_INT);
        $edit_topo->execute();
        
        if($edit_topo->rowCount()){
            $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Conteúdo do serviço da página home editado com sucesso!</div>';
            return true;
        }else{
            $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro: Conteúdo do serviço da página home não editado com sucesso!</div>';
            return false;
        }
    }


}

?>