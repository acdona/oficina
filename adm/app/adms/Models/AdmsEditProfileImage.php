<?php

namespace App\adms\Models;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsEditProfileImage Models. Responsible for editing the profile image.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsEditProfileImage 
{
    private $databaseResult;
    private bool $result;
    private array $data;
    private $imageData;
    private $directory;
    private array $saveData;
    private string $delImg;
    private string $nameImg;
    
    function getDatabaseResult() {
        return $this->databaseResult;
    }

    function getResult(): bool {
        return $this->result;
    }

    public function viewProfile() {
        $viewProfile = new \App\adms\Models\helper\AdmsRead();
        $viewProfile->fullRead("SELECT id, image
                FROM adms_users
                WHERE id=:id
                LIMIT :limit ", 
                "id={$_SESSION['user_id']}&limit=1");
        $this->databaseResult = $viewProfile->getReadingResult();
        if($this->databaseResult){
            $this->result = true;
            return true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Usuário não encontrado!</div>";
            $this->result = false;
            return false;
        }
    }

    public function update(array $data) {
        $this->data = $data;

        $this->imageData = $this->data['new_image'];
        unset($this->data['new_image'], $this->data['image']);

        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->validateData($this->data);
        if ($valEmptyField->getResult()) {
            if (!empty($this->imageData['name'])) {
                $this->valInput();
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Necessário selecionar uma imagem!</div>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }

    private function valInput() {
        $valExtImg = new \App\adms\Models\helper\AdmsValExtImg();
        $valExtImg->valExtImg($this->imageData['type']);
        if ($this->viewProfile() AND $valExtImg->getResult()) {
            $this->upload();
        } else {
            $this->result = false;
        }
    }

    private function upload() {
        $slugImg = new \App\adms\Models\helper\AdmsSlug();
        $this->nameImg = $slugImg->slug($this->imageData['name']);

        $this->directory = "app/adms/assets/images/users/" . $_SESSION['user_id'] . "/";

        $uploadImgRed = new \App\adms\Models\helper\AdmsUploadImgRed();
        $uploadImgRed->upload($this->imageData, $this->directory, $this->nameImg, 300, 300);

        if ($uploadImgRed->getResult()) {
            $this->edit();
        } else {
            $this->result = false;
        }
    }

    private function edit() {
        $this->saveData['image'] = $this->nameImg;
        $this->saveData['modified'] = date("Y-m-d H:i:s");

        $upUser = new \App\adms\Models\helper\AdmsUpdate();
        $upUser->exeUpdate("adms_users", $this->saveData, "WHERE id =:id", "id={$_SESSION['user_id']}");

        if ($upUser->getResult()) {
            $this->deleteImage();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Imagem não editada com sucesso!</div>";
            $this->result = false;
        }
    }

    private function deleteImage() {
        if ((!empty($this->databaseResult[0]['image']) OR ($this->databaseResult[0]['image'] != null)) AND ($this->databaseResult[0]['image'] != $this->nameImg)) {
            $this->delImg = "app/adms/assets/images/users/" . $_SESSION['user_id'] . "/" . $this->databaseResult[0]['image'];
            if (file_exists($this->delImg)) {
                unlink($this->delImg);
            }
        }

        $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Imagem editada com sucesso!</div>";
        $this->result = true;
    }    
}
