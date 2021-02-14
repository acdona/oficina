<?php
if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

if (isset($this->dados['form'])) {
    $valorForm = $this->dados['form'];
}

if (isset($this->dados['form'][0])) {
    $valorForm = $this->dados['form'][0];
}

if (isset($valorForm['id'])) {
    $id = $valorForm['id'];
}
?>

<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 title">Editar categoria das contas</h2>
                </div>
                <div class="p-2">
                <span class="d-none d-lg-block">

                    <a href="<?php echo URLADM ?>list-account-category/index" class="btn btn-outline-info btn-sm">Listar</a>
                    
                    <a href="apagar.html" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#deleteData">Apagar</a> 
                </span>
                </div>

                <div class="dropdown d-block d-lg-none">
                                <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Ações
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                    <a class="dropdown-item" href="listar.html">Listar</a>
                                    
                                    <a class="dropdown-item" href="apagar.html" data-toggle="modal" data-target="#deleteData">Apagar</a>
                                </div>
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

        <form id="form_account_category" method="POST" action="">
            <input name="id" type="hidden" id="id" value="<?php
            if (isset($valorForm['id'])) {
                echo $valorForm['id'];
            }
            ?>">

            <label for="name"><span class="text-danger">*</span> Nome</label>
            <input name="name" type="text"  class="form-control" id="name" placeholder="Nome da categoria" value="<?php
            if (isset($valorForm['name'])) {
                echo $valorForm['name'];
            }
            ?>" autofocus required><br><br>

            <p>
                <span class="text-danger">*</span> Campo Obrigatório
            </p>

            <input name="EditAccountCategory" type="submit" class="btn btn-outline-warning btn-sm" value="Salvar">  
        </form>


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