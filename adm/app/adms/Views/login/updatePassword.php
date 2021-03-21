<?php
if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
if(isset($this->data['form'])) {
    $formData = $this->data['form'];
}

?>
<form id="update_password" method="POST" action="" class="form-signin">
    <div class="text-center mb-4">
        <img class="mb-4" src="<?php echo URLADM; ?>app/adms/assets/images/login/amacd-2021-novo-verde.png" alt="AMACD" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal text-light">Atualizar a Senha</h1>
    </div>
    <?php   
        if(isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }   
    ?>
        <span class="msg>"></span>
        <div class="form-label-group">
        <label for="password">Senha</label><br><br>
        <input name="password" type="password" id="password" class="form-control" placeholder="Digite a senha" value="<?php
        if (isset($formData['password'])) {
            echo $formData['password'];
        }
        ?>" onkeyup="passwordStrength()" required>
        
        <span id="msgViewStrength"></span>
    </div><br>

    <input name="UpPassword" type="submit" value="Salvar" class="btn btn-lg btn-primary btn-block">   

    <p class="mt-2 mb-3 text-muted text-center">
        <a href="<?php echo URLADM; ?>login/index" class="text-decoration-none">Clique aqui</a> para acessar.
    </p> 
</form>