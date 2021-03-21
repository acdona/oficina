<?php
if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
if (isset($this->data['form'])) {
    $valForm = $this->data['form'];
}
?>

<form id="new_conf_email" class="form-signin" method="POST" action="">
    <div class="text-center- mb-4">
        <h1 class="h3 mb-3 font-weight-normal">Novo Link</h1>
    </div> 
    <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
    }
    ?>
    <span class="msg"></span>
    <div class="form-label-group ">
                        
        <label>E-mail</label><br><br>
        
        <input name="email" type="text" id="email" placeholder="Digite o e-mail cadastrado" value="<?php
        if (isset($valForm['email'])) {
            echo $valForm['email'];
        }
        ?>"><br><br>
    </div>

    <input name="NewConfEmail" type="submit" value="Enviar">  
    <p color-white><a href="<?php echo URLADM; ?>login/index">Acessar</a></p>
</form>



