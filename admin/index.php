<?php  include "header.php";?>
<div id="Anasayfa">

    <?php 
        $masasorgusu = $db->prepare("SELECT * FROM masalar");
        $masasorgusu->execute();
        $masalar = $masasorgusu->fetchAll(PDO::FETCH_ASSOC);
        foreach($masalar as $masa){?>
            <a class="masa masa<?php echo $masa["masa_id"] ?>" href="masadetay.php?masa_id=<?php echo $masa["masa_id"] ?>">MASA <?php echo $masa["masa_id"] ?></a>  
            
        <?php
        if($masa["masa_durumu"]=="ÖDENDİ"){?>
            <script>
                var masa = document.querySelector('.masa<?php echo $masa["masa_id"] ?>');
                masa.style.background = "green";
            </script>
    <?php }else if($masa["masa_durumu"]=="NAKİT ÖDENECEK"){?>
            <script>
                var masa = document.querySelector('.masa<?php echo $masa["masa_id"] ?>');
                masa.style.background = "red";
            </script>
    <?php }
     } ?>
     
</div>

<?php include "footer.php"; ?>

