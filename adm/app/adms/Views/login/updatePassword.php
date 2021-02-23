<?php
if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
if(isset($this->dados['form'])) {
    $valorForm = $this->dados['form'];
}

?>
    <h1>Atualizar a senha</h1>
    <?php   
        if(isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }   
    ?>
        <span class="msg>"></span>
    
        <form id="" method="POST" action="">

            <label>Senha</label>
            <input name="password" type="password" id="password" placeholder="Digite a senha" onkeyup="passwordStrength()">
            <span id="msgViewStrength"></span><br><br>

            <input name="UpPassword" type="submit" value="Salvar">

        </form>

        <p><a href="<?php echo URLADM; ?>login/index">Acessar</a></p>
        
