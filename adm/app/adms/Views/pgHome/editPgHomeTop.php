<?php
if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

if (isset($this->dados['topo'])) {
    $valorForm = $this->dados['topo'];
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
            <label for="titulo_topo">Título</label>
            <input name="titulo_topo" type="text" class="form-control" id="titulo_topo" placeholder="Título do topo" value="<?php
            if ($valorForm['titulo_topo']) {
                echo $valorForm['titulo_topo'];
            }
            ?>">
        </div>
        <div class="form-group">
            <label for="subtitulo_topo">Subtítulo</label>
            <input name="subtitulo_topo" type="text" class="form-control" id="subtitulo_topo" placeholder="Subtítulo do topo" value="<?php
            if ($valorForm['subtitulo_topo']) {
                echo $valorForm['subtitulo_topo'];
            }
            ?>">
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="text_btn_topo">Texto do Botão</label>
                <input name="text_btn_topo" type="text" class="form-control" id="text_btn_topo" placeholder="Texto do Botão" value="<?php
            if ($valorForm['text_btn_topo']) {
                echo $valorForm['text_btn_topo'];
            }
            ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="link_btn_topo">Link do Botão</label>
                <input name="link_btn_topo" type="text" class="form-control" id="link_btn_topo" placeholder="Link do Botão" value="<?php
            if ($valorForm['link_btn_topo']) {
                echo $valorForm['link_btn_topo'];
            }
            ?>">
            </div>
        </div>
        
        <input name="EditTopoHome" type="submit" class="btn btn-warning" value="Salvar" >
    </form>
</div>
