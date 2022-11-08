<?php
    try {
        $db = new PDO("mysql:host=localhost;dbname=xne33esa_kofteciyusuf;charset=utf8","xne33esa_mucahit","xf)@M1RCTHN}");
        //$db = new PDO("mysql:host=localhost;dbname=kofteciyusuf;charset=utf8","root","");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
?>