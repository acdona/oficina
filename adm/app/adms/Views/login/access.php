<?php
if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

// If it exists, keep the data in the form
if (isset($this->data['form'])) {
    $formValue = $this->data['form'];
}
?>

<form id="send_login" method="POST" action="" class="form-signin">

    <div class="text-center mb-4">
        <img class="mb-4" src="<?php echo URLADM; ?>app/adms/assets/images/login/amacd-2021-novo-branco.png" alt="AMACD" width="72" height="72">
        <h3 class="h4 mb-4 font-weight-normal">Área restrita</h3>
    </div>

    <?php
    //If it exists, print the warning message and destroy it
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>

    <span class="msg"></span>

    <div class="form-label-group">
        
        <input name="username" type="text" id="username" class="form-control" placeholder="Digite o usuário ou e-mail" value="<?php
        // If it exists, fill in the field with its value
        if (isset($formValue['username'])) {
            echo $formValue['username'];
        }
        ?>" required autofocus>
        <label for="username">Usuário</label>
    </div>

    <div class="form-label-group">
        
        <input name="password" type="password" id="password" class="form-control" placeholder="Digite a senha" required>
        <label for="password">Senha</label>
    </div>

    <input name="SendLogin" type="submit" value="Acessar" class="btn btn-lg btn-primary btn-block">

    <p class="mt-2 mb-3 text-muted text-center">
        <a href="<?php echo URLADM; ?>new-user/index" class="text-decoration-none">Cadastrar</a> - 
        <a href="<?php echo URLADM; ?>recover-password/index" class="text-decoration-none">Esqueceu a Senha</a>
    </p>

    <p class="mt-2 mb-3 text-muted text-center">
        Usuário: acdona@hotmail.com<br>
        Senha: 123456a
    </p>
</form>

