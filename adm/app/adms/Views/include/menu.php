<?php
if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="<?php echo URL ?>">AMACD</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample07">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLADM ?>dashboard/index">Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Listagem</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown07">
                        <a class="dropdown-item" href="<?php echo URL; ?>home/index">Home</a>
                        <a class="dropdown-item" href="<?php echo URLADM ?>list-account-category/index">Categorias das Contas</a>
                        <a class="dropdown-item" href="<?php echo URLADM ?>list-category/index">Categorias</a>
                        <a class="dropdown-item" href="<?php echo URLADM ?>list-cities/index">Cidades</a>
                        <a class="dropdown-item" href="<?php echo URLADM ?>list-colors/index">Cores</a>
                        <a class="dropdown-item" href="<?php echo URLADM ?>list-stis-users/index">Situação Usuário</a>
                        <a class="dropdown-item" href="<?php echo URLADM ?>list-sts-services/index">Situação Serviços</a>
                        <a class="dropdown-item" href="<?php echo URLADM ?>list-users/index">Usuários</a>
                        
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLADM; ?>sair/index">Sair</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
