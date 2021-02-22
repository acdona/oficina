<?php
if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
//Criptografar a senha
//echo password_hash(123456, PASSWORD_DEFAULT);

if (isset($this->dados['form'])) {
    $valorForm = $this->dados['form'];
}
?>

<form method="POST" action="" class="form-signin">
    <img class="mb-4" src="<?php echo URLADM; ?>app/adms/assets/imagens/login/logo.png" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Área restrita</h1>
    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>

    <label for="user" class="sr-only">Usuário</label>
    <input name="user" type="text" id="user" class="form-control mb-4" placeholder="Digite o usuário" value="<?php
    if (isset($valorForm['user'])) {
        echo $valorForm['user'];
    }
    ?>" required autofocus>

    <label for="password" class="sr-only">Senha</label>
    <input name="password" type="password" id="password" class="form-control" placeholder="Digite a senha" required>

    <input name="SendLogin" type="submit" value="Acessar" class="btn btn-lg btn-primary btn-block">

    <p><a href="#">Cadastrar</a> - <a href="#">Esqueceu a senha?</a></p>
</form>