            <?php
            session_start();
            ob_start();

            define('48b5t9', true);
         
            // Carrega o autoload para chamada dos Controllers
            require "./vendor/autoload.php";
     
            // Cria um apelido Home para ConfigController
            use Core\ConfigController as Home;
            $url = new Home();
            $url->carregar();
 
            ?>
        