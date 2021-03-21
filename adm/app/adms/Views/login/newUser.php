<?php

    if (!defined('R4F5CC')) { 
        header("Location: /");
        die("Erro: Página não encontrada!");
    }


if (isset($this->data['form'])) {
    $valForm = $this->data['form'];
}


?>
        
          
<form id="new_user" class="form-signin" method="POST" action="">

    <div class="text-center- mb-4">
        <img class="mb-4" src="<?php echo URLADM; ?>app/adms/assets/images/login/amacd-2021-novo-branco.png" alt="AMACD" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Novo Usuário</h1>
    </div> 

    <?php         
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }       
    ?>

    <span class="msg"></span>

        <div class="form-label-group">
            
            <input name="name" type="text" id="name" class="form-control" placeholder="Digite o nome completo" value="<?php
            if (isset($valForm['name'])) {
                echo $valForm['name'];
            }
            ?>" required autofocus>
            <label>Nome</label>
        </div>

        <div class="form-label-group">
            
            <input name="email" type="text" id="email" class="form-control" placeholder="Digite o seu melhor e-mail" value="<?php
            if (isset($valForm['email'])) {
                echo $valForm['email'];
            }
            ?>">
            <label>E-mail</label>
        </div>

        <div class="form-label-group">
            
            <input name="password" type="password" id="password" class="form-control" placeholder="Digite a senha" value="<?php
                if (isset($valorForm['password'])) {
                   echo $valorForm['password'];
                }
                ?>" onkeyup="passwordStrength()" required>
            <label for="password">Senha</label>
            <span id="msgViewStrength"></span>
        </div>

        <input name="SendNewUser" type="submit" class="btn btn-lg btn-primary btn-block" value="Cadastrar">  
        <p class="mt-2 mb-3 text-muted text-center">
         <a href="<?php echo URLADM; ?>login/index"class="text-decoration-none">Clique aqui</a> para acessar
        </p>
</form>

            
        
 