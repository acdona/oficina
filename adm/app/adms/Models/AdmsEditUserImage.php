<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsEditUserImage Model. Responsible for editing the user's image.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsEditUserImage
{

    
    private $databaseResult;
    private bool $result;
    private int $id;
    private array $data;
    private $imageData;
    private $directoy;
    private $saveDate;
    private $deleteImage;
    private string $imageName;

    function getResult(): bool {
        return $this->result;
    }

    function getDatabaseResult() {
        return $this->databaseResult;
    }

    public function viewUser($id) {
        $this->id = (int) $id;
        $viewUser = new \App\adms\Models\helper\AdmsRead();
        $viewUser->fullRead("SELECT usu.id, usu.image
                FROM adms_users usu
                INNER JOIN adms_access_levels As lev ON lev.id=usu.adms_access_level_id
                WHERE usu.id=:id AND lev.order_levels >:order_levels

               
                LIMIT :limit", "id={$this->id}&order_levels=".$_SESSION['order_levels']."&limit=1");

        $this->databaseResult = $viewUser->getReadingResult();
        if ($this->databaseResult) {
            $this->result = true;
            return true;
        } else {
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
        if ($this->viewUser($this->data['id']) AND $valExtImg->getResult()) {
            $this->upload();
        } else {
            $this->result = false;
        }
    }

    private function upload() {
        $slugImg = new \App\adms\Models\helper\AdmsSlug();
        $this->imageName = $slugImg->slug($this->imageData['name']);

        $this->directory = "app/adms/assets/images/users/" . $this->data['id'] . "/";

        $uploadImgRed = new \App\adms\Models\helper\AdmsUploadImgRed();
        $uploadImgRed->upload($this->imageData, $this->directory, $this->imageName, 300, 300);

        if ($uploadImgRed->getResult()) {
            $this->edit();
        } else {
            $this->result = false;
        }
    }

    private function edit() {
        $this->saveDate['image'] = $this->imageName;
        $this->saveDate['modified'] = date("Y-m-d H:i:s");

        $upUser = new \App\adms\Models\helper\AdmsUpdate();
        $upUser->exeUpdate("adms_users", $this->saveDate, "WHERE id =:id", "id={$this->data['id']}");

        if ($upUser->getResult()) {
            $this->deleteImage();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Imagem do usuário não editada!</div>";
            $this->result = false;
        }
    }

    private function deleteImage() {
        if ((!empty($this->databaseResult[0]['image']) OR ($this->databaseResult[0]['image'] != null)) AND ($this->databaseResult[0]['image'] != $this->imageName)) {
            $this->delImg = "app/adms/assets/images/users/" . $this->data['id'] . "/" . $this->databaseResult[0]['image'];
            if (file_exists($this->delImg)) {
                unlink($this->delImg);
            }
        }

        $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Imagem do usuário editada com sucesso!</div>";
        $this->result = true;
    }

}

?>