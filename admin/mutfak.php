<?php
    include "header.php";
?> 

    <div id="container">
            <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Masa Numarası</th>
                            <th scope="col">Ürün Adı</th>
                            <th scope="col">Ürün Porsionu</th>
                            <th scope="col">Sipariş Durumu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $gelenurunlersorgusu = $db -> prepare("SELECT * FROM urunler INNER JOIN siparisler ON urunler.urun_id = siparisler.urun_id WHERE siparis_durumu=:siparis_durumu");
                        $gelenurunlersorgusu -> execute([
                            'siparis_durumu' => 'HAZIRLANIYOR'
                        ]);
                        $gelenurunler = $gelenurunlersorgusu->fetchAll(PDO::FETCH_ASSOC);
                        foreach($gelenurunler as $gelenurun){ ?>
                                <tr>
                                    <td><?php echo $gelenurun["masa_id"]; ?></td>
                                    <td><?php echo $gelenurun["urun_adi"]; ?></td>
                                    <td><?php echo $gelenurun["urun_porsiyon"]; ?></td>
                                    <td><a href="islemler/islem.php?hazirlandi&siparis_id=<?php echo $gelenurun["siparis_id"]?>" class="btn btn-success">Sipariş Hazır</a></td>
                                </tr>
                        <?php } ?> 
                </tbody>
            </table>
    </div>   
