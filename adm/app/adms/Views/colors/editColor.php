<?php
if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

if (isset($this->data['form'])) {
    $formData = $this->data['form'];
}

if (isset($this->data['form'][0])) {
    $formData = $this->data['form'][0];
}

if (isset($formData['id'])) {
    $id = $formData['id'];
}
?>

<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 title">Editar Cor</h2>
                </div>
                <div class="p-2">
                <span class="d-none d-lg-block">

                    <a href="<?php echo URLADM ?>list-colors/index" class="btn btn-outline-info btn-sm">Listar</a>
                    
                    <a href="<?php echo URLADM . 'delete-color/index/' . $id; ?>" class="btn btn-outline-danger btn-sm" data-confirm="Excluir">Apagar</a> 
                </span>
                </div>

                <div class="dropdown d-block d-lg-none">
                                <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Ações
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                    <a class="dropdown-item" href="<?php echo URLADM ?>list-colors/index" class="btn btn-outline-info btn-sm">Listar</a>
                                    <a class="dropdown-item" href="<?php echo URLADM . 'delete-color/index/' . $id; ?>" data-confirm="Excluir">Apagar</a>
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

        <form id="form_color" method="POST" action="">
            <input name="id" type="hidden" id="id" value="<?php
            if (isset($formData['id'])) {
                echo $formData['id'];
            }
            ?>">

            <label for="name"><span class="text-danger">*</span> Nome</label>
            <input name="name" type="text"  class="form-control" id="name" placeholder="Nome da cor" value="<?php
            if (isset($formData['name'])) {
                echo $formData['name'];
            }
            ?>" autofocus required><br><br>

            <label for="color"><span class="text-danger">*</span> Cor</label>
            <input name="color" type="text"  class="form-control" id="color" placeholder="Cor" value="<?php
            if (isset($formData['color'])) {
                echo $formData['color'];
            }
            ?>" autofocus required><br><br>

            <p>
                <span class="text-danger">*</span> Campo Obrigatório
            </p>

            <input name="EditColor" type="submit" class="btn btn-outline-warning btn-sm" value="Salvar">  
        </form>


    </div>
</div>
