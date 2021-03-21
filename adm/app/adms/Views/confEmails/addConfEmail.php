<?php
if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}
if (isset($this->data['form'])) {
    $formData = $this->data['form'];
}
?>

<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 title">Cadastrar E-mail de Configuração</h2>
            </div>
            <div class="p-2">
                <a href="<?php echo URLADM; ?>list-conf-emails/index" class="btn btn-outline-info btn-sm">Listar</a>
            </div>
        </div>
        <hr class="hr-title">
        <span class="msg"></span>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <form id="add_conf_email" method="POST" action="">
 
            <div class="form-group">
                <label for="title"><span class="text-danger">*</span> Título:</label>
                <input name="title" type="text" class="form-control" id="title" placeholder="Título para identificar o e-mail" value="<?php
                if (isset($formData['title'])) {
                    echo $formData['title'];
                }
                ?>" required autofocus>
            </div>

            <div class="form-group">  
                <label for="name"><span class="text-danger">*</span>Nome:</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Nome" value="<?php
                if (isset($formData['name'])) {
                    echo $formData['name'];
                }
                ?>" required> 
            </div>
    
            <div class="form-group">
                <label for="email"><span class="text-danger">*</span> E-mail:</label>
                <input name="email" type="text" class="form-control" id="email" placeholder="E-mail que será apresentado no remetente" value="<?php
                if (isset($formData['email'])) {
                    echo $formData['email'];
                }
                ?>" required>
            </div>
    
            <div class="form-group">
                <label for="host"><span class="text-danger">*</span> Host:</label>
                <input name="host" type="text" class="form-control" id="host" placeholder="Servidor utilizado para enviar o e-mail" value="<?php
                if (isset($formData['host'])) {
                    echo $formData['host'];
                }
                ?>" required>
            </div>

            <div class="form-group">    
                <label for="username"><span class="text-danger">*</span> Usuário:</label>
                <input name="username" type="text" class="form-control"  id="username" placeholder="Usuário do e-mail, na maioria dos casos é o próprio e-mail" value="<?php
                if (isset($formData['username'])) {
                    echo $formData['username'];
                }
                ?>" required>
            </div>
    
            <div class="form-group">
                <label for="password"><span class="text-danger">*</span> Senha:</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Senha do e-mail" value="<?php
                if (isset($formData['password'])) {
                    echo $formData['password'];
                }
                ?>" required>
            </div>

            <div class="form-group">    
                <label for="smtpsecure"><span class="text-danger">*</span> SMTP:</label>
                <input name="smtpsecure" type="text" class="form-control" id="smtpsecure" placeholder="SMTP secure" value="<?php
                if (isset($formData['smtpsecure'])) {
                    echo $formData['smtpsecure'];
                }
                ?>" required>
            </div>

            <div class="form-group">                 
                <label for="port"><span class="text-danger">*</span> Porta:</label>
                <input name="port" type="text" class="form-control" id="port" placeholder="Porta utilizada para enviar o e-mail" value="<?php
                if (isset($formData['port'])) {
                    echo $formData['port'];
                }
                ?>" required>
            </div>


            <p>
                <span class="text-danger">*</span> Campos Obrigatórios
            </p>

            <input name="AddConfEmail" type="submit" class="btn btn-outline-success btn-sm" value="Cadastrar"> 

        </form>

    </div>
</div>



