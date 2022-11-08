<?php include "header.php"; ?>
    <div id="ustAciklama">Hoş Geldiniz. Aşağıdan Sipariş Verebilirsiniz.</div>
    <div id="container">
        <div id="urunlerAlani">
          <?php foreach($urunler as $urun){?>
                <form class="urunler" action="admin/islemler/islem.php" method="POST">
                    <div class="img"><img src="resimler/<?php echo $urun["urun_img"] ?>" alt=""></div>
                    <div class="urun"><?php echo $urun["urun_adi"]?></div>
                    <div class="urun"><?php echo $urun["urun_porsiyon"]?></div>
                    <div class="urun"><?php echo $urun["urun_fiyat"] ?> <span>TL</span> </div>
                    <input type="hidden" name="urun_id" value="<?php echo $urun["urun_id"]?>">
                    <input type="hidden" name="masa_id" value="<?php echo $masa_id?>">
                    <button type="submit" name="siparisekle" class="btn">SATIN AL</button>
                </form>
            <?php  } ?> 
        </div>
        
        
        <div class="hesapAlani">
                <div id="masaid">MASA <?php echo $masa_id ?></div>
            <div id="hesapCercevesi">
                    <?php 
                    $toplam = 0;
                    $gelenurunlersorgusu = $db -> prepare("SELECT * FROM masalar INNER JOIN siparisler ON masalar.masa_id=siparisler.masa_id INNER JOIN urunler ON urunler.urun_id = siparisler.urun_id WHERE siparisler.masa_id=$masa_id AND siparisler.siparis_gosterme='1'");
                    $gelenurunlersorgusu -> execute();
                    $gelenurunsayisi = $gelenurunlersorgusu->rowCount();
                    $gelenurunler = $gelenurunlersorgusu->fetchAll(PDO::FETCH_ASSOC);
                    foreach($gelenurunler as $gelenurun){?>
                        <form action="admin/islemler/islem.php" method="POST" class="urunList">
                            <span class="urunAdi"><?php echo $gelenurun["urun_adi"]?></span>
                            <span class="urunPorsiyon"><?php echo $gelenurun["urun_porsiyon"]?></span>
                            <span class="urunFiyati"><?php echo $gelenurun["urun_fiyat"]?> TL</span>
                            <input type="hidden" name="urun_id" value="<?php echo $gelenurun["urun_id"] ?>">
                            <input type="hidden" name="masa_id" value="<?php echo $masa_id ?>">
                            <input type="hidden" name="siparis_id" value="<?php echo $gelenurun["siparis_id"] ?>">
                            <button type="submit" class="hesapbuton" name="anasayfaurunsil">X</button>
                        </form>
                        <?php 
                        $toplam += $gelenurun["urun_fiyat"];
                    } ?>
                </div>
                <div id="toplamDetay">
                    TOPLAM 
                    <span class="toplam"><?php echo $toplam ?> TL</span>
                </div>
                <?php if($gelenurunsayisi>0){?>
                <a class="odeme" href="odeme.php?masa_id=<?php echo base64_encode($masa_id)?>">ÖDEME YAP</a>
                <?php } ?>
            </div>
            <div id="responsive">
                <div id="responsivetoplamDetay">
                    TOPLAM 
                    <span class="responsivetoplam"><?php echo $toplam ?> TL</span>
                </div>
            </div>
        </div>
    
    <?php include 'footer.php'; ?>
    </body>

    <script>
        var responsive = document.querySelector("#responsive");
        var hesapalani = document.querySelector(".hesapAlani");

        responsive.addEventListener("click",function(){
            if(hesapalani.classList.contains("hesapAlani")){
                hesapalani.className = "responsivehesapAlani";
            }else{
                hesapalani.className = "hesapAlani";
            }
        });
    </script>

    </html>