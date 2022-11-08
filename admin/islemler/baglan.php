<?php
session_start();

try {
    $db = new PDO("mysql:host=localhost;dbname=xne33esa_kofteciyusuf;charset=utf8","xne33esa_mucahit","xf)@M1RCTHN}");
    //$db = new PDO("mysql:host=localhost;dbname=kofteciyusuf;charset=utf8","root","");
} catch (PDOException $hata) {
    echo $hata->getMessage();
}


$ayarsor = $db->prepare("SELECT * FROM ayarlar");
$ayarsor->execute();
$ayarcek = $ayarsor->fetch(PDO::FETCH_ASSOC);
