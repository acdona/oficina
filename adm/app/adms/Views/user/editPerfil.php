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

echo "<h3>Editar o Perfil</h3>";

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<span class="msg"></span>
<form id="edit_perfil" method="POST" action="">
   
    
    <label>Nome: *</label>
    <input name="name" type="text" id="name" placeholder="Nome completo" value="<?php
    if (isset($valorForm['name'])) {
        echo $valorForm['name'];
    }
    ?>"><br><br>
    
    <label>Apelido:</label>
    <input name="nickname" type="text" id="nickname" placeholder="Apelido" value="<?php
    if (isset($valorForm['nickname'])) {
        echo $valorForm['nickname'];
    }
    ?>"><br><br>    

    <label>E-mail: *</label>
    <input name="email" type="text" id="email" placeholder="Melhor e-mail" value="<?php
    if (isset($valorForm['email'])) {
        echo $valorForm['email'];
    }
    ?>"><br><br>

    <label>Usuário: *</label>
    <input name="username" type="text" id="username" placeholder="Usuário para acessar o login" value="<?php
    if (isset($valorForm['username'])) {
        echo $valorForm['username'];
    }
    ?>"><br><br>

    <p>( * ) Campos obrigatórios</p><br>

    <input name="EditPerfil" type="submit" value="Salvar">  
</form>


