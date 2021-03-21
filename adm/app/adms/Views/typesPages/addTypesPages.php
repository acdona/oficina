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
                <h2 class="display-4 title">Cadastrar Tipo de Página</h2>
            </div>
            <div class="p-2">
                <a href="<?php echo URLADM; ?>list-types-pages/index" class="btn btn-outline-info btn-sm">Listar</a>
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
        <form id="types_pages" method="POST" action="">
            <div class="form-group">
                <label for="type"><span class="text-danger">*</span> Tipo:</label>
                <input name="type" type="text" class="form-control" id="type" placeholder="Tipo de página"  value="<?php
                if (isset($formData['type'])) {
                    echo $formData['type'];
                }
                ?>" required autofocus>
            </div>
            
            <div class="form-group">
                <label for="name"><span class="text-danger">*</span> Nome:</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Nome do tipo de página"  value="<?php
                if (isset($formData['name'])) {
                    echo $formData['name'];
                }
                ?>" required >
            </div>
            
            <div class="form-group">
                <label> Observação</label>
                <textarea name="note" class="form-control" rows="3"><?php
                    if (isset($formData['note'])) {
                        echo $formData['note'];
                    }
                    ?></textarea>
            </div>

            <p>
                <span class="text-danger">*</span> Campo Obrigatório
            </p>

            <input name="AddTypesPages" type="submit" class="btn btn-outline-success btn-sm" value="Cadastrar"> 

        </form>

    </div>
</div>