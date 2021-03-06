<?php
namespace App\adms\Models\helper;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsValEmptyField Models . Responsible for validating empty field.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsValEmptyField
{

    private array $data;
    private bool $result;

    function getResult(): bool {
        return $this->result;
    }

    public function validateData(array $data) {
        $this->data = $data;
        $this->data = array_map('strip_tags', $this->data);
        $this->data = array_map('trim', $this->data);

        
        if (in_array('', $this->data)) {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher todos os campos!</div>";
            $this->result = false;
        } else {
            $this->result = true;
        }
    }

}

?>