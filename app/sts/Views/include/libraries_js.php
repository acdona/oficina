<?php
/* Instrução de segurança do PHP que obriga todas as páginas a serem carregadas pelo index */
 if(!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
?>

<!--------------------------------- Scripts que devem ficar no final da página ------------------------------------------------->
   
    <!-- Caminho da Font Awesome ----------------------------------------------------------------------------------------------->
    <script src=   "<?php echo URL; ?>app/sts/assets/js/all.js"></script>
    <!-- Caminho do jquery 3.5.1 ----------------------------------------------------------------------------------------------->
    <script src=   "<?php echo URL; ?>app/sts/assets/js/jquery-3.5.1.slim.min.js"></script>
    <!-- Caminho do popper ----- ----------------------------------------------------------------------------------------------->
    <script src=   "<?php echo URL; ?>app/sts/assets/js/popper.min.js"></script>
    <!-- Caminho do bootstrap -------------------------------------------------------------------------------------------------->
    <script src=   "<?php echo URL; ?>app/sts/assets/js/bootstrap.min.js"></script>

<!--------------------------------  Fim do BODY, onde encerra o corpo do site -------------------------------------------------->
</body>
</html>