<?php
if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

if (isset($this->dados['form'])) {
    $valorForm = $this->dados['form'];
}
?>
<h1>Novo Usuário</h1>
<?php
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<span class="msg"></span>
<form id="new_user" method="POST" action="">
    <label>Nome</label>
    <input name="name" type="text" id="name" placeholder="Digite o nome completo" value="<?php
    if (isset($valorForm['name'])) {
        echo $valorForm['name'];
    }
    ?>"><br><br>
    
    <label>E-mail</label>
    <input name="email" type="text" id="email" placeholder="Digite o seu melhor e-mail" value="<?php
    if (isset($valorForm['email'])) {
        echo $valorForm['email'];
    }
    ?>"><br><br>

    <label>Senha</label>
    <input name="password" type="password" id="password" placeholder="Digite a senha" onkeyup="passwordStrength()">
    <span id="msgViewStrength"></span><br><br>

    <input name="SendNewUser" type="submit" value="Cadastrar">  
</form>

<p><a href="<?php echo URLADM; ?>login/index">Clique aqui</a> para acessar</p>