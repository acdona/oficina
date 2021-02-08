<?php
  if(isset($this->dados['form'])) {
    $valorForm = $this->dados['form'];
 }
 //Criptografar a senha
 //echo password_hash(123456, PASSWORD_DEFAULT);  
?>
<h1>Área Restrita</h1>
<?php
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
?>
<form method="POST" action="">
    <label>Usuário</label>
    <input name="user" type="text" id="user" placeholder="Digite o usuário" value="<?php
    if (isset($valorForm['user'])) {
        echo $valorForm['user'];
    }
    ?>"><br><br>

    <label>Senha</label>
    <input name="password" type="password" id="password" placeholder="Digite a senha"><br><br>

    <input name="SendLogin" type="submit" value="Acessar">
</form>
