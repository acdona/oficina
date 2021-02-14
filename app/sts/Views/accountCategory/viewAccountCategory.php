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
                <h2 class="display-4 title">Detalhes da Categoria das Contas</h2>
            </div>
            <?php
            
            if (!empty($this->dados['viewAccountCategory'])) {
                extract($this->dados['viewAccountCategory'][0]);
                ?>
                <div class="p-2">
                    <span class="d-none d-lg-block">
                        <a href="<?php echo URLADM; ?>list-account-category/index" class="btn btn-outline-info btn-sm">Listar</a>
                        <a href="<?php echo URLADM . 'edit-account-category/index/' . $id; ?>" class="btn btn-outline-warning btn-sm">Editar</a>
                        <a href="<?php echo URLADM . 'delete-account-category/index/' . $id; ?>" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#deleteData">Apagar</a> 
                    </span>
                    <div class="dropdown d-block d-lg-none">
                        <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                            <a class="dropdown-item" href="<?php echo URLADM; ?>list-account-category/index">Listar</a>
                            <a class="dropdown-item" href="<?php echo URLADM . 'edit-account-category/index/' . $id; ?>">Editar</a>
                            <a class="dropdown-item" href="<?php echo URLADM . 'delete-account-category/index/' . $id; ?>" data-toggle="modal" data-target="#deleteData">Apagar</a>
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
        
        if (!empty($this->dados['viewAccountCategory'])) {
            ?>
            <dl class="row">

                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9"><?php echo $id; ?></dd>

                <dt class="col-sm-3">Nome</dt>
                <dd class="col-sm-9"><?php echo $name; ?></dd>

            </dl>
            <?php
        } else {
            echo "<div class='alert alert-danger' role='alert'>Erro: Categoria não encontrada! na VIEW</div>";
        }
        ?>
    </div>
</div>

 <!-- Modal -->
 <div class="modal fade" id="deleteData" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="deleteDataLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title text-light" id="deleteDataLabel"><i class="fas fa-user-times fa-lg"></i>  Excluir Registro</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <span>Tem certeza que deseja excluir o registro selecionado?</span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-danger">Apagar</button>
        </div>
      </div>
    </div>
  </div>