<?php
if (!defined('R4F5CC')) {
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
                <h2 class="display-4 title">Cadastrar Usuário</h2>
            </div>
            <div class="p-2">
                <a href="<?php echo URLADM; ?>list-users/index" class="btn btn-outline-info btn-sm">Listar</a>
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
        <form id="add_user" method="POST" action="">
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
                    <label for="password"><span class="text-danger">*</span> Senha</label>
                    <input name="password" type="password" class="form-control" id="password" placeholder="A senha deve ter no mínimo 6 caracteres" onkeyup="passwordStrength()" required>
                </div>
            </div>  
            <span id="msgViewStrength"></span>

            <div class="form-group">
                <label for="adms_sits_user_id"><span class="text-danger">*</span> Situação</label>
                <select name="adms_sits_user_id" id="adms_sits_user_id" class="form-control">
                    <option value="">Selecione</option>
                    <?php
                    foreach ($this->data['select']['sit'] as $sit) {
                        extract($sit);
                        if ((isset($formData['adms_sits_user_id'])) AND $formData['adms_sits_user_id'] == $id_sit) {
                            echo "<option value='$id_sit' selected>$name_sit</option>";
                        } else {
                            echo "<option value='$id_sit'>$name_sit</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="adms_access_level_id"><span class="text-danger">*</span> Nível de acesso</label>
                <select name="adms_access_level_id" id="adms_access_level_id" class="form-control">
                    <option value="">Selecione</option>
                    <?php
                    foreach ($this->data['select']['lev'] as $lev) {
                        extract($lev);
                        if ((isset($formData['adms_access_level_id'])) AND $formData['adms_access_level_id'] == $id_sit) {
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
            
            <input name="AddUser" type="submit" class="btn btn-outline-success btn-sm" value="Cadastrar"> 

        </form>

    </div>
</div>

