<?php

if(!defined('R4F5CC')){
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
                <h2 class="display-4 title">Editar o Perfil</h2>
            </div>
            <?php
            if (!empty($formData)) {
                extract($formData);
                ?>
                <div class="p-2">
                    <span class="d-none d-lg-block">
                        <a href="<?php echo URLADM; ?>view-profile/index" class="btn btn-outline-primary btn-sm">Perfil</a>
                        <a href="<?php echo URLADM . 'edit-profile-password/index'; ?>" class="btn btn-outline-warning btn-sm">Editar Senha</a>
                    </span>
                    <div class="dropdown d-block d-lg-none">
                        <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                            <a class="dropdown-item" href="<?php echo URLADM; ?>view-profile/index">Perfil</a>
                            <a class="dropdown-item" href="<?php echo URLADM . 'edit-profile-password/index'; ?>">Editar Senha</a>
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
        <form id="edit_profile" method="POST" action="">
            <input name="id" type="hidden" id="id" value="<?php
            if (isset($formData['id'])) {
                echo $formData['id'];
            }
            ?>">

            <div class="form-group">
                <label for="name"><span class="text-danger">*</span> Nome:</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Nome completo"  value="<?php
                if (isset($formData['name'])) {
                    echo $formData['name'];
                }
                ?>" required autofocus>
            </div>

            <div class="form-group">
                <label for="email"><span class="text-danger">*</span> E-mail</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="Melhor e-mail" value="<?php
                if (isset($formData['email'])) {
                    echo $formData['email'];
                }
                ?>" required>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="username"><span class="text-danger">*</span> Usuário</label>
                    <input name="username" type="text" class="form-control" id="username" placeholder="Usuário para acessar o login" value="<?php
                    if (isset($formData['username'])) {
                        echo $formData['username'];
                    }
                    ?>" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="nickname"> Apelido</label>
                    <input name="nickname" type="text" class="form-control" id="nickname" placeholder="Apelido" value="<?php
                    if (isset($formData['nickname'])) {
                        echo $formData['nickname'];
                    }
                    ?>">
                </div>
            </div> 

            <p>
                <span class="text-danger">*</span> Campo Obrigatório
            </p>

            <input name="EditProfile" type="submit" class="btn btn-outline-warning btn-sm" value="Salvar"> 

        </form>
    </div>
</div>