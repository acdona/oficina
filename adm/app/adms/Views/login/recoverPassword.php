<?php
if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
if (isset($this->dados['form'])) {
    $valorForm = $this->dados['form'];
}
?>
<h1>Recuperar Senha</h1>
<?php
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<span class="msg"></span>
<form id="new_conf_email" method="POST" action="">
    <label>E-mail</label>
    <input name="email" type="text" id="email" placeholder="Digite o e-mail cadastrado" value="<?php
    if (isset($valorForm['email'])) {
        echo $valorForm['email'];
    }
    ?>"><br><br>

    <input name="RecoverPassword" type="submit" value="Recuperar">  
</form>

<p><a href="<?php echo URLADM; ?>login/index">Acessar</a></p>

