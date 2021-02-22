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
class AdmsViewServ
{

    private $resultadoBd;
    private bool $resultado;
    private int $id;

    function getResultado(): bool {
        return $this->resultado;
    }

    function getResultadoBd() {
        return $this->resultadoBd;
    }
    
    

    public function viewServ($id) {

        $this->id = (int) $id;
        $viewServ = new \App\adms\Models\helper\AdmsRead();
        $viewServ->fullRead("SELECT id, title_serv, subtitle_serv, icone_one_serv, title_one_serv, desc_one_serv, icon_two_serv, title_two_serv, desc_two_serv, icon_three_serv, title_three_serv, desc_three_serv 
                             FROM sts_homes_services 
                             LIMIT :limit", "id={$this->id}&limit=1"); 
        
        $this->resultadoBd = $viewServ->getResult();
        
        
    }
    
    public function editServ(array $dados = null) {
        $this->dados = $dados;
        $this->conn = $this->connect();
        $query_top = "UPDATE sts_homes_services SET title_serv=:title_serv, subtitle_serv=:subtitle_serv, icone_one_serv=:icone_one_serv, title_one_serv=:title_one_serv, desc_one_serv=:desc_one_serv, icon_two_serv=:icon_two_serv, title_two_serv=:title_two_serv, desc_two_serv=:desc_two_serv, icon_three_serv=:icon_three_serv, title_three_serv=:title_three_serv, desc_three_serv=:desc_three_serv, modified=NOW() WHERE id=:id";
        $edit_top = $this->conn->prepare($query_top);
        $edit_top->bindParam(':title_serv', $this->dados['title_serv']);
        $edit_top->bindParam(':subtitle_serv', $this->dados['subtitle_serv']);
        $edit_top->bindParam(':icone_one_serv', $this->dados['icone_one_serv']);
        $edit_top->bindParam(':title_one_serv', $this->dados['title_one_serv']);
        $edit_top->bindParam(':desc_one_serv', $this->dados['desc_one_serv']);
        
        $edit_top->bindParam(':icon_two_serv', $this->dados['icon_two_serv']);
        $edit_top->bindParam(':title_two_serv', $this->dados['title_two_serv']);
        $edit_top->bindParam(':desc_two_serv', $this->dados['desc_two_serv']);
        
        $edit_top->bindParam(':icon_three_serv', $this->dados['icon_three_serv']);
        $edit_top->bindParam(':title_three_serv', $this->dados['title_three_serv']);
        $edit_top->bindParam(':desc_three_serv', $this->dados['desc_three_serv']);
        $edit_top->bindParam(':id', $this->dados['id'], PDO::PARAM_INT);
        $edit_top->execute();
        
        if($edit_top->rowCount()){
            $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Conteúdo do serviço da página home editado com sucesso!</div>';
            return true;
        }else{
            $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro: Conteúdo do serviço da página home não editado com sucesso!</div>';
            return false;
        }
    }


}

?>