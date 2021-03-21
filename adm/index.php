<?php
    //Start a new session.
    session_start();

    //Clear the buffer and block any output to the browser.
    ob_start();

    // Defines a security key for all pages of the project.
    define('R4F5CC', true);

    //Loads the autoload.
    require './vendor/autoload.php';

    //Assign a nickname to then class route.
    use Core\ConfigController as Login;
    
    //Instantiates then ConfigController class.
    $url = new Login();
    
    //Instantiate the method.
    $url->load();
?>