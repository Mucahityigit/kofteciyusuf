<?php 
ob_start();
include "nedmin/baglan.php"; 
    if($_GET["masa_id"]){
        $masa_id = base64_decode($_GET["masa_id"]);
    }
    $urunlersorgusu = $db -> prepare("SELECT * FROM urunler");
    $urunlersorgusu -> execute();
    $urunler = $urunlersorgusu->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/345bcb7635.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style2.css">
    <title>Köfteci Yusuf</title>
</head>

<body>
    <!-- HEADER AREA -->

    <div id="header-container">
        <div id="header">
            <div id="logo-container">
                <a id="logo" href="index.php?masa_id=<?php echo base64_encode($masa_id) ?>"><img src="resimler/kofteciyusuflogo.png" alt=""></a>
            </div>
            <div id="search-container">
                <form action="index.php" method="GET">
                    <input id="search-input" name="aranan" type="text" placeholder="Ürün ismini yazınız">
                    <button id="search-btn" type="submit"><span id="search-icon"><i class="fas fa-search"></i></span></button>
                </form>
            </div>
            <div id="menu-container">
                <ul id="menu-list">
                    <li class="menu-item"><a class="menu-item-a" href="index.php?masa_id=<?php echo base64_encode($masa_id) ?>">Ana Sayfa</a> </li>
                    <li class="menu-item"><a class="menu-item-a" href="#">Ürünler</a> </li>
                    <li class="menu-item"><a class="menu-item-a" href="#">İletişim</a> </li>
                </ul>
            </div>
        </div>
    </div>