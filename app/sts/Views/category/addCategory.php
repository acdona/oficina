<?php
if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

if (isset($this->dados['form'])) {
    $valorForm = $this->dados['form'];
}
?>

<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 title">Cadastrar Categoria</h2>
                </div>
                <div class="p-2">
                    <a href="<?php echo URL ?>list-category/index" class="btn btn-outline-info btn-sm">Listar</a>
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

        <span class="msg"></span>
        <form id="add_category" method="POST" action="">

            <div class="form-group col-md-6">
                    <label for="name"><span class="text-danger">*</span> Nome</label>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Nome da categoria" autofocus required value="<?php
                if (isset($valorForm['name'])) {
                    echo $valorForm['name'];
                }
                
                ?>">

                <p>
                    <br>
                    <span class="text-danger">*</span> Campo Obrigatório<br><br>
                    <input name="AddCategory" type="submit" class="btn btn-outline-success btn-sm" value="Cadastrar">  
                </p>
            </div>

        </form>
    </div>
</div>