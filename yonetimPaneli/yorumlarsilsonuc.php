<?php
if (isset($_SESSION["Yonetici"])) {
  
  if (isset($_GET["ID"])) {//arama çubuğundan geldiği için get le aldık.
   	 $Gelenid=guvenlik($_GET["ID"]);
   }else{
   	 $Gelenid="";
   }
   
  if($Gelenid!=""){

    $yorumlar_sorgusu=$baglan->prepare("SELECT * FROM yorumlar WHERE id=? LIMIT 1");
    $yorumlar_sorgusu->execute([$Gelenid]);
    $yorumlar_sayi=$yorumlar_sorgusu->rowCount();
    $yorumlar_kaydi=$yorumlar_sorgusu->fetch(PDO::FETCH_ASSOC);
    
    if ($yorumlar_sayi>0) {
      $guncellenecekUrunIdsi=$yorumlar_kaydi["UrunId"];//yorumu silinecek urunun idsi
      $guncellenecekUrundenDusecekPuan=$yorumlar_kaydi["Puan"];

      $yorumSilme_sorgusu=$baglan->prepare("DELETE FROM yorumlar WHERE id=? LIMIT 1");
      $yorumSilme_sorgusu->execute([$Gelenid]);
      $yorumSilmeKontrol=$yorumSilme_sorgusu->rowCount();
      if ($yorumSilmeKontrol>0) {
                  
        $urun_guncelleme_sorgusu=$baglan->prepare("UPDATE urunler SET YorumSayisi=YorumSayisi-1, ToplamYorumPuani=ToplamYorumPuani-? WHERE id=? LIMIT 1");
        $urun_guncelleme_sorgusu->execute([$guncellenecekUrundenDusecekPuan,$guncellenecekUrunIdsi]);
        $urunSil_sayi=$urun_guncelleme_sorgusu->rowCount();
        if ($urunSil_sayi>0) {
                      header("Location:index.php?SKD=0&SKI=91");
                      exit();
        }else{
                      header("Location:index.php?SKD=0&SKI=92");
                      exit();
        }
      }else{
                  header("Location:index.php?SKD=0&SKI=92");
                  exit();
      }
    }else{
             header("Location:index.php?SKD=0&SKI=92");
              exit();
    }

  }else{
      header("Location:index.php?SKD=0&SKI=92");
      exit();
  }
}else{
   header("Location:index.php?SKD=0&SKI=1");
   exit();
}






?>