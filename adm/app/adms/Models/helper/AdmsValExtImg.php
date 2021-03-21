<?php
namespace App\adms\Models\helper;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsValExtImg Helper. Responsible for validating the image extension.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsValExtImg
{
    private string $mimeType;
    private bool $result;

    function getResult(): bool {
        return $this->result;
    }

    public function valExtImg($mimeType) {
        $this->mimeType = $mimeType;
        switch ($this->mimeType):
            case 'image/jpeg':
            case 'image/pjpeg':
                $this->result = true;
                break;
            case 'image/png':
            case 'image/x-png':
                $this->result = true;
                break;
            default:
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Necessário selecionar imagem JPEG ou PNG!</div>";
                $this->result = false;
        endswitch;
    }
    

}

?>