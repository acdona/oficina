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
                <h2 class="display-4 title">Listar Contatos da Página</h2>
            </div>
            <div class="p-2">
                <span id="btn-register">
                   <a href="<?php echo URLADM ?>add-contacts-page/index" class="btn btn-outline-success btn-sm" onclick="loadBtnRegister()">Cadastrar</a>
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
                        <th>Nome Horário de abertura</th>
                        <th class="d-none d-sm-table-cell">Horário de abertura</th>
                        <th class="d-none d-lg-table-cell">Título Endereço</th>
                        <th class="d-none d-lg-table-cell">Endereço</th>
                        <th class="d-none d-lg-table-cell">Telefone</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->data['listContactsPage'] as $pages) {
                        extract($pages);
                        //id, title_opening_hours, opening_hours, title_address, address_one, address_two, phone
                        ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $title_opening_hours; ?></td>
                            <td class="d-none d-sm-table-cell"><?php echo $opening_hours; ?></td>
                            <td  class="d-none d-lg-table-cell"><?php echo $title_address; ?></td>
                            <td class="d-none d-lg-table-cell"><?php echo $address_one . " - " . $address_two; ?></td>
                            <td class="d-none d-lg-table-cell"><?php echo $phone; ?></td>
                            <td class="text-center">
                                <span class="d-none d-lg-block">
                                    <a href="<?php echo URLADM . 'view-contacts-page/index/' . $id; ?>" class="btn btn-outline-primary btn-sm">Visualizar</a>
                                    <a href="<?php echo URLADM . 'edit-contacts-page/index/' . $id; ?>" class="btn btn-outline-warning btn-sm">Editar</a>
                                    <a href="<?php echo URLADM . 'delete-contacts-page/index/' . $id; ?>" class="btn btn-outline-danger btn-sm" data-confirm="Excluir">Apagar</a> 
                                </span>
                                <div class="dropdown d-block d-lg-none">
                                    <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <a class="dropdown-item" href="<?php echo URLADM . 'view-contacts-page/index/' . $id; ?>">Visualizar</a>
                                        <a class="dropdown-item" href="<?php echo URLADM . 'edit-contacts-page/index/' . $id; ?>">Editar</a>
                                        <a class="dropdown-item" href="<?php echo URLADM . 'delete-contacts-page/index/' . $id; ?>" data-confirm="Excluir">Apagar</a>
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
