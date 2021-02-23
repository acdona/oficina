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

echo "<h3>Editar a Senha</h3>";

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<span class="msg"></span>
<form id="update_password" method="POST" action="">
  
    <label>Senha: *</label>
    <input name="password" type="password" id="password" placeholder="Digite a senha" onkeyup="passwordStrength()">
    <span id="msgViewStrength"></span><br><br>
    
     <p>( * ) Campos obrigatórios</p><br>

    <input name="EditPerfilPass" type="submit" value="Salvar">  
</form>

