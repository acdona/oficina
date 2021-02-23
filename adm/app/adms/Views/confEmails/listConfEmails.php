<?php
if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

echo "<h3>Listar E-mail</h3>";

echo "<a href='" . URLADM . "add-conf-emails/index'>Cadastrar</a><br>";

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

echo "<hr>";

foreach ($this->dados['listConfEmails'] as $confEmails) {
    extract($confEmails);
    echo "ID: " . $id . "<br>";
    echo "Título: " . $title . "<br>";
    echo "Nome: " . $name . "<br>";
    echo "E-mail: " . $email . "<br>";
    echo "<a href='" . URLADM . "view-conf-emails/index/$id'>Visualizar</a><br>";
    echo "<a href='" . URLADM . "edit-conf-emails/index/$id'>Editar</a><br>";
    echo "<a href='" . URLADM . "delete-conf-emails/index/$id'>Apagar</a><br>";
    echo "<hr>";
}
