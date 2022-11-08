<?php
    include "header.php";
    if(isset($_GET["hata"])){?>
            <div id="modal-back">
                <div id="modal-container">
                    <div class="modal-baslik">
                        <h4>Uyarı!</h4><span id="modal-kapat"><i class="fas fa-times"></i></span>
                    </div>
                   <?php if ($_GET['hata'] == 'odemesekli') { ?>
                        <div class="modal-icerik">Lütfen Ödeme Şeklini Seçiniz!</div>
                    <?php } else if($_GET['hata'] == 'eksikbilgi'){?>
                        <div class="modal-icerik">Lütfen Bilgileri Eksiksiz Doldurunuz!</div>
                    <?php } ?> 
                </div>
            </div>
    <?php } 
     $toplam = 0;
     $gelenurunlersorgusu = $db -> prepare("SELECT * FROM masalar INNER JOIN siparisler ON masalar.masa_id=siparisler.masa_id INNER JOIN urunler ON urunler.urun_id = siparisler.urun_id WHERE siparisler.masa_id=$masa_id AND siparisler.siparis_gosterme='1'");
     $gelenurunlersorgusu -> execute();
     $urunlersayisi = $gelenurunlersorgusu->rowCount();
     $gelenurunler = $gelenurunlersorgusu->fetchAll(PDO::FETCH_ASSOC);
     if($urunlersayisi<1){
        $masa_id_encode = base64_encode($masa_id);
        header("Location:index.php?masa_id=$masa_id_encode");
     }else{ ?>
    <div id="ustAciklama">Ödeme Sayfasına Hoş Geldiniz</div>
    <div id="container3">
        <div id="kartodemealani">
            <form action="admin/islemler/islem.php" method="POST">
                        <div class="kartbaslik">Siparişiniz İçin İsteklerinizi Bu Alana Yazabilirsiniz.</div>
                        <textarea name="masa_detay" id="masadetay" placeholder="Lütfen isteklerinizi buraya yazınız."></textarea>
                        <div class="kartbaslik">Lütfen Ödeme Şeklini Seçin</div>
                        <input class="radioinput" type="radio" name="odemesekli" value="Nakit"><span class="radio">Nakit</span>
                        <input class="radioinput" type="radio" name="odemesekli" value="KrediKarti"><span class="radio">Kredi Kartı</span>
                        <p class="text">Eğer nakit ödeme yapacaksanız aşağıdaki bilgileri doldurmayıp sadece <b>"Ödeme İşlemini Tamamla"</b> butonuna tıklayınız.</p>
                        <div class="kartbaslik">Lütfen Bilgilerinizi Doldurunuz</div>
                        <div class="kartodemeinputalani">
                            <input type="text" name="kart_adi" placeholder="Kart Üzerindeki İsminizi Giriniz">
                        </div>
                        <div class="kartodemeinputalani">
                            <input id="kartnumarasi" placeholder="Kart Numaranızı Giriniz" type="text" name="kart_numarasi" maxlength="19"  onkeypress="return isNumberKey(event)">
                        </div>
                        <select class="kartodemeay" name="kart_ay">
                            <option selected>AY</option>
                            <?php for($i=1; $i<=12;$i++){?>
                                <option value='<?php echo $i?>'><?php echo $i?></option>
                            <?php } ?>                                        
                        </select>
                        <select class="kartodemeyil" name="kart_yil">
                            <option selected>YIL</option>
                            <?php for($i=2022; $i<=2030;$i++){?>
                                <option value='<?php echo $i?>'><?php echo $i?></option>
                            <?php } ?>
                        </select>
                        <input class="kartodemecvv" type="text" name="kart_cvv" placeholder="CVV" maxlength="3"  onkeypress="return isNumberKey(event)">
                        <input type="hidden" name="masa_id" value="<?php echo $masa_id ?>">
                        <button type="submit" class="btn" name="odemeisleminitamamla">Ödeme İşlemini Tamamla</button>
            </form>

        </div>
        <div class="hesapAlani">
            <div id="masaid">MASA <?php echo $masa_id ?></div>
            <div id="hesapCercevesi">
                <?php foreach($gelenurunler as $gelenurun){?>
                    <form action="admin/islemler/islem.php" method="POST" class="urunList">
                        <span class="urunAdi"><?php echo $gelenurun["urun_adi"]?></span>
                        <span class="urunPorsiyon"><?php echo $gelenurun["urun_porsiyon"]?></span>
                        <span class="urunFiyati"><?php echo $gelenurun["urun_fiyat"]?> TL</span>
                        <input type="hidden" name="urun_id" value="<?php echo $gelenurun["urun_id"] ?>">
                        <input type="hidden" name="masa_id" value="<?php echo $masa_id ?>">
                        <input type="hidden" name="siparis_id" value="<?php echo $gelenurun["siparis_id"] ?>">
                        <button type="submit" class="hesapbuton" name="odemeurunsil">X</button>
                    </form>
               <?php 
                    $toplam += $gelenurun["urun_fiyat"];
                } ?>
            </div>
            <div id="toplamDetay">
                TOPLAM 
                <span class="toplam"><?php echo $toplam ?></span>
            </div>
        </div>
        <div id="responsive">
                <div id="responsivetoplamDetay">
                    TOPLAM 
                    <span class="responsivetoplam"><?php echo $toplam ?> TL</span>
                </div>
        </div>

    </div>



    <?php include 'footer.php'; }?>

    <script type="text/javascript">
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        var kartnumarasi = document.querySelector("#kartnumarasi");
        kartnumarasi.addEventListener("keydown",function(){
            if(this.value.length==4 || this.value.length==9 || this.value.length==14){
                this.value = this.value + "-";
            }
        });  

         var responsive = document.querySelector("#responsive");
        var hesapalani = document.querySelector(".hesapAlani");

        responsive.addEventListener("click",function(){
            if(hesapalani.classList.contains("hesapAlani")){
                hesapalani.className = "responsivehesapAlani";
            }else{
                hesapalani.className = "hesapAlani";
            }
        });    
        var modalkapat = document.getElementById('modal-kapat');
        var modalcontainer = document.getElementById('modal-container');
        var modalback = document.getElementById('modal-back');


        modalkapat.onclick = function () {
        modalcontainer.style.display = 'none';
        modalback.style.display = 'none';
}   
    </script>
    </body>

    </html>