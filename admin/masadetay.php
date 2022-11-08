<?php
    include "header.php";
    if(isset($_GET["masa_id"])){
        $masa_id=$_GET["masa_id"];
    }
    $masasorgusu = $db->prepare("SELECT * FROM masalar WHERE masa_id=$masa_id");
    $masasorgusu->execute();
    $masadeger = $masasorgusu->fetch(PDO::FETCH_ASSOC);
?> 

        <div class="btnalani">
            <a href="islemler/islem.php?odendi&masa_id=<?php echo $masa_id?>" class="btn btn-success">ÖDENDİ</a>
            <a href="islemler/islem.php?temizle&masa_id=<?php echo $masa_id?>" class="btn btn-warning">HESABI KAPAT</a>
        </div>
    <div id="container">
        <div id="kartBilgisi">
            <div class="baslik">Kart Bilgisi</div>
            <div class="bilgialani">
                <span class="bilgi">Kart Sahibinin Adı : </span>
                <span><?php echo $masadeger["kart_adi"]?></span>
            </div>
            <div class="bilgialani">
                <span class="bilgi">Kart Numarası : </span>
                <span><?php echo $masadeger["kart_numarasi"]?></span>
            </div>
            <div class="bilgialani">
                <span class="bilgi">Hesap Durumu : </span>
                <span><?php echo $masadeger["masa_durumu"]?></span>
            </div>
        </div> 
        <div id="siparisalani">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Sayı</th>
                        <th scope="col">Ürün Adı</th>
                        <th scope="col">Ürün Porsionu</th>
                        <th scope="col">Ürün Fiyatı</th>
                        <th scope="col">Sipariş Durumu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $gelenurunlersorgusu = $db -> prepare("SELECT * FROM urunler INNER JOIN siparisler ON urunler.urun_id = siparisler.urun_id WHERE siparisler.masa_id=$masa_id AND siparisler.siparis_gosterme = '0'");
                        $gelenurunlersorgusu -> execute();
                        $sayi = 1;
                        $toplam =0;
                        $gelenurunler = $gelenurunlersorgusu->fetchAll(PDO::FETCH_ASSOC);
                        foreach($gelenurunler as $gelenurun){?>
                            <tr>
                                <th scope="row"><?php echo $sayi ?></th>
                                <td><?php echo $gelenurun["urun_adi"] ?></td>
                                <td><?php echo $gelenurun["urun_porsiyon"] ?></td>
                                <td><?php echo $gelenurun["urun_fiyat"] ?> TL</td>
                                <td><?php echo $gelenurun["siparis_durumu"] ?></td>
                            </tr>
                        <?php $sayi++; $toplam += $gelenurun["urun_fiyat"];} ?>
                </tbody>
                <thead>
                    <tr>
                        <th scope="col">TOPLAM</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"><?php echo $toplam; ?> TL</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
            </table>
        </div>  
    </div>   
    <div class="masadetay"> <b>Müşteri Notu: </b> <?php echo $masadeger["masa_detay"]?></div> 

