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
                <h2 class="display-4 title">Cadastrar Situação para Usuário</h2>
            </div>
            <div class="p-2">
                <a href="<?php echo URLADM; ?>list-sits-users/index" class="btn btn-outline-info btn-sm">Listar</a>
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
        <form id="sits_user" method="POST" action="">
        
            <div class="form-group">
                <label for="name"><span class="text-danger">*</span> Nome:</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Nome da situação para usuário"  value="<?php
                if (isset($formData['name'])) {
                    echo $formData['name'];
                }
                ?>" required autofocus>
            </div>

            <div class="form-group">
                <label for="adms_color_id">Cor</label>
                <select name="adms_color_id" id="adms_color_id" class="form-control">
                    <option value="">Selecione</option>
                    <?php
                    foreach ($this->data['select']['cor'] as $cor) {
                        extract($cor);
                        if ((isset($formData['adms_color_id'])) AND $formData['adms_color_id'] == $id_cor) {
                            echo "<option value='$id_cor' selected>$name_cor</option>";
                        } else {
                            echo "<option value='$id_cor'>$name_cor</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <p>
                <span class="text-danger">*</span> Campo Obrigatório
            </p>

            <input name="AddSitsUser" type="submit" class="btn btn-outline-success btn-sm" value="Cadastrar"> 

        </form>

    </div>
</div>
