<?php

require __DIR__ . "/vendor/autoload.php";

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

switch ($path) {
    case '/':
        header("Location: /");
        break;
    
    default:
        # code...
        break;
}

/*

        Definition of class: 

        Definition of object: 

        Definition of heritage:

        Definition of Encapsulation:

        Definition of Abstraction :

*/