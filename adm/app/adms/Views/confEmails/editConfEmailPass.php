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
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 title">Editar Senha do E-mail</h2>
            </div>
            <?php
            if (!empty($formData)) {
                extract($formData);
                ?>
                <div class="p-2">
                    <span class="d-none d-lg-block">
                        <a href="<?php echo URLADM; ?>list-conf-emails/index" class="btn btn-outline-info btn-sm">Listar</a>
                        <a href="<?php echo URLADM . 'view-conf-email/index/' . $id; ?>" class="btn btn-outline-primary btn-sm">Visualizar</a>
                        <a href="<?php echo URLADM . 'edit-conf-email/index/' . $id; ?>" class="btn btn-outline-warning btn-sm">Editar</a>
                        <a href="<?php echo URLADM . 'delete-conf-email/index/' . $id; ?>" class="btn btn-outline-danger btn-sm" data-confirm="Excluir">Apagar</a> 
                    </span>
                    <div class="dropdown d-block d-lg-none">
                        <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                            <a class="dropdown-item" href="<?php echo URLADM; ?>list-conf-emails/index">Listar</a>
                            <a class="dropdown-item" href="<?php echo URLADM . 'view-conf-email/index/' . $id; ?>">Visualizar</a>
                            <a class="dropdown-item" href="<?php echo URLADM . 'edit-conf-email/index/' . $id; ?>">Editar</a>
                            <a class="dropdown-item" href="<?php echo URLADM . 'delete-conf-email/index/' . $id; ?>" data-confirm="Excluir">Apagar</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <hr class="hr-title">

        <span class="msg"></span>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <form id="edit_conf_email_pass" method="POST" action="">
            <input name="id" type="hidden" id="id" value="<?php
            if (isset($formData['id'])) {
                echo $formData['id'];
            }
            ?>">

            <div class="form-group">
                <label for="password"><span class="text-danger">*</span> Senha:</label>
                <input name="password" type="text" class="form-control" id="password" placeholder="Senha do e-mail"  value="<?php
                if (isset($formData['password'])) {
                    echo $formData['password'];
                }
                ?>" required>
            </div>

            <p>
                <span class="text-danger">*</span> Campo Obrigatório
            </p>

            <input name="EditConfEmailPass" type="submit" class="btn btn-outline-warning btn-sm" value="Salvar"> 

        </form>
    </div>
</div>