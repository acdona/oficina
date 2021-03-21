<?php
if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

if (isset($this->data['form'])) {
    $formData = $this->data['form'];
}
?>

<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 title">Cadastrar Cor</h2>
                </div>
                <div class="p-2">
                    <a href="<?php echo URLADM ?>list-colors/index" class="btn btn-outline-info btn-sm">Listar</a>
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
        <form id="add_color" method="POST" action="">

            <div class="form-group col-md-6">
                    <label for="name"><span class="text-danger">*</span> Nome</label>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Nome da cor" autofocus required value="<?php

                if (isset($formData['name'])) {
                    echo $formData['name'];
                }
                
                ?>">

                  <label for="color"><span class="text-danger">*</span> Cor</label>
                    <input name="color" type="text" class="form-control" id="color" placeholder="Código da cor" required value="<?php
                if (isset($formData['color'])) {
                    echo $formData['color'];
                }
                
                ?>">

                <p>
                    <br>
                    <span class="text-danger">*</span> Campo Obrigatório<br><br>
                    <input name="AddColor" type="submit" class="btn btn-outline-success btn-sm" value="Cadastrar">  
                </p>
            </div>

        </form>
    </div>
</div>