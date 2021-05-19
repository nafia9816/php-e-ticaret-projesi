<?php
if (isset($_SESSION["Yonetici"])) {
  if (isset($_GET["ID"])) {//arama çubuğundan geldiği için get le aldık.
   	 $Gelenid=guvenlik($_GET["ID"]);
   }else{
   	 $Gelenid="";
   }
   
   if($Gelenid!=""){
      
      $menu_Silme_sorgusu=$baglan->prepare("DELETE FROM menuler WHERE id=? LIMIT 1");
      $menu_Silme_sorgusu->execute([$Gelenid]);
      $menuSil_sayi=$menu_Silme_sorgusu->rowCount();
      if ($menuSil_sayi>0) {

            $urunler_sorgusu=$baglan->prepare("SELECT * FROM urunler WHERE MenuId=? LIMIT 1");
            $urunler_sorgusu->execute([$Gelenid]);
            $urun_sayi=$urunler_sorgusu->rowCount();
            $urun_kayit=$urunler_sorgusu->fetchAll(PDO::FETCH_ASSOC);

            if ($urun_sayi>0) { //bu menuye bağlı urun varsa burasu çalışır. 
                foreach ($urun_kayit as $urun) {
                  $silinecek_urununIdsi=$urun["id"];
                  
                  $urunlerGuncelleme_sorgusu=$baglan->prepare("UPDATE urunler SET Durumu=? WHERE id=? AND MenuId=?");
                  $urunlerGuncelleme_sorgusu->execute([0,$silinecek_urununIdsi,$Gelenid]);

                  $sepetSilme_sorgusu=$baglan->prepare("DELETE FROM sepet WHERE UrunId=?");
                  $sepetSilme_sorgusu->execute([$silinecek_urununIdsi]);
                        
                  $favoriSilme_sorgusu=$baglan->prepare("DELETE FROM favoriler WHERE UrunId=?");
                  $favoriSilme_sorgusu->execute([$silinecek_urununIdsi]);
                }
          }         
          header("Location:index.php?SKD=0&SKI=67");//tmm
          exit();
          }else{
             header("Location:index.php?SKD=0&SKI=68");//hata
              exit();
          }
      }else{
      header("Location:index.php?SKD=0&SKI=68");
      exit();
   }
}else{
   header("Location:index.php?SKD=0&SKI=1");
   exit();
}






?>