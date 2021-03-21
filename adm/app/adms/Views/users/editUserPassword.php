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
                <h2 class="display-4 title">Editar a Senha do Usuário Usuário</h2>
            </div>
            <?php
            if (!empty($formData)) {
                extract($formData);
                ?>
                <div class="p-2">
                    <span class="d-none d-lg-block">
                        <a href="<?php echo URLADM; ?>list-users/index" class="btn btn-outline-info btn-sm">Listar</a>
                        <a href="<?php echo URLADM . 'view-user/index/' . $id; ?>" class="btn btn-outline-primary btn-sm">Visualizar</a>
                       
                        <a href="<?php echo URLADM . 'delete-user/index/' . $id; ?>" class="btn btn-outline-danger btn-sm">Apagar</a> 
                    </span>
                    <div class="dropdown d-block d-lg-none">
                        <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                            <a class="dropdown-item" href="<?php echo URLADM; ?>list-users/index">Listar</a>
                            <a class="dropdown-item" href="<?php echo URLADM . 'view-user/index/' . $id; ?>">Visualizar</a>
                           
                            <a class="dropdown-item" href="<?php echo URLADM . 'delete-user/index/' . $id; ?>">Apagar</a>
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


        <form id="update_password" method="POST" action="">
            <input name="id" type="hidden" id="id" value="<?php
                if (isset($formData['id'])) {
                    echo $formData['id'];
                }
            ?>">
            
            <dl class="row">
                <dt class="col-sm-3">
                
                <label>Senha: *</label>
               
                <input name="password" type="password" id="password" placeholder="Digite a senha" onkeyup="passwordStrength()">
                <span id="msgViewStrength"></span><br><br>
                

                <p>
                    <span class="text-danger">*</span> Campo Obrigatório
                </p>
                
                <input name="EditUserPass" type="submit" class="btn btn-outline-warning btn-sm" value="Salvar"> 
                </dt>
            </dl>
        </form>
    </div>
</div>