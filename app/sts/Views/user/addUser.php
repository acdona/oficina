<?php
if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
if (isset($this->dados['form'])) {
    $valorForm = $this->dados['form'];
}

echo "<h3>Cadastrar Usuário</h3>";

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<span class="msg"></span>
<form id="add_user" method="POST" action="">
    <label>Nome: *</label>
    <input name="name" type="text" id="name" placeholder="Nome completo" value="<?php
    if (isset($valorForm['name'])) {
        echo $valorForm['name'];
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

    <label>Situação: *</label>
    <select name="adms_sits_user_id" name="adms_sits_user_id">
        <option value="">Selecione</option>

        <?php
         
            foreach ($this->dados['select']['sit'] as $sit) {
                extract($sit);
                if ((isset($valorForm['adms_sits_user_id'])) AND $valorForm['adms_sits_user_id'] == $id_sit){

                    echo "<option value='$id_sit' selected>$name_sit</option>";
                } else {
                    echo "<option value='$id_sit'>$name_sit</option>";

                }
            }
         
        ?>
          
    </select><br><br>


    <label>Senha: *</label>
    <input name="password" type="password" id="password" placeholder="Digite a senha" onkeyup="passwordStrength()">
    <span id="msgViewStrength"></span><br><br>

    <input name="AddUser" type="submit" value="Cadastrar">  
</form>
