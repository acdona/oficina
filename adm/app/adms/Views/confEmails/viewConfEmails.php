<?php
if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

echo "<h3>Detalhes do E-mail</h3>";

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

if (!empty($this->dados['viewConfEmails'])) {
    extract($this->dados['viewConfEmails'][0]);
    echo "ID: " . $id . "<br>";
    echo "Título: " . $title . "<br>";
    echo "Nome: " . $name . "<br>";
    echo "E-mail: " . $email . "<br>";
    echo "Host: " . $host . "<br>";
    echo "Usuário: " . $username . "<br>";
    echo "SMTP: " . $smtpsecure . "<br>";
    echo "Porta: " . $port . "<br>";
    echo "<a href='" . URLADM . "edit-conf-emails/index/$id'>Editar</a><br>";
    echo "<a href='" . URLADM . "edit-conf-emails-password/index/$id'>Editar Senha</a><br>";
    echo "<a href='" . URLADM . "delete-conf-emails/index/$id'>Apagar</a><br>";
}
