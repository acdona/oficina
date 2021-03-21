<?php
 
 if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

$sidebar_active = "";
if(isset($this->data['sidebarActive'])){
    $sidebar_active = $this->data['sidebarActive'];
}
?>

<nav class="sidebar">
    <ul class="list-unstyled">
    <li class="<?php if($sidebar_active == "dashboard"){ echo 'active'; } ?>"><a href="<?php echo URLADM; ?>dashboard/index"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
     
    <li>
        <a href="#submenu4" data-toggle="collapse"><i class="fas fa-user"></i> Usuário</a>
        <ul id="submenu4" class="list-unstyled collapse">
            <li class="<?php if($sidebar_active == "list-users"){ echo 'active'; } ?>"><a href="<?php echo URLADM; ?>list-users/index"><i class="fas fa-users"></i> Usuários</a></li>
            <li class="<?php if($sidebar_active == "list-sits-users"){ echo 'active'; } ?>"><a href="<?php echo URLADM; ?>list-sits-users/index"><i class="fas fa-user-lock"></i> Situação Usuário</a></li>
            <li class="<?php if($sidebar_active == "list-access-levels"){ echo 'active'; } ?>"><a href="<?php echo URLADM; ?>list-access-levels/index"><i class="fas fa-key"></i> Nível de Acesso</a></li>
        </ul>
    </li>

    <li>
        <a href="#submenu5" data-toggle="collapse"><i class="fas fa-cogs"></i> Configurações</a>
        <ul id="submenu5" class="list-unstyled collapse">
            <li class="<?php if($sidebar_active == "list-colors"){ echo 'active'; } ?>"><a href="<?php echo URLADM; ?>list-colors/index"><i class="fas fa-palette"></i> Cores</a></li>
            <li class="<?php if($sidebar_active == "list-conf-emails"){ echo 'active'; } ?>"><a href="<?php echo URLADM; ?>list-conf-emails/index"><i class="fas fa-envelope"></i> Configuração de E-mail</a></li>
            <li class="<?php if($sidebar_active == "view-form-level"){ echo 'active'; } ?>"><a href="<?php echo URLADM; ?>view-form-level/index"><i class="fas fa-user-cog"></i> Formulário Usuário</a></li>
            <li class="<?php if($sidebar_active == "list-types-pages"){ echo 'active'; } ?>"><a href="<?php echo URLADM; ?>list-types-pages/index"><i class="fas fa-file-alt"></i> Tipos de Página</a></li>
            <li class="<?php if($sidebar_active == "list-sits-pages"){ echo 'active'; } ?>"><a href="<?php echo URLADM; ?>list-sits-pages/index"><i class="far fa-file-alt"></i> Situação de Página</a></li>
            <li class="<?php if($sidebar_active == "list-groups-pages"){ echo 'active'; } ?>"><a href="<?php echo URLADM; ?>list-groups-pages/index"><i class="far fa-file-alt"></i> Grupo de Página</a></li>
            <li class="<?php if($sidebar_active == "list-pages"){ echo 'active'; } ?>"><a href="<?php echo URLADM; ?>list-pages/index"><i class="far fa-file-alt"></i> Listar Páginas</a></li>
            <li class="<?php if($sidebar_active == "list-contacts-page"){ echo 'active'; } ?>"><a href="<?php echo URLADM; ?>list-contacts-page/index"><i class="fas fa-address-book"></i> Contato da Página</a></li>
            
        </ul>
    </li>

    <li class="<?php if($sidebar_active == "view-profile"){ echo 'active'; } ?>"><a href="<?php echo URLADM; ?>view-profile/index"><i class="far fa-user"></i> Perfil</a></li>
        <li><a href="<?php echo URLADM; ?>logout/index"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
    </ul>

</nav>