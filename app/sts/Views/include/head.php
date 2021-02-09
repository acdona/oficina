<?php
/* Instrução de segurança do PHP que obriga todas as páginas a serem carregadas pelo index */
 if(!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
?>
<!-- Declara o tipo de documento para o navegador ------------------------------------------------------------------------------>
<!DOCTYPE html>
<!-- Seta o idioma padrão navegador -------------------------------------------------------------------------------------------->
<html lang="pt-BR">
<!-- No HEAD ficam os metadados. Metadados são informações sobre a página e o conteúdo na página publicado --------------------->
<head>
    <!-- Especifica a codificação de caracteres para o documento HTML ---------------------------------------------------------->
    <meta charset="utf-8">
    <!-- Define o ícone a ser usado nas páginas "favicon.ico" ------------------------------------------------------------------>
    <link rel="icon" href="<?php echo URL; ?>app/sts/assets/icon/favicon.ico">
    <!-- Configura a página para ser renderizada pelo internet explorer -------------------------------------------------------->
    <meta http-equiv="X-UA-Compatible"            content="IE=edge">
    <!-- desativa estilo de toque padrão dos navegadores ----------------------------------------------------------------------->
    <meta name=    "msapplication-tap-highlight"  content="no">
    <!-- Viewport para controlar o layout em navegadores de dispositivos móveis. Colocando ", shrink-to-fit=no" para bootstrap-->
    <meta name=    "viewport"                     content="width=device-width, initial-scale=1" , shirink-to-fit=no>
    <!-- Define o autor da  ---------------------------------------------------------------------------------------------------->
    <meta name=    "author"                       content="Antonio Carlos Doná">
    <!-- Define uma descrição sobre o que o site é relacionado ----------------------------------------------------------------->
    <meta name=    "description"                  content="Aplicativo para controle de oficina de hardware">
    <!-- Define as palavras chaves relecionadas ao conteúdo do site ------------------------------------------------------------>
    <meta name=    "keywords"                     content="oficina, hardware, micros, impresoras, computadores">
    <!-- Habilita a indexação da página e seguem os links pelos robos de busca ------------------------------------------------->
    <meta name=    "robots"                       content="index,follow">
    <!-- Especifica qual programa foi usado no desenvolvimento do site --------------------------------------------------------->
    <meta name=    "generator"                    content="Visual Studio Code"/>
    <!-- Caminho do bootstrap --------------------------------------------------------------------------------------------------> 
    <link rel=     "stylesheet" href="<?php echo URL; ?>app/sts/assets/css/bootstrap.min.css">
    <!-- Caminho do arquivo de estilo do site----------------------------------------------------------------------------------->
    <link rel=     "stylesheet" type="text/css" href="<?php echo URL; ?>app/sts/assets/css/style.css"> 
    <!--Título que será exibido no site ---------------------------------------------------------------------------------------->
    <title>ACD Consultoria Projeto PHP</title>
<!-- Final do cabeçalho  ------------------------------------------------------------------------------------------------------->
</head>
<!--Início do BODY, onde começa o corpo do site -------------------------------------------------------------------------------->
<body>