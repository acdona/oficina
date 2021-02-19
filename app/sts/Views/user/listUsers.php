<?php
if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
?>

<div class="content p-1 head-cor">
    <div class="list-group-item">
        <div class="list-group-item">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 title">Listagem - Usuários</h2>
                </div>
                <div class="p-2">
                    <a href="<?php echo URL; ?>add-users/index" class="btn btn-outline-success btn-sm">Cadastrar</a>
                </div>
            </div>
            <hr class="hr-title">
            <?php

                if(isset($_SESSION['msg'])){
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }        
             ?>

            <div class="table-responsive">
                <table class="table table-striped table-light table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Situação</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            //Ler o array de registro retornado do banco de dados
                            foreach ($this->dados['listUsers'] as $user) {
                                //A função extract é utilizada para extrair o array e imprimir através do nome da chave
                                extract($user);
                        ?>
                        <tr class="table-striped">
                            <td class="text-center"><?php echo $id; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $name_sit; ?></td>
                            
                            <td class="text-center">
                                <span class="d-none d-lg-block">
                                    <a href="<?php echo URL . 'view-user/index/' . $id; ?>" class="btn btn-outline-primary btn-sm">Visualizar</a>
                                    <a href="<?php echo URL . 'edit-user/index/' . $id; ?>" class="btn btn-outline-warning btn-sm">Editar</a>
                                    <a href="<?php echo URL . 'delete-user/index/' . $id; ?>" class="btn btn-outline-danger btn-sm" data-confirm="Excluir">Apagar</a> 
                                </span>
                                <div class="dropdown d-block d-lg-none">
                                    <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <a class="dropdown-item" href="<?php echo URL . 'view-user/index/' . $id; ?>">Visualizar</a>
                                        <a class="dropdown-item" href="<?php echo URL . 'edit-user/index/' . $id; ?>">Editar</a>
                                        <a class="dropdown-item" href="<?php echo URL . 'delete-user/index/' . $id; ?>" data-confirm="Excluir">Apagar</a>
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
    </div>
</div>