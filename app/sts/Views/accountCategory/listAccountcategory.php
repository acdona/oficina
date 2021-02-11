<?php

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

echo "<h3>Listar Categorias</h3>";


if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

echo "<hr>";
                       
foreach ($this->dados['sts_account_categories'] as $account_cat) {
    extract($account_cat);
    echo "ID: " . $id . "<br>";
    echo "Nome: " . $name . "<br>";
    
    // echo "<a href='" . URLADM . "view-users/index/$id'>Visualizar</a><br>";
    // echo "<a href='" . URLADM . "edit-users/index/$id'>Editar</a><br>";
    // echo "<a href='" . URLADM . "delete-users/index/$id'>Apagar</a><br>";
    echo "<hr>";
}

echo $this->dados['pagination'];