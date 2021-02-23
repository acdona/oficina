<?php
if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

if (isset($this->dados['form'])) {
    $valorForm = $this->dados['form'];
}

if (isset($this->dados['form'][0])) {
    $valorForm = $this->dados['form'][0];
}

echo "<h3>Editar Senha do E-mail</h3>";

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}


echo "<br>";

if (isset($valorForm['id'])) {
    $id = $valorForm['id'];
    echo "<a href='" . URLADM . "list-conf-emails/index'>Listar</a><br>";
    echo "<a href='" . URLADM . "delete-conf-emails/index/$id'>Apagar</a><br>";
}
?>
<span class="msg"></span>
<form id="edit_conf_email_pass" method="POST" action="">
    <input name="id" type="hidden" id="id" value="<?php
    if (isset($valorForm['id'])) {
        echo $valorForm['id'];
    }
    ?>">

    <label>Senha:*</label>
    <input name="password" type="password" id="password" placeholder="Senha do e-mail" value="<?php
    if (isset($valorForm['password'])) {
        echo $valorForm['password'];
    }
    ?>"><br><br>

    <p>( * ) Campos obrigatórios</p><br>

    <input name="EditConfEmailsPass" type="submit" value="Salvar">  
</form>
