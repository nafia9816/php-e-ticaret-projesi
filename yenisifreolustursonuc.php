<?php
  // Email adresi ve aktıvasyon kodunu almın sebebi kim,n şifresini güncelliycem onu bulmak için
   if (isset($_GET["EmailAdres"])) {
       $GelenEmailAdres=guvenlik($_GET["EmailAdres"]);
   }else{
       $GelenEmailAdres="";
   }
   if (isset($_GET["AktivasyonKodu"])) {
       $GelenAktivasyonKodu=guvenlik($_GET["AktivasyonKodu"]);
   }else{
       $GelenAktivasyonKodu="";
   }  
   if (isset($_POST["YeniSifre"])) {
       $GelenSifre=guvenlik($_POST["YeniSifre"]);
   }else{
       $GelenSifre="";
   }
   if (isset($_POST["YeniSifreTekrar"])) { //form daki name ler
       $GelenSifreTekrar=guvenlik($_POST["YeniSifreTekrar"]);
   }else{
       $GelenSifreTekrar="";
   }

   $md5liSifre=md5($GelenSifre); //site haclenirse kimsenin şifresi görünmesin

//mutlaka dol olması gereken yerler
   if (($GelenSifre!="") and ($GelenSifreTekrar!="") and ($GelenEmailAdres!="") and($GelenAktivasyonKodu!="")) {
        if ($GelenSifre!=$GelenSifreTekrar) { //şifreler uyşmuyrsa
            header("Location:index.php?sk=47");//şifreler uyşmuyrsa
            exit(); 
        }else{           
              $UyeGuncellemeSorgusu=$baglan->prepare("UPDATE uyeler SET Sifre= ? WHERE EmailAdres= ? AND AktivasyonKodu=? LIMIT 1");
              $UyeGuncellemeSorgusu->execute([$md5liSifre,$GelenEmailAdres,$GelenAktivasyonKodu]);
              $kontrol=$UyeGuncellemeSorgusu->rowCount();
               if ($kontrol>0) {
                header("Location:index.php?sk=45");//tamma
                exit();
              }else{
                header("Location:index.php?sk=46");//hata
                exit();
              }
          }
    }
    else{ //kullanıcı herhangi bir zorunlu alanı doldurmadıysa eksik biligi sayfasına yönlendirilecek
        header("Location:index.php?sk=48");
        exit();
    }
?>