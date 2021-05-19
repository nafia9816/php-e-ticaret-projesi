<?php
 if (isset($_SESSION["Yonetici"])) {
   if (isset($_GET["ID"])) {//arama çubuğundan geldiği için get le aldık.urunun id si
   	 $Gelenid=guvenlik($_GET["ID"]);
   }else{
   	 $Gelenid="";
   }
   
   if($Gelenid!=""){

      $urunler_sorgusu=$baglan->prepare("SELECT * FROM urunler WHERE id=?");
      $urunler_sorgusu->execute([$Gelenid]);
      $urun_sayi=$urunler_sorgusu->rowCount();
      $urunler_kaydi=$urunler_sorgusu->fetch(PDO::FETCH_ASSOC);

      if ($urun_sayi>0) {
        $silinecekUrununMenuIdsi=$urunler_kaydi["MenuId"];
        //ürünü sildik
        $urun_Silme_sorgusu=$baglan->prepare("UPDATE urunler SET Durumu=? WHERE id=? LIMIT 1");
        $urun_Silme_sorgusu->execute([0,$Gelenid]);
        $urunSil_sayi=$urun_Silme_sorgusu->rowCount();

        if ($urunSil_sayi>0) { //ürün silindiyse
            //1  üyeye aitsepet silinecek
            $sepetSilme_sorgusu=$baglan->prepare("DELETE FROM sepet WHERE UrunId=?");
            $sepetSilme_sorgusu->execute([$Gelenid]);

            //2 bu ürün favorilere ekliyse silinecek
            $favoriSilme_sorgusu=$baglan->prepare("DELETE FROM favoriler WHERE UrunId=?");
            $favoriSilme_sorgusu->execute([$Gelenid]);
            //ürünü geri açarız diye ürüne ait yorumları silmiyoruz

            //3 menu yu gunceliyoruz. ürürnü 1 eksilticez menüden
            $menuGuncelle_sorgusu=$baglan->prepare("UPDATE menuler SET UrunSayisi=UrunSayisi-1 WHERE id=?");
            $menuGuncelle_sorgusu->execute([$silinecekUrununMenuIdsi]);
            
//ürünle alakalı yorumları silmiyoruz hem kanuni durum olur diye hemde ürünü geri açarsak
            header("Location:index.php?SKD=0&SKI=103");//tamam
            exit();
          }
         else{
             header("Location:index.php?SKD=0&SKI=104");//hata
              exit();
         }
       }else{
             header("Location:index.php?SKD=0&SKI=105");
              exit();
         }


      }else{
      header("Location:index.php?SKD=0&SKI=104");
      exit();
   }
}else{
   header("Location:index.php?SKD=0&SKI=1");
   exit();
}






?>