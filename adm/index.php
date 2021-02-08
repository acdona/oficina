<?php
 //iniciar sessão
 session_start();
 //limpar o buffer de saída
 ob_start();
 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shirink-to-fit=no ">
    <title>Login</title>
</head>
<body>

<?php

require './vendor/autoload.php';

use Core\ConfigController as Home;
$url = new Home();
$url->carregar();

?>
    
</body>
</html>
        