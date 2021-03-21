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
                <h2 class="display-4 title">Detalhes da Página</h2>
            </div>
            <?php
            if (!empty($this->data['viewPages'])) {
                extract($this->data['viewPages'][0]);
                ?>
                <div class="p-2">
                    <span class="d-none d-lg-block">
                        <a href="<?php echo URLADM; ?>list-pages/index" class="btn btn-outline-info btn-sm">Listar</a>
                        <a href="<?php echo URLADM . 'edit-pages/index/' . $id; ?>" class="btn btn-outline-warning btn-sm">Editar</a>
                        <a href="<?php echo URLADM . 'delete-pages/index/' . $id; ?>" class="btn btn-outline-danger btn-sm" data-confirm="Excluir">Apagar</a> 
                    </span>
                    <div class="dropdown d-block d-lg-none">
                        <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                            <a class="dropdown-item" href="<?php echo URLADM; ?>list-pages/index">Listar</a>
                            <a class="dropdown-item" href="<?php echo URLADM . 'edit-pages/index/' . $id; ?>">Editar</a>
                            <a class="dropdown-item" href="<?php echo URLADM . 'delete-pages/index/' . $id; ?>" data-confirm="Excluir">Apagar</a>
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
        
        if (!empty($this->data['viewPages'])) {
            ?>
            <dl class="row">
                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9"><?php echo $id; ?></dd>

                <dt class="col-sm-3">Controller</dt>
                <dd class="col-sm-9"><?php echo $controller; ?></dd>

                <dt class="col-sm-3">Método</dt>
                <dd class="col-sm-9"><?php echo $method; ?></dd>

                <dt class="col-sm-3">Menu Controller</dt>
                <dd class="col-sm-9"><?php echo $menu_controller; ?></dd>
                
                <dt class="col-sm-3">Menu Método</dt>
                <dd class="col-sm-9"><?php echo $menu_method; ?></dd>
                
                <dt class="col-sm-3">Nome da Página</dt>
                <dd class="col-sm-9"><?php echo $page_name; ?></dd>

                <dt class="col-sm-3">Página Publica</dt>
                <dd class="col-sm-9">
                    <?php 
                    if($public == 1){
                        echo "Sim";
                    }else{
                        echo "Não";
                    }
                    ?>
                </dd>
                
                <dt class="col-sm-3">Ícone</dt>
                <dd class="col-sm-9">
                    <?php echo "<i class='" . $icon . "'></i> - " . $icon; ?>
                </dd>
                
                <dt class="col-sm-3">Observação</dt>
                <dd class="col-sm-9"><?php echo $note; ?></dd>

                <dt class="col-sm-3">Situação</dt>
                <dd class="col-sm-9"><span class="badge badge-<?php echo $name_color; ?>"><?php echo $name_sit; ?></span></dd>
                
                <dt class="col-sm-3">Tipo de Página</dt>
                <dd class="col-sm-9"><?php echo $type_tpg . " - " . $name_tpg; ?></dd>
            </dl>
            <?php
        } else {
            echo "<div class='alert alert-danger' role='alert'>Erro: Página não encontrada!</div>";
        }
        ?>
    </div>
</div>