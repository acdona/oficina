<?php
/* Instrução de segurança do PHP que obriga todas as páginas a serem carregadas pelo index */
 if(!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
?>