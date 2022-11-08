<?php
require "baglan.php";

if (isset($_POST['ayarkaydet'])) {



    $ayarguncelle = $db->prepare("UPDATE ayarlar SET 
            site_baslik=:site_baslik,
            site_aciklama=:site_aciklama,
            site_link=:site_link,
            site_sahip_mail=:site_sahip_mail,
            site_mail_host=:site_mail_host,
            site_mail_mail=:site_mail_mail,
            site_mail_port=:site_mail_port,
            site_mail_sifre=:site_mail_sifre WHERE id=1
        ");

    $guncelle = $ayarguncelle->execute(array(
        'site_baslik' => $_POST['site_baslik'],
        'site_aciklama' => $_POST['site_aciklama'],
        'site_link' => $_POST['site_link'],
        'site_sahip_mail' => $_POST['site_sahip_mail'],
        'site_mail_host' => $_POST['site_mail_host'],
        'site_mail_mail' => $_POST['site_mail_mail'],
        'site_mail_port' => $_POST['site_mail_port'],
        'site_mail_sifre' => $_POST['site_mail_sifre']
    ));

    if ($_FILES['site_logo']['error'] == "0") {
        $gecici_ismi = $_FILES['site_logo']['tmp_name'];
        $dosya_ismi = rand(100000, 999999) . $_FILES['site_logo']['name'];
        move_uploaded_file($gecici_ismi, "../dosyalar/$dosya_ismi");

        $ayarguncelle = $db->prepare("UPDATE ayarlar SET 
                site_logo=:site_logo 
        ");

        $guncelle = $ayarguncelle->execute(array(
            'site_logo' => $dosya_ismi
        ));
    }

    if ($guncelle) {
        header("Location:../ayarlar.php?durum=ok");
    } else {
        header("Location:../ayarlar.php?durum=no");
    }
    exit;
}

if (isset($_POST['oturumacma'])) {
    $gelen_mail = $_POST['kul_mail'];
    $gelen_sifre = md5($_POST['kul_sifre']);
    $kullanicisor = $db->prepare("SELECT * FROM kullanicilar WHERE kul_mail = ?  AND kul_sifre = ?   ");
    $kullanicisor->execute([$gelen_mail, $gelen_sifre]);
    $say = $kullanicisor->rowCount();
    $kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);

    if ($say == 0) {
        header("Location:../index.php?durum=no");
    } else {

        $_SESSION['kul_isim'] = $kullanicicek['kul_isim'];
        $_SESSION['kul_mail'] = $kullanicicek['kul_mail'];
        $_SESSION['kul_id'] = $kullanicicek['kul_id'];
        header("Location:../index.php?durum=ok");
    }
    exit;
}


if (isset($_POST['profilkaydet'])) {

    $profilguncelle = $db->prepare("UPDATE kullanicilar SET 
            kul_isim=:kul_isim,
            kul_mail=:kul_mail,
            kul_tel=:kul_tel WHERE kul_id=:kul_id       
        ");

    $guncelle = $profilguncelle->execute(array(
        'kul_isim' => $_POST['kul_isim'],
        'kul_mail' => $_POST['kul_mail'],
        'kul_tel' => $_POST['kul_tel'],
        'kul_id' => $_SESSION['kul_id']
    ));

    if (strlen($_POST['kul_sifre']) > 0) {
        $profilguncelle = $db->prepare("UPDATE kullanicilar SET 
            kul_sifre=:kul_sifre
             WHERE kul_id=:kul_id       
        ");

        $guncelle = $profilguncelle->execute(array(
            'kul_sifre' => md5($_POST['kul_sifre']),
            'kul_id' => $_SESSION['kul_id']
        ));
    }

    if ($guncelle) {
        header("Location:../profil.php?durum=ok");
    } else {
        header("Location:../profil.php?durum=no");
    }
}

if(isset($_POST["siparisekle"])){
    $masa_id = $_POST["masa_id"];
    $masa_id_encode = base64_encode($_POST["masa_id"]);
    $siparisekle = $db->prepare("INSERT INTO siparisler SET 
        masa_id=:masa_id,
        urun_id=:urun_id,
        siparis_durumu=:siparis_durumu
    ");
    $ekle = $siparisekle->execute(array(
        'masa_id' => $_POST['masa_id'],
        'urun_id' => $_POST['urun_id'],
        'siparis_durumu' => "HAZIRLANIYOR"
    ));

    if ($ekle) {
        header("Location:../../index.php?masa_id=$masa_id_encode");
    }
}

if(isset($_POST["anasayfaurunsil"])){
    $masa_id = $_POST["masa_id"];
    $masa_id_encode = base64_encode($_POST["masa_id"]);
    $urun_id = $_POST["urun_id"];
    $siparis_id = $_POST["siparis_id"];
    $urunsil = $db->prepare("DELETE FROM siparisler WHERE masa_id=:masa_id AND urun_id=:urun_id AND siparis_id=:siparis_id");
    $kontrol = $urunsil->execute([
        'masa_id' => $masa_id,
        'urun_id' => $urun_id,
        'siparis_id' => $siparis_id
    ]);

    if($kontrol){
        header("Location:../../index.php?masa_id=$masa_id_encode");
    }
}
if(isset($_POST["odemeurunsil"])){
    $masa_id = $_POST["masa_id"];
    $masa_id_encode = base64_encode($_POST["masa_id"]);
    $urun_id = $_POST["urun_id"];
    $siparis_id = $_POST["siparis_id"];
    $urunsil = $db->prepare("DELETE FROM siparisler WHERE masa_id=:masa_id AND urun_id=:urun_id AND siparis_id=:siparis_id");
    $kontrol = $urunsil->execute([
        'masa_id' => $masa_id,
        'urun_id' => $urun_id,
        'siparis_id' => $siparis_id
    ]);

    if($kontrol){
        header("Location:../../odeme.php?masa_id=$masa_id_encode");
    }
}

if(isset($_POST["odemeisleminitamamla"])){
    $masa_id        =   $_POST["masa_id"];
    $masa_id_encode = base64_encode($_POST["masa_id"]);
    $masa_detay       =   $_POST["masa_detay"];
    $kart_adi       =   $_POST["kart_adi"];
    $kart_numarasi  =   $_POST["kart_numarasi"];
    $kart_ay        =   $_POST["kart_ay"];
    $kart_yil       =   $_POST["kart_yil"];
    $kart_cvv       =   $_POST["kart_cvv"];
    $odemesekli     =   $_POST["odemesekli"];

    if(!$odemesekli==""){
        if($odemesekli=="KrediKarti"){
            if(!$kart_adi=="" && !$kart_numarasi=="" && !$kart_ay=="" && !$kart_yil=="" && !$kart_cvv==""){
                $odemesorgusu = $db->prepare("UPDATE masalar SET 
                masa_detay=:masa_detay,
                kart_adi=:kart_adi,
                kart_numarasi=:kart_numarasi,
                masa_durumu=:masa_durumu WHERE masa_id=:masa_id
                ");
                $guncelle = $odemesorgusu->execute([
                'masa_detay' => $masa_detay,    
                'kart_adi' => $kart_adi,
                'kart_numarasi' => $kart_numarasi,
                'masa_durumu' => "ÖDENDİ",
                'masa_id' => $masa_id
                ]);
                $odemesorgusu2 = $db->prepare("UPDATE siparisler SET 
                siparis_gosterme=:siparis_gosterme WHERE masa_id=:masa_id
                ");
                $guncelle2 = $odemesorgusu2->execute([
                'siparis_gosterme' => "0",
                'masa_id' => $masa_id
                ]);

                if($guncelle){
                    header("Location:../../odemetamamlandi.php?masa_id=$masa_id_encode&odeme=kredikarti");
                }else{
                    header("Location:../../odemetamamlanmadi.php?masa_id=$masa_id_encode");
                }
            }else{
                header("Location:../../odeme.php?masa_id=$masa_id_encode&hata=eksikbilgi");
            }
            
        }else if($odemesekli=="Nakit"){
            $odemesorgusu = $db->prepare("UPDATE masalar SET 
            masa_durumu=:masa_durumu,
            masa_detay=:masa_detay WHERE masa_id=:masa_id
         ");
            $guncelle = $odemesorgusu->execute([
             'masa_durumu' => "NAKİT ÖDENECEK",
             'masa_id' => $masa_id,
             'masa_detay' => $masa_detay 
         ]);
            $odemesorgusu2 = $db->prepare("UPDATE siparisler SET 
            siparis_gosterme=:siparis_gosterme WHERE masa_id=:masa_id
            ");
            $guncelle2 = $odemesorgusu2->execute([
            'siparis_gosterme' => "0",
            'masa_id' => $masa_id
            ]);
         if($guncelle){
            header("Location:../../odemetamamlandi.php?masa_id=$masa_id_encode&odeme=nakit");
         }else{
            header("Location:../../odemetamamlanmadi.php?masa_id=$masa_id_encode");
         }
        }
    }else{
        header("Location:../../odeme.php?masa_id=$masa_id_encode&hata=odemesekli");
    }

    
}

if(isset($_GET["odendi"])){
    $masa_id = $_GET["masa_id"];
    $odemesorgusu = $db->prepare("UPDATE masalar SET 
        masa_durumu=:masa_durumu WHERE masa_id=:masa_id
     ");
     $guncelle = $odemesorgusu->execute([
         'masa_durumu' => "ÖDENDİ",
         'masa_id' => $masa_id
     ]);


     if($guncelle){
        header("Location:../index.php");
     }else{
        header("Location:../index.php");
     }
}

if(isset($_GET["temizle"])){
    $masa_id =  $_GET["masa_id"];
    $odemesorgusu = $db->prepare("UPDATE masalar SET 
        masa_detay=:masa_detay,
        kart_adi=:kart_adi,
        kart_numarasi=:kart_numarasi,
        masa_durumu=:masa_durumu WHERE masa_id=:masa_id
     ");
     $guncelle = $odemesorgusu->execute([
         'masa_detay' => "BOS",   
         'kart_adi' => "BOS",
         'kart_numarasi' => "BOS",
         'masa_durumu' => "BOS",
         'masa_id' => $masa_id
     ]);

     $urunsil = $db->prepare("DELETE FROM siparisler WHERE masa_id=:masa_id");
     $kontrol = $urunsil->execute([
         'masa_id' => $masa_id,
     ]);

     if($guncelle){
        header("Location:../index.php");
     }else{
        header("Location:../index.php");
     }
}

if (isset($_GET['hazirlandi'])) {
    $siparisguncelle = $db->prepare("UPDATE siparisler SET 
        siparis_durumu=:siparis_durumu
         WHERE siparis_id=:siparis_id       
    ");

    $guncelle = $siparisguncelle->execute(array(
        'siparis_durumu' => "HAZIRLANDI",
        'siparis_id' => $_GET['siparis_id']
    ));

    if ($guncelle) {
        header("Location:../mutfak.php");
    }
}

