<?php include "header.php";?>
    <?php 
        if(isset($_GET["odeme"])){
            if($_GET["odeme"]=="nakit"){?>
                
                <div class="basarili">
                    <div class="resimalani">
                        <img src="resimler/ok1.png" alt="">
                    </div>
                    
                    <div class="basarilitext">Siparişiniz arkadaşlarımıza iletildi. Nakit ödeme işlemini siparişinizi getiren personele yapabilirsiniz. Afiyet olsun. </div>

                </div>

            <?php } else if($_GET["odeme"]=="kredikarti"){?>
                <div class="basarili">
                    <div class="resimalani">
                        <img src="resimler/ok1.png" alt="">
                    </div>
                    
                    <div class="basarilitext">Ödeme işlemi başarı ile gerçekleştirildi.Siparişiniz arkadaşlarımıza iletildi. Afiyet olsun. </div>

                </div>
            <?php }
        }
    ?>
        
    
    
    
    
    
    <?php include 'footer.php'; ?>
	
</body>

</html>