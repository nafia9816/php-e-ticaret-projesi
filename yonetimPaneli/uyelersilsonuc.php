<?php
if (isset($_SESSION["Yonetici"])) {
  if (isset($_GET["ID"])) {//arama çubuğundan geldiği için get le aldık.
   	 $Gelenid=guvenlik($_GET["ID"]);
   }else{
   	 $Gelenid="";
   }
   
   if($Gelenid!=""){
      $uye_Silme_sorgusu=$baglan->prepare("UPDATE uyeler SET SilinmeDurumu=? WHERE id=? LIMIT 1");
      $uye_Silme_sorgusu->execute([1,$Gelenid]);
      $uyeSil_sayi=$uye_Silme_sorgusu->rowCount();
      if ($uyeSil_sayi>0) { //üyenin sepetini sildik
        $sepetSilme_sorgusu=$baglan->prepare("DELETE FROM sepet WHERE UyeId=?");
        $sepetSilme_sorgusu->execute([$Gelenid]);

        $yorumlar_sorgusu=$baglan->prepare("SELECT * FROM yorumlar WHERE UyeId=?");//üyenin yorumlarını silicez
        $yorumlar_sorgusu->execute([$Gelenid]);
        $yorumlar_sayi=$yorumlar_sorgusu->rowCount();
        $yorumlar_kaydi=$yorumlar_sorgusu->fetchAll(PDO::FETCH_ASSOC);

        if ($yorumlar_sayi>0) {
          foreach ($yorumlar_kaydi as $yorumlar) {
                $yorumId=$yorumlar["id"];
                $guncellenecekUrunIdsi=$yorumlar["UrunId"];//yorumu silinecek urunun idsi
                $guncellenecekUrundenDusecekPuan=$yorumlar["Puan"];

                $urun_guncelleme_sorgusu=$baglan->prepare("UPDATE urunler SET YorumSayisi=YorumSayisi-1, ToplamYorumPuani=ToplamYorumPuani-? WHERE id=? LIMIT 1");//ürünler den de bu kişinin yorumunu çıkarıcaz 
                $urun_guncelleme_sorgusu->execute([$guncellenecekUrundenDusecekPuan,$guncellenecekUrunIdsi]);
                $urunSil_sayi=$urun_guncelleme_sorgusu->rowCount();
                if ($urunSil_sayi<1) {
                   header("Location:index.php?SKD=0&SKI=85");//üye sil hata. ürünüden yorumu silemezse üyeyi de silemezsin
                   exit();
                }
                $yorumSilme_sorgusu=$baglan->prepare("DELETE FROM yorumlar WHERE id=? LIMIT 1");
                $yorumSilme_sorgusu->execute([$yorumId]);
                $yorumSilmeKontrol=$yorumSilme_sorgusu->rowCount();
                if ($yorumSilmeKontrol<1) {
                   header("Location:index.php?SKD=0&SKI=85");//hata
                   exit();
                }

              }
            }
            header("Location:index.php?SKD=0&SKI=84");
            exit();

         }else{
             header("Location:index.php?SKD=0&SKI=85");
              exit();
         }

      }else{
      header("Location:index.php?SKD=0&SKI=85");
      exit();
   }
}else{
   header("Location:index.php?SKD=0&SKI=1");
   exit();
}



?>