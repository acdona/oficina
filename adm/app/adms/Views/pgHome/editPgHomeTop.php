<?php
if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

if (isset($this->dados['top'])) {
    $valorForm = $this->dados['top'];
}
?>
<div class="container">
    <div class="d-flex">
        <div class="mr-auto p-2">
            <h1>Editar topo da página home</h1>
        </div>
        <div class="p-2">
            <a href="<?php echo URLADM ?>view-pg-home" class="btn btn-primary btn-sm">Visualizar</a>
        </div>
        
    </div>
    <hr>
    <?php
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
    <form method="POST" action="">
        <div class="form-group">
            <input name="id" type="hidden" id="id" value="<?php
            if ($valorForm['id']) {
                echo $valorForm['id'];
            }
            ?>">
            <label for="title_top">Título</label>
            <input name="title_top" type="text" class="form-control" id="title_top" placeholder="Título do topo" value="<?php
            if ($valorForm['title_top']) {
                echo $valorForm['title_top'];
            }
            ?>">
        </div>
        <div class="form-group">
            <label for="subtitle_top">Subtítulo</label>
            <input name="subtitle_top" type="text" class="form-control" id="subtitle_top" placeholder="Subtítulo do topo" value="<?php
            if ($valorForm['subtitle_top']) {
                echo $valorForm['subtitle_top'];
            }
            ?>">
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="text_btn_top">Texto do Botão</label>
                <input name="text_btn_top" type="text" class="form-control" id="text_btn_top" placeholder="Texto do Botão" value="<?php
            if ($valorForm['text_btn_top']) {
                echo $valorForm['text_btn_top'];
            }
            ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="link_btn_top">Link do Botão</label>
                <input name="link_btn_top" type="text" class="form-control" id="link_btn_top" placeholder="Link do Botão" value="<?php
            if ($valorForm['link_btn_top']) {
                echo $valorForm['link_btn_top'];
            }
            ?>">
            </div>
        </div>
        
        <input name="EditTopHome" type="submit" class="btn btn-warning" value="Salvar" >
    </form>
</div>
