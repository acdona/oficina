<?php
namespace App\sts\Models\helper;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * Models StsValCampoVazio responsável por validar campo vazio
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsValCampoVazio
{

    private array $dados;
    private bool $resultado;

    function getResultado(): bool {
        return $this->resultado;
    }

    public function validarDados(array $dados) {
        $this->dados = $dados;
        $this->dados = array_map('strip_tags', $this->dados);
        $this->dados = array_map('trim', $this->dados);

        
        if (in_array('', $this->dados)) {
            $_SESSION['msg'] = "Erro: Necessário preencher todos os campos";
            $this->resultado = false;
        } else {
            $this->resultado = true;
        }
    }

}

?>