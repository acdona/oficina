<!-- Declara o tipo de documento para o navegador -------------------------------------------------------------------------------- -->
<!DOCTYPE html>
<!-- Seta o idioma padrão navegador ---------------------------------------------------------------------------------------------- -->
<html lang="pt-br">
    <!-- No HEAD ficam os metadados. Metadados são informações sobre a página e o conteúdo na página publicado ------------------- -->
    <head>
        <!-- Especifica a codificação de caracteres para o documento HTML -------------------------------------------------------- -->
        <meta charset="utf-8">
        <!-- Define o ícone a ser usado nas páginas "favicon.ico" ---------------------------------------------------------------- -->
        <link rel="icon" href="app/oficina/assets/images/favicon.ico">
        <!-- Configura a página para ser renderizada pelo Internet Explorer ------------------------------------------------------ -->
        <meta http-equiv="X-UA-Compatible"            content="IE=edge">
        <!-- desativa estilo de toque padrão dos navegadores --------------------------------------------------------------------- -->
        <meta name=    "msapplication-tap-highlight"  content="no">
        <!-- Viewport para controlar o layout em navegadores de dispositivos móveis. Colocando ", shrink-to-fit=no" para bootstrap -->
        <meta name=    "viewport"                     content="width=device-width, initial-scale=1, shirink-to-fit=no">
        <!-- Define o autor do site ---------------------------------------------------------------------------------------------- -->
        <meta name=    "author"                       content="AMACD - Agência de Marketing Antonio Carlos Doná">
        <!-- Define uma descrição sobre o que o site é relacionado --------------------------------------------------------------- -->
        <meta name=    "description"                  content="Projeto de oficina de hardware">
        <!-- Define as palavras chaves relecionadas ao conteúdo do site ---------------------------------------------------------- -->
        <meta name=    "keywords"                     content="Manutenção de hardware como computadores, monitores, impressoras">
        <!-- Habilita a indexação da página e seguem os links pelos robos de busca ----------------------------------------------- -->
        <meta name=    "robots"                       content="index,follow">
        <!-- Especifica qual programa foi usado no desenvolvimento do site ------------------------------------------------------- -->
        <meta name=    "generator"                    content="Visual Studio Code"/>
        <!-- Caminho do bootstrap ------------------------------------------------------------------------------------------------ -->
        <link rel= "stylesheet" href="app/oficina/assets/css/all.mim.css">
        <!-- Caminho do FontAwesome ---------------------------------------------------------------------------------------------- -->
        <link rel=     "stylesheet" type="text/css" href="app/oficina/assets/css/style.css">
        <!-- Caminho do arquivo de estilo do site--------------------------------------------------------------------------------- -->
        <link rel=     "stylesheet" type="text/css" href="app/oficina/assets/css/style.css">
        <!--Título que será exibido no site -------------------------------------------------------------------------------------- -->
        <title>ACD Consultoria</title>
        <!-- Final do cabeçalho  ------------------------------------------------------------------------------------------------- -->
    </head>
    <body>
   

            <?php
            //Inicia uma nova sessão
             session_start();
    
            // Inicializa o buffer e bloqueia qualquer saída para o navegador
            ob_start();
    
            require "./vendor/autoload.php";
            use Core\ConfigController as Home;
            $url = new Home();
            $url->__construct();
            
             
            echo "<a href='" . URLADM . "testes/teste.php'>Apagar</a><br>";
            
              
            ?>
        
            <!-- Optional JavaScript ------------------------------------------------------------------------------------------------- -->
            
            <!--Caminho do jquery ---------------------------------------------------------------------------------------------------- -->
            <script src=   "app/oficina/assets/js/jquery-3.5.1.slim.min.js"></script>
            <!--Caminho do Bootstrap -- ---------------------------------------------------------------------------------------------- -->
            <script src=   "app/oficina/assets/js/bootstrap.bundle.min.js"></script>
            <script src=   "app/oficina/assets/js/bootstrap.min.js"></script>
        </body>
    </html>