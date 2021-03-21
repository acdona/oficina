<?php
if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

if (isset($this->data['form'])) {
    $dataForm = $this->data['form'];    
}

if (isset($this->data['form'][0])) {
    $dataForm = $this->data['form'][0];
}
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 title">Editar o Usuário</h2>
            </div>
            <?php
            if (!empty($dataForm)) {
                extract($dataForm);
                ?>
                <div class="p-2">
                    <span class="d-none d-lg-block">
                        <a href="<?php echo URLADM; ?>list-users/index" class="btn btn-outline-info btn-sm">Listar</a>
                        <a href="<?php echo URLADM . 'view-user/index/' . $id; ?>" class="btn btn-outline-primary btn-sm">Visualizar</a>
                        <a href="<?php echo URLADM . 'edit-user-password/index/' . $id; ?>" class="btn btn-outline-warning btn-sm">Editar Senha</a>
                        <a href="<?php echo URLADM . 'delete-user/index/' . $id; ?>" class="btn btn-outline-danger btn-sm">Apagar</a> 
                    </span>
                    <div class="dropdown d-block d-lg-none">
                        <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                            <a class="dropdown-item" href="<?php echo URLADM; ?>list-users/index">Listar</a>
                            <a class="dropdown-item" href="<?php echo URLADM . 'view-user/index/' . $id; ?>">Visualizar</a>
                            <a class="dropdown-item" href="<?php echo URLADM . 'edit-user-password/index/' . $id; ?>">Editar Senha</a>
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


        <form id="edit_user" method="POST" action="">
            <input name="id" type="hidden" id="id" value="<?php
                if (isset($dataForm['id'])) {
                    echo $dataForm['id'];
                }
            ?>">
            
            <div class="form-group">
                <label for="name"><span class="text-danger">*</span> Nome:</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Nome completo"  value="<?php
                if (isset($dataForm['name'])) {
                    echo $dataForm['name'];
                }
                ?>" required autofocus>
            </div>

            <div class="form-group">
                <label for="email"><span class="text-danger">*</span> E-mail</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="Melhor e-mail" value="<?php
                if (isset($dataForm['email'])) {
                    echo $dataForm['email'];
                }
                ?>" required>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="username"><span class="text-danger">*</span> Usuário</label>
                    <input name="username" type="text" class="form-control" id="username" placeholder="Usuário para acessar o login" value="<?php
                    if (isset($dataForm['username'])) {
                        echo $dataForm['username'];
                    }
                    ?>" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="nickname"> Apelido</label>
                    <input name="nickname" type="text" class="form-control" id="nickname" placeholder="Apelido" value="<?php
                    if (isset($dataForm['nickname'])) {
                        echo $dataForm['nickname'];
                    }
                    ?>">
                </div>
            </div> 
            
            <div class="form-group">
                <label for="adms_sits_user_id"><span class="text-danger">*</span> Situação</label>
                <select name="adms_sits_user_id" id="adms_sits_user_id" class="form-control">
                    <option value="">Selecione</option>
                    <?php
                    foreach ($this->data['select']['sit'] as $sit) {
                        extract($sit);
                        if ((isset($dataForm['adms_sits_user_id'])) AND $dataForm['adms_sits_user_id'] == $id_sit) {
                            echo "<option value='$id_sit' selected>$name_sit</option>";
                        } else {
                            echo "<option value='$id_sit'>$name_sit</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="adms_access_level_id"><span class="text-danger">*</span> Nível de Acesso</label>
                <select name="adms_access_level_id" id="adms_access_level_id" class="form-control">
                    <option value="">Selecione</option>
                    <?php
                    foreach ($this->data['select']['lev'] as $lev) {
                        extract($lev);
                        if ((isset($dataForm['adms_access_level_id'])) AND $dataForm['adms_access_level_id'] == $id_lev) {
                            echo "<option value='$id_lev' selected>$name_lev</option>";
                        } else {
                            echo "<option value='$id_lev'>$name_lev</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <p>
                <span class="text-danger">*</span> Campo Obrigatório
            </p>
            
            <input name="EditUser" type="submit" class="btn btn-outline-warning btn-sm" value="Salvar"> 
            
        </form>
    </div>
</div>