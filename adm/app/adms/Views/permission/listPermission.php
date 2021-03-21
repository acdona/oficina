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
                <h2 class="display-4 title">Listar Permissão</h2>
            </div>
            <div class="p-2">
                <a href="<?php echo URLADM ?>list-access-levels/index" class="btn btn-outline-info btn-sm">Listar Nível de Acesso</a>
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
                        <th>Página</th>
                        <th class="d-none d-sm-table-cell">Permissão</th>
                        <th>Ordem</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $qnt_linhas_exe = 1;
                    foreach ($this->data['listPermission'] as $permission) {
                        extract($permission);
                        ?>
                        <tr>
                            <td class="d-none d-sm-table-cell"><?php echo $id; ?></td>
                            <td><?php echo $page_name; ?></td>
                            <td class="d-none d-sm-table-cell">
                              <?php
                                    if ($permission == 1) {
                                        echo "<a href='" . URLADM . "edit-permission/index?id=$id&level=$adms_access_level_id&pag=" . $this->data['pag'] . "'><span class='badge badge-success'>Liberado</span></a>";
                                    } else {
                                        echo "<a href='" . URLADM . "edit-permission/index?id=$id&level=$adms_access_level_id&pag=" . $this->data['pag'] . "'><span class='badge badge-danger'>Bloqueado</span></a>";
                                    }
                                ?>
                            </td>
                            <td><?php echo $order_level_page; ?></td>
                            <td class="text-center">
                                
                               
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