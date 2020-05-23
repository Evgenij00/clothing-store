<?php
    namespace MyProject\Exceptions;

    class DbException extends \Exception { // обязательно "\"

        // public function __construct(string $textError, string $error){
        //     echo $textError;
        // }
        
    }

    function vardump($var) {
        static $int=0;
        echo '<pre><b style="background: blue;padding: 1px 5px;">'.$int.'</b> ';
        var_dump($var);
        echo '</pre>';
        $int++;
    }