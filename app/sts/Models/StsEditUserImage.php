<?php
namespace App\sts\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe StsEditUserImage responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsEditUserImage
{

    
    private $resultadoBd;
    private bool $resultado;
    private int $id;
    private array $dados;
    private $dadosImage;
    private $diretorio;
    private $saveDate;
    private $delImg;
    private string $nameImg;

    function getResultado(): bool {
        return $this->resultado;
    }

    function getResultadoBd() {
        return $this->resultadoBd;
    }

    public function viewUser($id) {
        $this->id = (int) $id;
        $viewUser = new \App\sts\Models\helper\stsRead();
        $viewUser->fullRead("SELECT id, image
                FROM sts_users
                WHERE id=:id
                LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultadoBd = $viewUser->getResult();
        if ($this->resultadoBd) {
            $this->resultado = true;
            return true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Usuário não encontrado!</div>";
            $this->resultado = false;
            return false;
        }
    }

    public function update(array $dados) {
        $this->dados = $dados;

        $this->dadosImage = $this->dados['new_image'];
        unset($this->dados['new_image'], $this->dados['image']);

        $valCampoVazio = new \App\sts\Models\helper\stsValCampoVazio();
        $valCampoVazio->validarDados($this->dados);
        if ($valCampoVazio->getResultado()) {
            if (!empty($this->dadosImage['name'])) {
                $this->valInput();
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Necessário selecionar uma imagem!</div>";
                $this->resultado = false;
            }
        } else {
            $this->resultado = false;
        }
    }

    private function valInput() {
        $valExtImg = new \App\sts\Models\helper\stsValExtImg();
        $valExtImg->valExtImg($this->dadosImage['type']);
        if ($this->viewUser($this->dados['id']) AND $valExtImg->getResultado()) {
            $this->upload();
        } else {
            $this->resultado = false;
        }
    }

    private function upload() {
        $slugImg = new \App\sts\Models\helper\stsSlug();
        $this->nameImg = $slugImg->slug($this->dadosImage['name']);

        $this->diretorio = "app/sts/assets/images/users/" . $this->dados['id'] . "/";

        //$uploadImg = new \App\sts\Models\helper\stsUpload();
        //$uploadImg->upload($this->diretorio, $this->dadosImage['tmp_name'], $this->nameImg);

        $uploadImgRed = new \App\sts\Models\helper\StsUploadImgRed();
        $uploadImgRed->upload($this->dadosImage, $this->diretorio, $this->nameImg, 300, 300);

        if ($uploadImgRed->getResultado()) {
            $this->edit();
        } else {
            $this->resultado = false;
        }
    }

    private function edit() {
        $this->saveDate['image'] = $this->nameImg;
        $this->saveDate['modified'] = date("Y-m-d H:i:s");

        $upUser = new \App\sts\Models\helper\stsUpdate();
        $upUser->exeUpdate("sts_users", $this->saveDate, "WHERE id =:id", "id={$this->dados['id']}");

        if ($upUser->getResult()) {
            $this->deleteImage();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Imagem do usuário não editada!</div>";
            $this->resultado = false;
        }
    }

    private function deleteImage() {
        if ((!empty($this->resultadoBd[0]['image']) OR ($this->resultadoBd[0]['image'] != null)) AND ($this->resultadoBd[0]['image'] != $this->nameImg)) {
            $this->delImg = "app/sts/assets/images/users/" . $this->dados['id'] . "/" . $this->resultadoBd[0]['image'];
            if (file_exists($this->delImg)) {
                unlink($this->delImg);
            }
        }

        $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Imagem do usuário editada com sucesso!</div>";
        $this->resultado = true;
    }

}

?>