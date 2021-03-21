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
                <h2 class="display-4 title">Editar Tipo de Página</h2>
            </div>
            <?php
            if (!empty($formData)) {
                extract($formData);                
                ?>
                <div class="p-2">
                    <span class="d-none d-lg-block">
                        <a href="<?php echo URLADM; ?>list-types-pages/index" class="btn btn-outline-info btn-sm">Listar</a>
                        <a href="<?php echo URLADM . 'view-types-pages/index/' . $id; ?>" class="btn btn-outline-primary btn-sm">Visualizar</a>
                        <a href="<?php echo URLADM . 'delete-types-pages/index/' . $id; ?>" class="btn btn-outline-danger btn-sm" data-confirm="Excluir">Apagar</a> 
                    </span>
                    <div class="dropdown d-block d-lg-none">
                        <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                            <a class="dropdown-item" href="<?php echo URLADM; ?>list-types-pages/index">Listar</a>
                            <a class="dropdown-item" href="<?php echo URLADM . 'view-types-pages/index/' . $id; ?>">Visualizar</a>
                            <a class="dropdown-item" href="<?php echo URLADM . 'delete-types-pages/index/' . $id; ?>" data-confirm="Excluir">Apagar</a>
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
        <form id="types_pages" method="POST" action="">
            <input name="id" type="hidden" id="id" value="<?php
        if (isset($formData['id'])) {
            echo $formData['id'];
        }
        ?>">
            
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
                ?>" required>
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

            <input name="EditTypesPages" type="submit" class="btn btn-outline-warning btn-sm" value="Salvar"> 

        </form>
    </div>
</div>