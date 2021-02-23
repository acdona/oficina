<?php
if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}
if (isset($this->dados['form'])) {
    $valorForm = $this->dados['form'];
}

echo "<h3>Cadastrar E-mail</h3>";

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<span class="msg"></span>
<form id="add_conf_email" method="POST" action="">
    
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
    
    <label>Senha:*</label>
    <input name="password" type="password" id="password" placeholder="Senha do e-mail" value="<?php
    if (isset($valorForm['password'])) {
        echo $valorForm['password'];
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

    <input name="AddConfEmails" type="submit" value="Cadastrar">  
</form>

