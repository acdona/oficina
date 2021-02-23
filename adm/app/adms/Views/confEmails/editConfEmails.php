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

echo "<h3>Editar E-mail</h3>";

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

if (isset($valorForm['id'])) {
    $id = $valorForm['id'];
    echo "<a href='" . URLADM . "list-conf-emails/index'>Listar</a><br>";
    echo "<a href='" . URLADM . "delete-conf-emails/index/$id'>Apagar</a><br>";
}
?>
<span class="msg"></span>
<form id="edit_conf_email" method="POST" action="">
    <input name="id" type="hidden" id="id" value="<?php
    if (isset($valorForm['id'])) {
        echo $valorForm['id'];
    }
    ?>">

    <label>Título:*</label>
    <input name="title" type="text" id="title" placeholder="Título para identificar o e-mail" value="<?php
    if (isset($valorForm['title'])) {
        echo $valorForm['title'];
    }
    ?>"><br><br>
    
    <label>Nome:*</label>
    <input name="name" type="text" id="name" placeholder="Nome que será apresentado no remetente" value="<?php
    if (isset($valorForm['name'])) {
        echo $valorForm['name'];
    }
    ?>"><br><br>
    
    <label>E-mail:*</label>
    <input name="email" type="text" id="email" placeholder="E-mail que será apresentado no remetente" value="<?php
    if (isset($valorForm['email'])) {
        echo $valorForm['email'];
    }
    ?>"><br><br>
    
    <label>Host:*</label>
    <input name="host" type="text" id="host" placeholder="Servidor utilizado para enviar o e-mail" value="<?php
    if (isset($valorForm['host'])) {
        echo $valorForm['host'];
    }
    ?>"><br><br>
    
    <label>Usuário:*</label>
    <input name="username" type="text" id="username" placeholder="Usuário do e-mail, na maioria dos casos é o próprio e-mail" value="<?php
    if (isset($valorForm['username'])) {
        echo $valorForm['username'];
    }
    ?>"><br><br>
    
    <label>SMTP:*</label>
    <input name="smtpsecure" type="text" id="smtpsecure" placeholder="SMTP" value="<?php
    if (isset($valorForm['smtpsecure'])) {
        echo $valorForm['smtpsecure'];
    }
    ?>"><br><br>
    
    <label>Porta:*</label>
    <input name="port" type="text" id="port" placeholder="Porta utilizada para enviar o e-mail" value="<?php
    if (isset($valorForm['port'])) {
        echo $valorForm['port'];
    }
    ?>"><br><br>

    <p>( * ) Campos obrigatórios</p><br>

    <input name="EditConfEmails" type="submit" value="Salvar">  
</form>
