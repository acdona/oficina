<?php
 
 if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
 
?>

<nav class="navbar navbar-expand navbar-dark bg-primary">

<a class="sidebar-toggle text-light mr-3">
    <span class="navbar-toggler-icon"></span>
</a>

<a class="navbar-brand" href="index.html">ACD</a>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle menu-header" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="./image/usuario.png" class="rounded-circle img-user"> &nbsp;<span class="d-none d-sm-inline">Usuário</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?php echo URLADM; ?>view-perfil/index"><i class="fas fa-user"></i> Perfil</a>
                <a class="dropdown-item" href="<?php echo URLADM; ?>sair/index"><i class="fas fa-sign-out-alt"></i> Sair</a>
            </div>
        </li>
    </ul>
</div>
</nav>

<div class="d-flex">
<nav class="sidebar">
    <ul class="list-unstyled">
        <li class="active"><a href="<?php echo URLADM; ?>dashboard/index"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
        <li><a href="<?php echo URLADM; ?>list-users/index"><i class="fas fa-users"></i> Usuários</a></li>
        <li><a href="#">Item 3</a></li>

        <li>
            <a href="#submenu4" data-toggle="collapse"><i class="fas fa-video"></i> Item 4</a>
            <ul id="submenu4" class="list-unstyled collapse">
                <li><a href="#"><i class="fab fa-youtube"></i> Item 4.1</a></li>
                <li><a href="#"><i class="fab fa-vimeo-v"></i> Item 4.2</a></li>
            </ul>
        </li>


        <li>
            <a href="#submenu5" data-toggle="collapse"><i class="fas fa-car"></i> Item 5</a>
            <ul id="submenu5" class="list-unstyled collapse">
                <li><a href="#"><i class="fas fa-bus"></i> Item 5.1</a></li>
                <li><a href="#"><i class="fas fa-car-side"></i> Item 5.2</a></li>
                <li><a href="#"><i class="fas fa-shuttle-van"></i> Item 5.3</a></li>
                <li><a href="#"><i class="fas fa-truck"></i> Item 5.4</a></li>
                <li><a href="#"><i class="fas fa-gas-pump"></i> Item 5.5</a></li>
                <!-- Para manter o submenu aberto e selecionado utilizar: class="active" -->
                <!--<li class="active"><a href="#"><i class="fas fa-car-battery"></i> Item 5.6</a></li>-->
                <li><a href="#"><i class="fas fa-oil-can"></i> Item 5.7</a></li>
            </ul>
        </li>
        <li><a href="#">Item 6</a></li>
        <li><a href="#">Item 7</a></li>
        <li><a href="#">Item 8</a></li>
        <li><a href="<?php echo URLADM; ?>view-perfil/index"><i class="far fa-user"></i> Perfil</a></li>
        <li><a href="<?php echo URLADM; ?>sair/index"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
    </ul>
</nav>

<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 title">Dashboard</h2>
            </div>                        
        </div>
        <hr class="hr-title">
        <div class="row mb-3">
            <div class="col-lg-3 col-sm-6 mb-sm-2 card-dash">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <i class="fas fa-users fa-3x"></i>
                        <h6 class="card-title">Usuários</h6>
                        <h2 class="lead">147</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 card-dash">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <i class="fas fa-eye fa-3x"></i>
                        <h6 class="card-title">Visitas</h6>
                        <h2 class="lead">647</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 card-dash">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <i class="fas fa-comments fa-3x"></i>
                        <h6 class="card-title">Comentários</h6>
                        <h2 class="lead">14</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 card-dash">
                <div class="card bg-danger text-white">
                    <div class="card-body">                                    
                        <i class="far fa-file fa-3x"></i>
                        <h6 class="card-title">Artigos</h6>
                        <h2 class="lead">58</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



<a href="<?php echo URLADM; ?>dashboard/index">Dashboard</a><br>
<a href="<?php echo URLADM; ?>list-users/index">Usuários</a><br>
<a href="<?php echo URLADM; ?>list-sits-users/index">Situação Usuários</a><br>
<a href="<?php echo URLADM; ?>list-colors/index">Cores</a><br>
<a href="<?php echo URLADM; ?>list-conf-emails/index">Configuração de E-mail</a><br>
<a href="<?php echo URLADM; ?>view-perfil/index">Perfil</a><br>
<a href="<?php echo URLADM; ?>sair/index">Sair</a><br>
<hr>