<?php
namespace App\adms\Models\helper;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsUploadImgRed Helper. Responsible for uploading the reduced image. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsUploadImgRed
{

    private array $imageData;
    private string $directory;
    private string $name;
    private $width;
    private $height;
    private $newImage;
    private bool $result;
    private $resizedImage;

    function getResult(): bool {
        return $this->result;
    }

    public function upload(array $imageData, $directory, $name, $width, $height) {
        $this->imageData = $imageData;
        $this->directory = $directory;
        $this->name = (string) $name;
        $this->width = $width;
        $this->height = $height;

        if ($this->valdirectory()) {
            $this->uploadFile();
        } else {
            $this->result = false;
        }
    }

    private function valdirectory() {
        if (file_exists($this->directory) && (!is_dir($this->directory))) {
            if ($this->createDir()) {
                return true;
            } else {
                return false;
            }
        } elseif (!file_exists($this->directory)) {
            if ($this->createDir()) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    private function createDir() {
        mkdir($this->directory, 0755);
        if (!file_exists($this->directory)) {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Upload da imagem não realizado. Tente novamente!</div>";
            return false;
        } else {
            return true;
        }
    }

    private function uploadFile() {
        switch ($this->imageData['type']):
            case 'image/jpeg':
            case 'image/pjpeg':
                $this->uploadFileJpeg();
                break;
            case 'image/png':
            case 'image/x-png':
                $this->uploadFilePng();
                break;
            default:
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Necessário selecionar imagem JPEG ou PNG!</div>";
                $this->result = false;
        endswitch;
    }

    private function uploadFileJpeg() {
        //Creates a new image from a file or URL.
        $this->newImage = imagecreatefromjpeg($this->imageData['tmp_name']);

        $this->redImg();

        //Uploading the image to the server.
        if (imagejpeg($this->resizedImage, $this->directory . $this->name, 100)) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Upload da imagem realizado com sucesso!</div>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Upload da imagem não realizado. Tente novamente!</div>";
            $this->result = false;
        }
    }

    private function uploadFilePng() {
        //Creates a new image from a file or URL.
        $this->newImage = imagecreatefrompng($this->imageData['tmp_name']);

        $this->redImg();

        //Uploading the image to the server.
        if (imagepng($this->resizedImage, $this->directory . $this->name, 1)) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Upload da imagem realizado com sucesso!</div>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Upload da imagem não realizado com sucesso. Tente novamente!</div>";
            $this->result = false;
        }
    }

    private function redImg() {
        //Get the image width.
        $width_original = imagesx($this->newImage);
        //Get the image height.
        $height_original = imagesy($this->newImage);

        //Create a model image with the defined dimensions.
        $this->resizedImage = imagecreatetruecolor($this->width, $this->height);

        //Copies and resizes part of the image upload by the user and interpolates with the model size image.
        imagecopyresampled($this->resizedImage, $this->newImage, 0, 0, 0, 0, $this->width, $this->height, $width_original, $height_original);
    }

}

?>