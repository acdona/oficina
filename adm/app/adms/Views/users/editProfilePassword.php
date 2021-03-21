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
                <h2 class="display-4 title">Editar Senha do Perfil</h2>
            </div>
            <?php
            if (!empty($formData)) {
                extract($formData);
                ?>
                <div class="p-2">
                    <span class="d-none d-lg-block">
                        <a href="<?php echo URLADM; ?>view-profile/index" class="btn btn-outline-primary btn-sm">Perfil</a>
                        <a href="<?php echo URLADM . 'edit-profile/index'; ?>" class="btn btn-outline-warning btn-sm">Editar</a>
                    </span>
                    <div class="dropdown d-block d-lg-none">
                        <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                            <a class="dropdown-item" href="<?php echo URLADM; ?>view-profile/index">Perfil</a>
                            <a class="dropdown-item" href="<?php echo URLADM . 'edit-profile/index'; ?>">Editar</a>
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

            <div class="form-group">
                <label for="password"><span class="text-danger">*</span> Senha:</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Digite a senha"  value="<?php
                if (isset($formData['password'])) {
                    echo $formData['password'];
                }
                ?>" onkeyup="passwordStrength()" required autofocus>
            </div>

            <p>
                <span class="text-danger">*</span> Campo Obrigatório
            </p>

            <input name="EditProfilePass" type="submit" class="btn btn-outline-warning btn-sm" value="Salvar"> 

        </form>
    </div>
</div>


