<?php
namespace App\adms\Models\helper;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe AdmsUpload responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsUpload
{

    private string $diretorio;
    private string $tmpName;
    private string $name;
    private bool $resultado;

    function getResultado(): bool {
        return $this->resultado;
    }
    
    public function upload($diretorio, $tmpName, $name) {
        $this->diretorio = (string) $diretorio;
        $this->tmpName = (string) $tmpName;
        $this->name = (string) $name;

        if($this->valDiretorio()) {
            $this->uploadFile();
        }else {
            $this->resultado = false;
        }
    }

    private function valDiretorio() {
        if(!file_exists($this->diretorio) && !is_dir($this->diretorio)){
            mkdir($this->diretorio);
            if(!file_exists($this->diretorio) && !is_dir($this->diretorio)){
                $_SESSION['msg'] = "Erro: Upload não realizado com sucesso. Tente novamente!";
                return false;
            }else{
                return true;
            }
        }else{
            return true;
        }
    }

    private function uploadFile() {
        if(move_uploaded_file($this->tmpName, $this->diretorio . $this->name)) {
            $this->resultado = true;

        } else {
            $_SESSION['msg'] = "Erro: Upload não realizado. Tente novamente!<br>";
            return false;
        }
    }

}

?>