<?php
namespace Verot\upload;
if (isset($_SESSION["Yonetici"])) {

   if (isset($_POST["KullaniciAdi"])) {
     $GelenKullaniciAdi=guvenlik($_POST["KullaniciAdi"]);
   }else{
     $GelenKullaniciAdi="";
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

   if(($GelenKullaniciAdi!="") and ($GelenSifre!="")and ($GelenIsimSoyisim!="")and ($GelenEmailAdres!="")and ($GelenTelefonNumarasi!="")){

      $yonetici_kontrol=$baglan->prepare("SELECT * FROM yoneticiler WHERE KullaniciAdi=? OR EmailAdres=?");//AYNI KULLANICI ADI VE MAİLE SAHİP kimse olmasın
      $yonetici_kontrol->execute([$GelenKullaniciAdi,$GelenEmailAdres]);
      $kontrol=$yonetici_kontrol->rowCount();

      if ($kontrol<1) {//hic kayıt yoksa
         $yonetici_ekle=$baglan->prepare("INSERT INTO yoneticiler  (KullaniciAdi,Sifre,IsimSoyisim,EmailAdres,TelefonNumarasi) values(?,?,?,?,?)");
         $yonetici_ekle->execute([$GelenKullaniciAdi,$GelenSifre,$GelenIsimSoyisim,$GelenEmailAdres,$GelenTelefonNumarasi]);
         $yonetici_kontrol=$yonetici_ekle->rowCount();
         if($yonetici_kontrol>0){
            header("Location:index.php?SKD=0&SKI=72");//tmm
             exit();//

          }else {
              header("Location:index.php?SKD=0&SKI=73");//hata
              exit();//
          }
      }else{
         header("Location:index.php?SKD=0&SKI=73");//kullanıcı var o adda
         exit();
      } 
    }else{
         header("Location:index.php?SKD=0&SKI=49");//ekle hata
         exit();
    }

}else{
  header("Location:index.php?SKD=1");
  exit();
}

?>