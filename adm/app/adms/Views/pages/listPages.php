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
                <h2 class="display-4 title">Listar Páginas</h2>
            </div>
            <div class="p-2">
                <span id="btn-register">
                   <a href="<?php echo URLADM ?>add-pages/index" class="btn btn-outline-success btn-sm" onclick="loadBtnRegister()">Cadastrar</a>
                </span>
            </div>
        </div>
        <hr class="hr-title">
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th class="d-none d-sm-table-cell">Tipo de Página</th>
                        <th class="d-none d-lg-table-cell">Situação</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->data['listPages'] as $pages) {
                        extract($pages);
                        ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $page_name; ?></td>
                            <td class="d-none d-sm-table-cell"><?php echo $type_tpg . " - " . $name_tpg; ?></td>
                            <td class="d-none d-lg-table-cell">
                                <span class="badge badge-<?php echo $name_color; ?>"><?php echo $name_sit; ?></span>
                            </td>
                            <td class="text-center">
                                <span class="d-none d-lg-block">
                                    <a href="<?php echo URLADM . 'view-pages/index/' . $id; ?>" class="btn btn-outline-primary btn-sm">Visualizar</a>
                                    <a href="<?php echo URLADM . 'edit-pages/index/' . $id; ?>" class="btn btn-outline-warning btn-sm">Editar</a>
                                    <a href="<?php echo URLADM . 'delete-pages/index/' . $id; ?>" class="btn btn-outline-danger btn-sm" data-confirm="Excluir">Apagar</a> 
                                </span>
                                <div class="dropdown d-block d-lg-none">
                                    <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <a class="dropdown-item" href="<?php echo URLADM . 'view-pages/index/' . $id; ?>">Visualizar</a>
                                        <a class="dropdown-item" href="<?php echo URLADM . 'edit-pages/index/' . $id; ?>">Editar</a>
                                        <a class="dropdown-item" href="<?php echo URLADM . 'delete-pages/index/' . $id; ?>" data-confirm="Excluir">Apagar</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php echo $this->data['pagination']; ?>
        </div>
    </div>
</div>
