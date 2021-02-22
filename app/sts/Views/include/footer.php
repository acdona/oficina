<?php
/* Instrução de segurança do PHP que obriga todas as páginas a serem carregadas pelo index */
 if(!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

extract($this->dados['footer']);
?>

<div class="jumbotron footer-per">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-4">
                <h5><?php echo $title_site; ?></h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="<?php echo URL; ?>" class="link-footer">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo URL; ?>sobre-empresa/index" class="link-footer">Sobre Empresa</a>
                    </li>
                    <li>
                        <a href="<?php echo URL; ?>contato" class="link-footer">Contato</a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-sm-12 col-md-4">
                <h5><?php echo $title_contact; ?></h5>
                <ul class="list-unstyled">
                    <ul class="list-unstyled">
                    <li>
                        <a href="te: <?php echo $phone; ?>" class="link-footer"><?php echo $phone; ?></a>
                    </li>
                    <li>
                        <a href="<?php echo $url_address?>" class="link-footer"><?php echo $address_one; ?></a>
                    </li>
                    <li>
                        <a href="<?php echo $url_cnpj; ?>" class="link-footer"><?php echo $cnpj; ?></a>
                    </li>
                 
                </ul>
            </div>
            <div class="col-12 col-sm-12 col-md-4">
                <h5><?php echo $title_social_networks; ?></h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="<?php echo $link_one_social_networks; ?>" target="_blank" class="link-footer"><?php echo $txt_one_social_networks; ?></a>
                    </li>
                    <li>
                        <a href="<?php echo $link_two_social_networks; ?>" target="_blank" class="link-footer"><?php echo $txt_two_social_networks; ?></a>
                    </li>
                    <li>
                        <a href="<?php echo $link_three_social_networks; ?>" target="_blank" class="link-footer"><?php echo $txt_three_social_networks; ?></a>
                    </li>
                    <li>
                        <a href="<?php echo $link_four_social_networks; ?>" target="_blank" class="link-footer"><?php echo $txt_four_social_networks; ?></a>
                    </li>
                    <li>
                        <a href="<?php echo $link_five_social_networks; ?>" target="_blank" class="link-footer"><?php echo $txt_five_social_networks; ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>