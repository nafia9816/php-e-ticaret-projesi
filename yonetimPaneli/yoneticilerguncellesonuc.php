<?php
if (isset($_SESSION["Yonetici"])) {
  if (isset($_GET["ID"])) {
     $GelenID=guvenlik($_GET["ID"]);
  }else{
     $GelenID="";
  }
  if (isset($_POST["Sifre"])) {
     $GelenSifre=guvenlik($_POST["Sifre"]);
  }else{
     $GelenSifre="";
  }
  if (isset($_POST["IsimSoyisim"])) {
     $GelenIsimSoyisim=guvenlik($_POST["IsimSoyisim"]);
  }else{
     $GelenIsimSoyisim="";
  }
  if (isset($_POST["EmailAdres"])) {
     $GelenEmailAdres=guvenlik($_POST["EmailAdres"]);
  }else{
     $GelenEmailAdres="";
  }
  if (isset($_POST["TelefonNumarasi"])) {
     $GelenTelefonNumarasi=guvenlik($_POST["TelefonNumarasi"]);
  }else{
     $GelenTelefonNumarasi="";
  }

   if(($GelenID!="") and ($GelenIsimSoyisim!="") and ($GelenEmailAdres!="")and ($GelenTelefonNumarasi!="")){

      $yoneticiMevcutSifre_guncelle=$baglan->prepare("SELECT * FROM yoneticiler WHERE id=? LIMIT 1");
      $yoneticiMevcutSifre_guncelle->execute([$GelenID]);
      $sifre_kontrol=$yoneticiMevcutSifre_guncelle->rowCount();
      $sifre_kayit=$yoneticiMevcutSifre_guncelle->fetch("PDO::FETCH_ASSOC");
      if ($sifre_kontrol>0) {
        $yoneticininMevcutSifresi=$sifre_kayit["Sifre"];
        if ($GelenSifre=="") { //şifre gelmiyorsa yani güncelleme işleminde şifre kısmı boş bırakılıyorsa
           $kaydedilecekSifre=$yoneticininMevcutSifresi;
        }else{
          $kaydedilecekSifre=md5($GelenSifre);
        }

        $yonetici_guncelle=$baglan->prepare("UPDATE yoneticiler SET   IsimSoyisim=?, Sifre=?, TelefonNumarasi =?, EmailAdres=? WHERE id=? LIMIT 1");
        $yonetici_guncelle->execute([$GelenIsimSoyisim, $kaydedilecekSifre,$GelenTelefonNumarasi,$GelenEmailAdres,$GelenID]);
        $yonetici_kontrol=$yonetici_guncelle->rowCount();

        if ($yonetici_kontrol>0) {
           header("Location:index.php?SKD=0&SKI=76");
           exit();
        }else{
           header("Location:index.php?SKD=0&SKI=77");//ekle hata
           exit();
        }
      }else{
        header("Location:index.php?SKD=0&SKI=77");//ekle hata
         exit();
      }

   }else{
         header("Location:index.php?SKD=0&SKI=77");//ekle hata
         exit();
   }

}else{
  header("Location:index.php?SKD=1");
  exit();
}

?>