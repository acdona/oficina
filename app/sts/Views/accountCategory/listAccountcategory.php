<?php

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>

        <div class="list-group-item">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 title">Listagem - Categorias das Contas</h2>
                </div>
                <div class="p-2">
                    <a href="#" class="btn btn-outline-success btn-sm">Cadastrar</a>
                </div>
            </div>
            <hr class="hr-title">

            <div class="table-responsive">
                <table class="table table-striped table-light table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Nome</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php
                        //Ler o array de registro sobre empresa retornado do banco de dados
                        foreach ($this->dados['listAccountCategory'] as $cat){
                        //A função extract é utilizada para extrair o array e imprimir através do nome da chave
                        extract($cat);
                    ?>

                    <tr class="table-striped">
                        <td class="text-center"><?php echo $id; ?></td>
                        <td><?php echo $name; ?></td>

                        <td class="text-center">
                                <span class="d-none d-lg-block">
                                    <a href="visualizar.html" class="btn btn-outline-primary btn-sm">Visualizar</a>
                                    <a href="editar.html" class="btn btn-outline-warning btn-sm">Editar</a>
                                    <a href="apagar.html" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#deleteData">Apagar</a> 
                                </span>
                                <div class="dropdown d-block d-lg-none">
                                    <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <a class="dropdown-item" href="visualizar.html">Visualizar</a>
                                        <a class="dropdown-item" href="editar.html">Editar</a>
                                        <a class="dropdown-item" href="apagar.html" data-toggle="modal" data-target="#deleteData">Apagar</a>
                                    </div>
                                </div>
                            </td>

                    </tr>
                        <?php
                            }
                        ?>
                    </tbody>
            </table>

                <nav aria-label="paginacao">
                    <?php echo $this->dados['pagination']; ?>             
                </nav>
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

           