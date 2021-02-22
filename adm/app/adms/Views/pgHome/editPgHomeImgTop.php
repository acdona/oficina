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
            <h1>Editar a Imagem</h1>
        </div>
        <div class="p-2">
            <a href="<?php echo URLADM ?>view-pg-home" class="btn btn-primary btn-sm">Visualizar</a>
        </div>

    </div>
    <hr>
    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
    <form method="POST" action="" enctype="multipart/form-data">
        <input name="id" type="hidden" id="id" value="<?php
        if ($valorForm['id']) {
            echo $valorForm['id'];
        }
        ?>">
        
        <input name="imagm_top" type="hidden" id="image_top" value="<?php
        if ($valorForm['image_top']) {
            echo $valorForm['image_top'];
        }
        ?>">

        <div class="form-group">
            <label for="imagem_nova">Foto</label>
            <input name="imagem_nova" type="file" class="form-control" id="imagem_nova" onchange="previewImagem();">
        </div>

        <div class="form-group">
            <?php
            if ($valorForm['image_top']) {
                $imagem_antiga = $valorForm['image_top'];
            }
            ?>
            <img src="<?php echo URLADM . 'app/adms/assets/images/home_top/' . $imagem_antiga; ?>" alt="Imagem do topo" id="preview-img" class="img-thumbnail prev-img">
            
        </div>

        <input name="EditTopImgHome" type="submit" class="btn btn-warning" value="Salvar" >
    </form>
</div>
