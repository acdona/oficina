<?php
if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
 
    echo "<h3>Listar Cores</h3>";
    echo "<a href='" . URLADM . "add-colors/index'>Cadastrar</a><br>";
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    echo "<hr>";
    foreach ($this->dados['listColors'] as $user) {
        extract($user);
        echo "ID: " . $id . "<br>";
        echo "Nome: " . $name . "<br>";
        echo "Cor: <span style='color: $color;'>" . $color . "</span><br>";
        echo "<a href='" . URLADM . "view-colors/index/$id'>Vizualizar</a><br>";
        echo "<a href='" . URLADM . "edit-colors/index/$id'>Editar</a><br>";
        echo "<a href='" . URLADM . "delete-colors/index/$id'>Apagar</a><br>";
        echo "<hr>";
    }
?>
