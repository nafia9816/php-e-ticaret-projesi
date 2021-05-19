<?php
if (isset($_SESSION["Yonetici"])) {

  if (isset($_GET["SiparisNo"])) {
     $GelenSiparisNo=guvenlik($_GET["SiparisNo"]);
   }else{
     $GelenSiparisNo="";
   }

   if($GelenSiparisNo!=""){
        $siparis_sorgusu=$baglan->prepare("SELECT * FROM siparisler WHERE SiparisNumarasi=?");
        $siparis_sorgusu->execute([$GelenSiparisNo]);
        $siparis_kayitlari=$siparis_sorgusu->fetchAll(PDO::FETCH_ASSOC);
        $kontrol=$siparis_sorgusu->rowCount();
        
        if ($kontrol>0) {
          foreach ($siparis_kayitlari as $siparis) {
            $siparisId=$siparis["id"];
            $siparisteki_urununIdsi=$siparis["UrunId"];
            $siparisteki_urununAdedi=$siparis["UrunAdedi"];
            $siparisteki_urununVaryanti=$siparis["VaryantSecimi"];
 
            $siparis_sil=$baglan->prepare("DELETE FROM siparisler WHERE id=? LIMIT 1");
            $siparis_sil->execute([$siparisId]);
            $sil_kontrol=$siparis_sil->rowCount();

            if ($sil_kontrol>0) {//SİPARİS SİLİNDİ ÜRÜNÜ GUNCELLEYELİM
                $urun_guncelle=$baglan->prepare("UPDATE urunler SET ToplamSatisSayisi=ToplamSatisSayisi + ? WHERE id=? LIMIT 1");
                $urun_guncelle->execute([$siparisteki_urununAdedi,$siparisteki_urununIdsi]);
                $urun_kontrol=$urun_guncelle->rowCount();
                if ($urun_kontrol>0) {//urun guncellendiyse simdi devaryanti guncellicez
                  $varyant_guncelle=$baglan->prepare("UPDATE urunvaryantlari SET StokAdedi=StokAdedi + ? WHERE VaryantAdi=?  AND UrunId=? LIMIT 1");
                  $varyant_guncelle->execute([$siparisteki_urununAdedi, $siparisteki_urununVaryanti,$siparisteki_urununIdsi]);
                  $varyant_kontrol=$varyant_guncelle->rowCount();
                  if ($varyant_kontrol<1) {
                    header("Location:index.php?SKD=0&SKI=114");//
                     exit();
                  }
                }else{
                  header("Location:index.php?SKD=0&SKI=114");//
                  exit();
                }
            }else{
              header("Location:index.php?SKD=0&SKI=114");//ekle hata
              exit();
            }
        }//for kapaması
        header("Location:index.php?SKD=0&SKI=113");//
         exit();
      }else{
        header("Location:index.php?SKD=0&SKI=114");//ekle hata
         exit();
      }

      }else{
        header("Location:index.php?SKD=0&SKI=114");//ekle hata
         exit();
      }

}else{
  header("Location:index.php?SKD=1");
  exit();
}

?>