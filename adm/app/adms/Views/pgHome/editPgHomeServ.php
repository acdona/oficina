<?php
if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

if (isset($this->dados['serv'])) {
    $valorForm = $this->dados['serv'];
}
?>
<div class="container">
    <div class="d-flex">
        <div class="mr-auto p-2">
            <h1>Editar Serviços</h1>
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
    <form method="POST" action="">
        <input name="id" type="hidden" id="id" value="<?php
        if ($valorForm['id']) {
            echo $valorForm['id'];
        }
        ?>">

        <div class="form-group">
            <label for="title_serv">Título</label>
            <input name="title_serv" type="text" class="form-control" id="title_serv" placeholder="Título do serviço" value="<?php
            if ($valorForm['title_serv']) {
                echo $valorForm['title_serv'];
            }
            ?>">
        </div>
        <div class="form-group">
            <label for="subtitle_serv">Subtítulo</label>
            <input name="subtitle_serv" type="text" class="form-control" id="subtitle_serv" placeholder="Subtítulo do serviço" value="<?php
            if ($valorForm['subtitle_serv']) {
                echo $valorForm['subtitle_serv'];
            }
            ?>">
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="title_one_serv">Título Serviço Um</label>
                <input name="title_one_serv" type="text" class="form-control" id="title_one_serv" placeholder="Título Serviço Um" value="<?php
                if ($valorForm['title_one_serv']) {
                    echo $valorForm['title_one_serv'];
                }
                ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="icone_one_serv">Ícone Serviço Um</label>
                <input name="icone_one_serv" type="text" class="form-control" id="icone_one_serv" placeholder="Ícone Serviço Um" value="<?php
                if ($valorForm['icone_one_serv']) {
                    echo $valorForm['icone_one_serv'];
                }
                ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="desc_one_serv">Descrição Serviço Um</label>
            <textarea name="desc_one_serv" class="form-control" id="desc_one_serv" placeholder="Descrição Serviço Um"><?php
                if ($valorForm['desc_one_serv']) {
                    echo $valorForm['desc_one_serv'];
                }
                ?>
            </textarea>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="title_two_serv">Título Serviço Dois</label>
                <input name="title_two_serv" type="text" class="form-control" id="title_two_serv" placeholder="Título Serviço Dois" value="<?php
                if ($valorForm['title_two_serv']) {
                    echo $valorForm['title_two_serv'];
                }
                ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="icon_two_serv">Ícone Serviço Dois</label>
                <input name="icon_two_serv" type="text" class="form-control" id="icon_two_serv" placeholder="Ícone Serviço Dois" value="<?php
                if ($valorForm['icon_two_serv']) {
                    echo $valorForm['icon_two_serv'];
                }
                ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="desc_two_serv">Descrição Serviço Dois</label>
            <textarea name="desc_two_serv" class="form-control" id="desc_two_serv" placeholder="Descrição Serviço Dois"><?php
                if ($valorForm['desc_two_serv']) {
                    echo $valorForm['desc_two_serv'];
                }
                ?>
            </textarea>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="title_three_serv">Título Serviço Três</label>
                <input name="title_three_serv" type="text" class="form-control" id="title_three_serv" placeholder="Título Serviço Três" value="<?php
                if ($valorForm['title_three_serv']) {
                    echo $valorForm['title_three_serv'];
                }
                ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="icon_three_serv">Ícone Serviço Três</label>
                <input name="icon_three_serv" type="text" class="form-control" id="icon_three_serv" placeholder="Ícone Serviço Três" value="<?php
                if ($valorForm['icon_three_serv']) {
                    echo $valorForm['icon_three_serv'];
                }
                ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="desc_three_serv">Descrição Serviço Três</label>
            <textarea name="desc_three_serv" class="form-control" id="desc_three_serv" placeholder="Descrição Serviço Três"><?php
                if ($valorForm['desc_three_serv']) {
                    echo $valorForm['desc_three_serv'];
                }
                ?>
            </textarea>
        </div>

        <input name="EditServHome" type="submit" class="btn btn-warning" value="Salvar" >
    </form>
</div>