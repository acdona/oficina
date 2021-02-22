<?php
if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
?>
<div class="container">
    <div class="d-flex">
        <div class="mr-auto p-2">
            <h1>Detalhes da página home</h1>
        </div>        
    </div>

    <hr>
    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
    <div class="d-flex">
        <div class="mr-auto p-2">
            <h2>Detalhes do Topo</h2>
        </div>
        <div class="p-2">
            <a href="<?php echo URLADM ?>edit-top-pg-home" class="btn btn-warning btn-sm">Editar</a>
        </div>        
    </div>

    <?php
    if (!empty($this->dados['home']['top'])) {
        extract($this->dados['home']['top']);
        ?>
        <dl class = "row">            
            <dt class = "col-sm-3">Imagem</dt>
            <dd class = "col-sm-9">
                <div class="img-perfil">
                    <img src="<?php echo URLADM . 'app/adms/assets/images/home_top/' . $image_top; ?>" width="250" height="141">
                    <div class="edit">
                        <a href="<?php echo URLADM ?>edit-top-img-pg-home" class="btn btn-outline-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                </div>
            </dd>

            <dt class = "col-sm-3">Título</dt>
            <dd class = "col-sm-9"><?php echo $title_top; ?></dd>

            <dt class = "col-sm-3">Subtitulo</dt>
            <dd class = "col-sm-9"><?php echo $subtitle_top; ?></dd>

            <dt class = "col-sm-3">Texto do Botão</dt>
            <dd class = "col-sm-9"><?php echo $text_btn_top; ?></dd>

            <dt class = "col-sm-3">Link do Botão</dt>
            <dd class = "col-sm-9"><?php echo $link_btn_top; ?></dd>
        </dl>

        <?php
    } else {
        echo '<div class="alert alert-danger" role="alert">Erro: O topo do site não possui nenhum registro!</div>';
    }
    ?>
    <hr>

    <div class="d-flex">
        <div class="mr-auto p-2">
            <h2>Detalhes dos Serviços</h2>
        </div>
        <div class="p-2">
            <a href="<?php echo URLADM ?>edit-serv-pg-home" class="btn btn-warning btn-sm">Editar</a>
        </div>        
    </div>
    <?php
    if (!empty($this->dados['home']['serv'])) {
        extract($this->dados['home']['serv']);
        ?>
        <dl class = "row">     

            <dt class = "col-sm-3">Título</dt>
            <dd class = "col-sm-9"><?php echo $title_serv; ?></dd>

            <dt class = "col-sm-3">Subtitulo</dt>
            <dd class = "col-sm-9"><?php echo $subtitle_serv; ?></dd>

            <dt class = "col-sm-3">Ícone do Serviço Um</dt>
            <dd class = "col-sm-9">
                <i class="<?php echo $icone_one_serv; ?>"></i> - 
                <?php echo $icone_one_serv; ?>
            </dd>

            <dt class = "col-sm-3">Titulo do Serviço Um</dt>
            <dd class = "col-sm-9"><?php echo $title_one_serv; ?></dd>

            <dt class = "col-sm-3">Descrição do Serviço Um</dt>
            <dd class = "col-sm-9"><?php echo $desc_one_serv; ?></dd>

            <dt class = "col-sm-3">Ícone do Serviço Dois</dt>
            <dd class = "col-sm-9">
                <i class="<?php echo $icon_two_serv; ?>"></i> - 
                <?php echo $icon_two_serv; ?>
            </dd>

            <dt class = "col-sm-3">Titulo do Serviço Dois</dt>
            <dd class = "col-sm-9"><?php echo $title_two_serv; ?></dd>

            <dt class = "col-sm-3">Descrição do Serviço Dois</dt>
            <dd class = "col-sm-9"><?php echo $desc_two_serv; ?></dd>

            <dt class = "col-sm-3">Ícone do Serviço Três</dt>
            <dd class = "col-sm-9">
                <i class="<?php echo $icon_three_serv; ?>"></i> - 
                <?php echo $icon_three_serv; ?>
            </dd>

            <dt class = "col-sm-3">Titulo do Serviço Três</dt>
            <dd class = "col-sm-9"><?php echo $title_three_serv; ?></dd>

            <dt class = "col-sm-3">Descrição do Serviço Três</dt>
            <dd class = "col-sm-9"><?php echo $desc_three_serv; ?></dd>
        </dl>

        <?php
    } else {
        echo '<div class="alert alert-danger" role="alert">Erro: O serviço do site não possui nenhum registro!</div>';
    }
    ?>
    <hr>

    <div class="d-flex">
        <div class="mr-auto p-2">
            <h2>Detalhes do Ação</h2>
        </div>
        <div class="p-2">
            <a href="<?php echo URLADM ?>acao" class="btn btn-warning btn-sm">Editar</a>
        </div>        
    </div>
    <?php
    if (!empty($this->dados['home']['acao'])) {
        extract($this->dados['home']['acao']);
        ?>
        <dl class = "row">            
            <dt class = "col-sm-3">Imagem</dt>
            <dd class = "col-sm-9">
                <img src="<?php echo URLADM . 'app/adms/assets/images/home_action/' . $image_action; ?>" width="250" height="141">
            </dd>

            <dt class = "col-sm-3">Título</dt>
            <dd class = "col-sm-9"><?php echo $title_action; ?></dd>

            <dt class = "col-sm-3">Subtitulo</dt>
            <dd class = "col-sm-9"><?php echo $subtitle_action; ?></dd>

            <dt class = "col-sm-3">Descrição</dt>
            <dd class = "col-sm-9"><?php echo $desc_action; ?></dd>

            <dt class = "col-sm-3">Texto do Botão</dt>
            <dd class = "col-sm-9"><?php echo $text_btn_action; ?></dd>

            <dt class = "col-sm-3">Link do Botão</dt>
            <dd class = "col-sm-9"><?php echo $link_btn_action; ?></dd>
        </dl>

        <?php
    } else {
        echo '<div class="alert alert-danger" role="alert">Erro: O ação do site não possui nenhum registro!</div>';
    }
    ?>

    <hr>

    <div class="d-flex">
        <div class="mr-auto p-2">
            <h2>Detalhes do Contato</h2>
        </div>
        <div class="p-2">
            <a href="<?php echo URLADM ?>contato" class="btn btn-warning btn-sm">Editar</a>
        </div>        
    </div>
    <?php
    if (!empty($this->dados['home']['contato'])) {
        extract($this->dados['home']['contato']);
        ?>
        <dl class = "row">  

            <dt class = "col-sm-3">Título</dt>
            <dd class = "col-sm-9"><?php echo $title_contact; ?></dd>

            <dt class = "col-sm-3">Subtitulo</dt>
            <dd class = "col-sm-9"><?php echo $subtitle_contact; ?></dd>

            <dt class = "col-sm-3">Endereço</dt>
            <dd class = "col-sm-9"><?php echo $address_contact; ?></dd>

            <dt class = "col-sm-3">Telefone</dt>
            <dd class = "col-sm-9"><?php echo $phone_contact; ?></dd>

            <dt class = "col-sm-3">E-mail</dt>
            <dd class = "col-sm-9"><?php echo $email_contact; ?></dd>
        </dl>

        <?php
    } else {
        echo '<div class="alert alert-danger" role="alert">Erro: O contato do site não possui nenhum registro!</div>';
    }
    ?>
</div>
