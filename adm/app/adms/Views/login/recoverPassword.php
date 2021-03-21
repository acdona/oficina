<?php
if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
if (isset($this->data['form'])) {
    $formData = $this->data['form'];
}
?>

<span class="msg"></span>
<form id="new_conf_email" method="POST" action="" class="form-signin">

    <div class="text-center mb-4">
        <img class="mb-4" src="<?php echo URLADM; ?>app/adms/assets/images/login/amacd-2021-novo-branco.png" alt="AMACD" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Recuperar a Senha</h1>
    </div>

    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
    <span class="msg"></span>

    <div class="form-label-group">
        
        <input name="email" type="email" id="email" class="form-control" placeholder="Digite o e-mail cadastrado" value="<?php
        if (isset($formData['email'])) {
            echo $formData['email'];
        }
        ?>" required>
        <label for="email">Digite seu email cadastrado</label>
    </div>

    <input name="RecoverPassword" type="submit" value="Recuperar" class="btn btn-lg btn-primary btn-block"> 

    <p class="mt-2 mb-3 text-muted text-center">
        <a href="<?php echo URLADM; ?>login/index" class="text-decoration-none">Clique aqui</a> para acessar.
    </p> 
</form>


