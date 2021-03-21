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
                    <h2 class="display-4 title">Editar Imagem do Perfil</h2>
                </div>
                <?php
                      if (!empty($formData)) {
                      extract($formData);
                ?>

                <div class="p-2">
                    <span class="d-none d-lg-block">
                        <a href="<?php echo URLADM; ?>view-profile/index" class="btn btn-outline-primary btn-sm">Perfil</a>
                        <a href="<?php echo URLADM . 'edit-profile/index'; ?>" class="btn btn-outline-warning btn-sm">Editar</a>
                        <a href="<?php echo URLADM . 'edit-profile-password/index'; ?>" class="btn btn-outline-warning btn-sm">Editar Senha</a>
                    </span>
                    <div class="dropdown d-block d-lg-none">
                        <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                            <a class="dropdown-item" href="<?php echo URLADM; ?>view-profile/index">Perfil</a>
                            <a class="dropdown-item" href="<?php echo URLADM . 'edit-profile/index'; ?>">Editar</a>
                            <a class="dropdown-item" href="<?php echo URLADM . 'edit-profile-password/index'; ?>">Editar Senha</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <hr class="hr-title">
         
            <form id="edit_img" method="POST" action="" enctype="multipart/form-data">

                <input name="image" type="hidden" value="<?php
                    if (isset($formData['image'])) {
                        echo $formData['image'];
                    }
                ?>">

                <?php
                    if (isset($formData['image']) AND (!empty($formData['image'])) AND (file_exists('app/adms/assets/images/users/' . $_SESSION['user_id'] . '/' . $formData['image']))) {
                        $old_image = URLADM . 'app/adms/assets/images/users/' . $_SESSION['user_id'] . '/' . $formData['image'];
                    } else {
                        $old_image = URLADM . 'app/adms/assets/images/users/icon_user.png';
                    }
                ?>

                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label for="new_image"><span class="text-danger">*</span> Imagem</label>
                        <input name="new_image" type="file" class="form-control-file" id="new_image">
                    </div>

                    <div class="form-group col-md-6">
                        <img src="<?php echo $old_image; ?>" alt="Imagem do Perfil" id="preview-img" class="img-thumbnail view-img-size">
                    </div>
                </div>
                
                <p>
                    <span class="text-danger">*</span> Campo Obrigatório
                </p>

                <input name="EditProfileImage" type="submit" class="btn btn-outline-warning btn-sm" value="Salvar">  
                
            </form>

        </div>
</div>

