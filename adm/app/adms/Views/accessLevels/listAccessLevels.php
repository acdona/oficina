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
                <h2 class="display-4 title">Listar Nível de Acesso</h2>
            </div>
            <div class="p-2">
                <span class="d-none d-lg-block">
                    <span id="btn-register">
                        <a href="<?php echo URLADM ?>add-access-level/index" class="btn btn-outline-success btn-sm"  onclick="loadBtnRegister()">Cadastrar</a>
                    </span>
                    <span id="btn-synchronize">
                        <a href="<?php echo URLADM ?>sync-pages-levels/index" class="btn btn-outline-warning btn-sm" onclick="loadBtnSynchronize()">Sincronizar</a>  
                    </span>
                </span>
                <div class="dropdown d-block d-lg-none">
                    <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ações
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                        <a class="dropdown-item" href="<?php echo URLADM; ?>add-access-level/index" onclick="loadBtnRegister()">Cadastrar</a>
                        <span id="link-synchronize">
                            <a class="dropdown-item" href="<?php echo URLADM; ?>sync-pages-levels/index" onclick="loadLinkSynchronize()">Sincronizar</a>
                        </span>
                    </div>
                </div>
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
                        <th class="d-none d-sm-table-cell">ID</th>
                        <th>Nome</th>
                        <th>Ordem</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $qnt_linhas_exe = 1;
                    foreach ($this->data['listAccessLevels'] as $accessLevel) {
                        extract($accessLevel);
                        ?>
                        <tr>
                            <td class="d-none d-sm-table-cell"><?php echo $id; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $order_levels; ?></td>
                            <td class="text-center">
                                <span class="d-none d-lg-block">
                                    <?php
                                    if ($qnt_linhas_exe <= 1 AND ($this->data['pag'] == 1)) {
                                        echo "<a href='" . URLADM . "order-access-level/index/$id?pag=" . $this->data['pag'] . "' class='btn btn-outline-secondary btn-sm disabled'><i class='fas fa-angle-double-up'></i></a>";
                                    } else {
                                        echo "<a href='" . URLADM . "order-access-level/index/$id?pag=" . $this->data['pag'] . "' class='btn btn-outline-secondary btn-sm'><i class='fas fa-angle-double-up'></i></a>";
                                    }
                                    ?>

                                    <a href="<?php echo URLADM . 'list-permission/index?level=' . $id; ?>" class="btn btn-outline-info btn-sm">Permissão</a>
                                    <a href="<?php echo URLADM . 'view-access-level/index/' . $id; ?>" class="btn btn-outline-primary btn-sm">Visualizar</a>
                                    <a href="<?php echo URLADM . 'edit-access-level/index/' . $id; ?>" class="btn btn-outline-warning btn-sm">Editar</a>
                                    <a href="<?php echo URLADM . 'delete-access-level/index/' . $id; ?>" class="btn btn-outline-danger btn-sm" data-confirm="Excluir">Apagar</a> 
                                </span>
                                <div class="dropdown d-block d-lg-none">
                                    <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <?php
                                        if ($qnt_linhas_exe <= 1 AND ($this->data['pag'] == 1)) {
                                            echo "<a class='dropdown-item disabled' href='" . URLADM . "order-access-level/index/$id?pag=" . $this->data['pag'] . "'>Ordem</a>";
                                        } else {
                                            echo "<a class='dropdown-item' href='" . URLADM . "order-access-level/index/$id?pag=" . $this->data['pag'] . "'>Ordem</a>";
                                        }
                                        $qnt_linhas_exe++;
                                        ?>
                                        <a class="dropdown-item" href="<?php echo URLADM . 'view-access-level/index/' . $id; ?>">Visualizar</a>
                                        <a class="dropdown-item" href="<?php echo URLADM . 'edit-access-level/index/' . $id; ?>">Editar</a>
                                        <a class="dropdown-item" href="<?php echo URLADM . 'delete-access-level/index/' . $id; ?>" data-confirm="Excluir">Apagar</a>
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
