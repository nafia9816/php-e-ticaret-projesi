<?php
  if (isset($_SESSION["Kullanici"])) {
   if (isset($_POST["MailAdresi"])) {
       $GelenMailAdresi=guvenlik($_POST["MailAdresi"]);
   }else{
       $GelenMailAdresi="";
   }
   if (isset($_POST["Sifre"])) {
       $GelenSifre=guvenlik($_POST["Sifre"]);
   }else{
       $GelenSifre="";
   }
   if (isset($_POST["SifreTekrar"])) { //form daki name ler
       $GelenSifreTekrar=guvenlik($_POST["SifreTekrar"]);
   }else{
       $GelenSifreTekrar="";
   }
   if (isset($_POST["IsimSoyisim"])) {
   	 $GelenIsimSoyisim=guvenlik($_POST["IsimSoyisim"]);
   }else{
   	 $GelenIsimSoyisim="";
   }
   if (isset($_POST["telefonNum"])) {
   	 $GelenTelefonNum=guvenlik($_POST["telefonNum"]);
   }else{
   	 $GelenTelefonNum="";
   }
   if (isset($_POST["Cinsiyet"])) {
   	 $GelenCinsiyet=guvenlik($_POST["Cinsiyet"]);
   }else{
   	 $GelenCinsiyet="";
   }
   $md5liSifre=md5($GelenSifre); //site haclenirse kimsenin şifresi görünmesin

//mutlaka dol olması gereken yerler
   if (($GelenIsimSoyisim!="") and ($GelenSifre!="") and ($GelenSifreTekrar!="") and ($GelenMailAdresi!="") and ($GelenTelefonNum!="") and ($GelenCinsiyet!="")) {
     
      if ($GelenSifre!=$GelenSifreTekrar) { //şifreler uyşmuyrsa
            header("Location:index.php?sk=57");//eşleşmeyen şifre
            exit(); 
      }else{
          if ($GelenSifre=="EskiSifre") {
              $sifreDegistirmeDurumu=0;
          }else{
                $sifreDegistirmeDurumu=1;
          }
          if ($KullaniciEmail!=$GelenMailAdresi) {
            $kontrolSorgusu=$baglan->prepare("SELECT * FROM uyeler WHERE EmailAdres= ?"); //kullanıcının yazdığı email adresi başka bir kullanıcıya aitmi onu kontrol ederiz
            $kontrolSorgusu->execute([$GelenMailAdresi]);
            $kontrolSayisi=$kontrolSorgusu->rowCount();
            if ($kontrolSayisi>0) { //bu maili kullanan başka biri var tekrarlana alan sayfasına yönlendirdik
                 header("Location:index.php?sk=55");//tekrarlana bilgi
                 exit(); 
            }
          }
          if ($sifreDegistirmeDurumu==1) {
              $UyeGuncellemeSorgusu=$baglan->prepare("UPDATE uyeler SET EmailAdres=?,Sifre=?,IsimSoyisim=?,TelefonNumara=?,Cinsiyet=? WHERE id=? LIMIT 1");//whereden sonrasını ekledım çunku şuand giren kullnıcını guncellemeseni ypsun dıye
              $UyeGuncellemeSorgusu->execute([$GelenMailAdresi,$md5liSifre,$GelenIsimSoyisim,$GelenTelefonNum,$GelenCinsiyet,$KullaniciId]);
              /*unset($_SESSION['Kullanici']);//kullanıcıyı dışarı atması için.maili şifreyi vb. yi güncellersek diye
                session_destroy(); ya bu alanı yaparuz ya da;
                  $_SESSION["Kullanici"]=$GelenMailAdresi;yaparız altta 
              */
          }else{
              $UyeGuncellemeSorgusu=$baglan->prepare("UPDATE uyeler SET EmailAdres=?,IsimSoyisim=?,TelefonNumara=?,Cinsiyet=? WHERE id=? LIMIT 1");
              $UyeGuncellemeSorgusu->execute([$GelenMailAdresi,$GelenIsimSoyisim,$GelenTelefonNum,$GelenCinsiyet,$KullaniciId]);
          }
          $UyeGuncellemeSorgusukontrol=$UyeGuncellemeSorgusu->rowCount();
          if ($UyeGuncellemeSorgusukontrol>0) {
            $_SESSION["Kullanici"]=$GelenMailAdresi;//kullanıcıyı dışarı atması için.maili şifreyi vb. yi güncellersek diye
            header("Location:index.php?sk=53");//tamam
            exit();
          }else{
            header("Location:index.php?sk=54");//hata
            exit(); 
          }

      }
    }else{ /* doluluk kontrolu eden if in kapaması*/
        header("Location:index.php?sk=56");//eksik alan
        exit(); 
    }

}else{ 
    header("Location:index.php");
    exit();
}
?>