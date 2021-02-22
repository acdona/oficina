<?php
if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
?>
<div class="container">
    <?php
    echo "Bem vindo " . $_SESSION['user_name'] . "<br>";
    echo "<a href='" . URLADM . "sair'>Sair</a>";
    ?>
</div>