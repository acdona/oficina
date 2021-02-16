<?php
/* Instrução de segurança do PHP que obriga todas as páginas a serem carregadas pelo index */
 if(!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
?>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-primary">
    <div class="container">
        <a class="navbar-brand" href="<?php echo URL; ?>">AMACD</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample07">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL; ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL; ?>sobre-empresa/index">Sobre Empresa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL; ?>list-category/index">Categorias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL; ?>list-account-category/index">Categorias de Contas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL; ?>add-user/index">Adicionar User</a>
                </li>
            </ul>                    
        </div>
    </div>
</nav>