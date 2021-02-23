<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe AdmsEditPerfilImage responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsEditPerfilImage
{

    private $resultadoBd;
    private bool $resultado;
    private array $dados;
    private $dadosImage;
    private $diretorio;
    private array $saveData;
    private string $delImg;
    private string $nameImg;

 
    function getResultadoBd() {
        return $this->resultadoBd;
    }

    function getResultado() {
        return $this->resultado;
    }

    public function viewPerfil()
    {
       $viewPerfil = new \App\adms\Models\helper\AdmsRead();
       $viewPerfil->fullRead("SELECT id, image_user 
                              FROM adms_users 
                              WHERE id=:id 
                              LIMIT :limit ", "id={$_SESSION['user_id']}&limit=1");
        $this->resultadoBd = $viewPerfil->getResult();
        if($this->resultadoBd) {
                $this->resultado = true;
                return true;
        } else { 
            $_SESSION['msg'] = "Erro: Usuário não encontrado!<br>" ;
            $this->resultado = false;
            return false;
        }
    }
    
    public function update(array $dados) {
        $this->dados = $dados;

        $this->dadosImage = $this->dados['new_image'];
        unset($this->dados['new_image'], $this->dados['image']);

        $valCampoVazio = new \App\adms\Models\helper\AdmsValCampoVazio();
        $valCampoVazio->validarDados($this->dados);
        if ($valCampoVazio->getResultado()) {

            if (!empty($this->dadosImage['name'])) {
                $this->valInput();
            } else {
                $_SESSION['msg'] = "Erro: Necessário selecionar uma imagem!<br>";
                $this->resultado = false;
            }
        } else {
            $this->resultado = false;
        }  
    }

    private function valInput() {
        $valExtImg = new \App\adms\Models\helper\AdmsValExtImg();
        $valExtImg->valExtImg($this->dadosImage['type']);
        if ($this->viewPerfil() AND $valExtImg->getResultado()) {
            $this->upload();
        } else {
            $this->resultado = false;
        }
    }

    private function upload() {
        $slugImg = new \App\adms\Models\helper\AdmsSlug();
        $this->nameImg = $slugImg->slug($this->dadosImage['name']);
        
        $this->diretorio = "app/adms/assets/images/users/" . $_SESSION['user_id'] . "/";
        
       $uploadImgRed = new \App\adms\Models\helper\AdmsUploadImgRed();
       $uploadImgRed->upload($this->dadosImage,$this->diretorio, $this->nameImg, 300, 300);

        if($uploadImgRed->getResultado()){
            $this->edit();
        }else{
            $this->resultado = false;
        }
    }

    private function edit() {
        $this->saveData['image_user'] = $this->nameImg;
        $this->saveData['modified'] = date("Y-m-d H:i:s");

        $upUser = new \App\adms\Models\helper\AdmsUpdate();
        $upUser->exeUpdate("adms_users", $this->saveData, "WHERE id =:id", "id={$_SESSION['user_id']}");

        if ($upUser->getResult()) {
         
            $this->deleteImage();
        } else {
            $_SESSION['msg'] = "Erro: Imagem não editada com sucesso!<br>";
            $this->resultado = false;
        }
    }

    private function deleteImage() {
        if ((!empty($this->resultadoBd[0]['image_user']) OR ($this->resultadoBd[0]['image_user'] != null)) AND ($this->resultadoBd[0]['image_user'] != $this->nameImg)) {
            $this->delImg = "app/adms/assets/images/users/" . $_SESSION['user_id'] . "/" . $this->resultadoBd[0]['image_user'];
            if (file_exists ($this->delImg)) {
                unlink($this->delImg);
            }
        }
           $_SESSION['msg'] = "Imagem editada com sucesso!<br>";
           $this->resultado = true;
    }

}

?>