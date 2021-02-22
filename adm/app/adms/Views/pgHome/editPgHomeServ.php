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
            <label for="titulo_serv">Título</label>
            <input name="titulo_serv" type="text" class="form-control" id="titulo_serv" placeholder="Título do serviço" value="<?php
            if ($valorForm['titulo_serv']) {
                echo $valorForm['titulo_serv'];
            }
            ?>">
        </div>
        <div class="form-group">
            <label for="subtitulo_serv">Subtítulo</label>
            <input name="subtitulo_serv" type="text" class="form-control" id="subtitulo_serv" placeholder="Subtítulo do serviço" value="<?php
            if ($valorForm['subtitulo_serv']) {
                echo $valorForm['subtitulo_serv'];
            }
            ?>">
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="titulo_um_serv">Título Serviço Um</label>
                <input name="titulo_um_serv" type="text" class="form-control" id="titulo_um_serv" placeholder="Título Serviço Um" value="<?php
                if ($valorForm['titulo_um_serv']) {
                    echo $valorForm['titulo_um_serv'];
                }
                ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="icone_um_serv">Ícone Serviço Um</label>
                <input name="icone_um_serv" type="text" class="form-control" id="icone_um_serv" placeholder="Ícone Serviço Um" value="<?php
                if ($valorForm['icone_um_serv']) {
                    echo $valorForm['icone_um_serv'];
                }
                ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="desc_um_serv">Descrição Serviço Um</label>
            <textarea name="desc_um_serv" class="form-control" id="desc_um_serv" placeholder="Descrição Serviço Um"><?php
                if ($valorForm['desc_um_serv']) {
                    echo $valorForm['desc_um_serv'];
                }
                ?>
            </textarea>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="titulo_dois_serv">Título Serviço Dois</label>
                <input name="titulo_dois_serv" type="text" class="form-control" id="titulo_dois_serv" placeholder="Título Serviço Dois" value="<?php
                if ($valorForm['titulo_dois_serv']) {
                    echo $valorForm['titulo_dois_serv'];
                }
                ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="icone_dois_serv">Ícone Serviço Dois</label>
                <input name="icone_dois_serv" type="text" class="form-control" id="icone_dois_serv" placeholder="Ícone Serviço Dois" value="<?php
                if ($valorForm['icone_dois_serv']) {
                    echo $valorForm['icone_dois_serv'];
                }
                ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="desc_dois_serv">Descrição Serviço Dois</label>
            <textarea name="desc_dois_serv" class="form-control" id="desc_dois_serv" placeholder="Descrição Serviço Dois"><?php
                if ($valorForm['desc_dois_serv']) {
                    echo $valorForm['desc_dois_serv'];
                }
                ?>
            </textarea>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="titulo_tres_serv">Título Serviço Três</label>
                <input name="titulo_tres_serv" type="text" class="form-control" id="titulo_tres_serv" placeholder="Título Serviço Três" value="<?php
                if ($valorForm['titulo_tres_serv']) {
                    echo $valorForm['titulo_tres_serv'];
                }
                ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="icone_tres_serv">Ícone Serviço Três</label>
                <input name="icone_tres_serv" type="text" class="form-control" id="icone_tres_serv" placeholder="Ícone Serviço Três" value="<?php
                if ($valorForm['icone_tres_serv']) {
                    echo $valorForm['icone_tres_serv'];
                }
                ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="desc_tres_serv">Descrição Serviço Três</label>
            <textarea name="desc_tres_serv" class="form-control" id="desc_tres_serv" placeholder="Descrição Serviço Três"><?php
                if ($valorForm['desc_tres_serv']) {
                    echo $valorForm['desc_tres_serv'];
                }
                ?>
            </textarea>
        </div>

        <input name="EditServHome" type="submit" class="btn btn-warning" value="Salvar" >
    </form>
</div>