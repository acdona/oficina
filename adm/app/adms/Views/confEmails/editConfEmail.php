<?php
if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

if (isset($this->data['form'])) {
    $formData = $this->data['form'];
}

if (isset($this->data['form'][0])) {
    $formData = $this->data['form'][0];
}

if (isset($formData['id'])) {
    $id = $formData['id'];
}

?>

<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 title">Editar configuração de Email</h2>
                </div>
                <div class="p-2">
                <span class="d-none d-lg-block">

                    <a href="<?php echo URLADM ?>list-conf-emails/index" class="btn btn-outline-info btn-sm">Listar</a>
                    
                    <a href="<?php echo URLADM . 'delete-conf-email/index/' . $id; ?>" class="btn btn-outline-danger btn-sm" data-confirm="Excluir">Apagar</a> 
                </span>
                </div>

                <div class="dropdown d-block d-lg-none">
                                <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Ações
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                    <a class="dropdown-item" href="<?php echo URLADM ?>list-conf-emails/index" class="btn btn-outline-info btn-sm">Listar</a>
                                    <a class="dropdown-item" href="<?php echo URLADM . 'delete-conf-email/index/' . $id; ?>" data-confirm="Excluir">Apagar</a>
                                </div>
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

        <form id="edit_conf_email" method="POST" action="">
            <input class="form-control"name="id" type="hidden" id="id" value="<?php
            if (isset($formData['id'])) {
                echo $formData['id'];
            }
            ?>">

            <label>Título:*</label>
            <input class="form-control" name="title" type="text" id="title" placeholder="Título para identificar o e-mail" value="<?php
            if (isset($formData['title'])) {
                echo $formData['title'];
            }
            ?>"><br>
        
            <label>Nome:*</label>
            <input class="form-control" name="name" type="text" id="name" placeholder="Nome que será apresentado no remetente" value="<?php
            if (isset($formData['name'])) {
                echo $formData['name'];
            }
            ?>">
        
            <label>E-mail:*</label>
            <input class="form-control" name="email" type="text" id="email" placeholder="E-mail que será apresentado no remetente" value="<?php
            if (isset($formData['email'])) {
                echo $formData['email'];
            }
            ?>">
            
            <label>Host:*</label>
            <input class="form-control" name="host" type="text" id="host" placeholder="Servidor utilizado para enviar o e-mail" value="<?php
            if (isset($formData['host'])) {
                echo $formData['host'];
            }
            ?>">
            
            <label>Usuário:*</label>
            <input class="form-control" name="username" type="text" id="username" placeholder="Usuário do e-mail, na maioria dos casos é o próprio e-mail" value="<?php
            if (isset($formData['username'])) {
                echo $formData['username'];
            }
            ?>">
            
            <label>SMTP:*</label>
            <input class="form-control" name="smtpsecure" type="text" id="smtpsecure" placeholder="SMTP" value="<?php
            if (isset($formData['smtpsecure'])) {
                echo $formData['smtpsecure'];
            }
            ?>">
            
            <label>Porta:*</label>
            <input class="form-control" name="port" type="text" id="port" placeholder="Porta utilizada para enviar o e-mail" value="<?php
            if (isset($formData['port'])) {
                echo $formData['port'];
            }
            ?>">
            <p>
                <span class="text-danger">*</span> Campo Obrigatório
            </p>

            <input class="btn btn-outline-warning btn-sm" name="EditConfEmail" type="submit" value="Salvar">  
        </form>
    </div>
</div>
