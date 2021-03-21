<?php
if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 title">Detalhes do Tipo de Página</h2>
            </div>
            <?php
            if (!empty($this->data['viewTypesPages'])) {
                extract($this->data['viewTypesPages'][0]);
                ?>
                <div class="p-2">
                    <span class="d-none d-lg-block">
                        <a href="<?php echo URLADM; ?>list-types-pages/index" class="btn btn-outline-info btn-sm">Listar</a>
                        <a href="<?php echo URLADM . 'edit-types-pages/index/' . $id; ?>" class="btn btn-outline-warning btn-sm">Editar</a>
                        <a href="<?php echo URLADM . 'delete-types-pages/index/' . $id; ?>" class="btn btn-outline-danger btn-sm" data-confirm="Excluir">Apagar</a> 
                    </span>
                    <div class="dropdown d-block d-lg-none">
                        <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                            <a class="dropdown-item" href="<?php echo URLADM; ?>list-types-pages/index">Listar</a>
                            <a class="dropdown-item" href="<?php echo URLADM . 'edit-types-pages/index/' . $id; ?>">Editar</a> 
                            <a class="dropdown-item" href="<?php echo URLADM . 'delete-types-pages/index/' . $id; ?>" data-confirm="Excluir">Apagar</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <hr class="hr-title">
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }

        if (!empty($this->data['viewTypesPages'])) {
            ?>
            <dl class="row">                

                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9"><?php echo $id; ?></dd>

                <dt class="col-sm-3">Tipo</dt>
                <dd class="col-sm-9"><?php echo $type; ?></dd>

                <dt class="col-sm-3">Nome</dt>
                <dd class="col-sm-9"><?php echo $name; ?></dd>

                <dt class="col-sm-3">Ordem</dt>
                <dd class="col-sm-9"><?php echo $order_type_pg; ?></dd>

                <dt class="col-sm-3">Observação</dt>
                <dd class="col-sm-9"><?php echo $note; ?></dd>
            </dl>
            <?php
        } else {
            echo "<div class='alert alert-danger' role='alert'>Erro: Tipo de página não encontrado!</div>";
        }
        ?>
    </div>
</div>