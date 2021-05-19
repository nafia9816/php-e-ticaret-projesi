<?php
  if (isset($_SESSION["Kullanici"])) {
    if (isset($_GET["ID"])){//hangi kaydı güncelleyeceğime dair id alıyorum.
       $GelenId=guvenlik($_GET["ID"]);
    }else{
       $GelenId="";
    }
    if (isset($_POST["AdSoyad"])) {
       $GelenAdSoyad=guvenlik($_POST["AdSoyad"]);
    }else{
       $GelenAdSoyad="";
    }
    if (isset($_POST["Adres"])) {
       $GelenAdres=guvenlik($_POST["Adres"]);
    }else{
       $GelenAdres="";
    }
    if (isset($_POST["Ilce"])) { //form daki name ler
       $GelenIlce=guvenlik($_POST["Ilce"]);
    }else{
       $GelenIlce="";
    }
    if (isset($_POST["Sehir"])) {
   	 $GelenSehir=guvenlik($_POST["Sehir"]);
    }else{
   	 $GelenSehir="";
    }
    if (isset($_POST["TelefonNumarasi"])) {
   	 $GelenTelefonNumarasi=guvenlik($_POST["TelefonNumarasi"]);
    }else{
   	 $GelenTelefonNumarasi="";
    }

//mutlaka dol olması gereken yerler
  if (($GelenId!="") and ($GelenAdSoyad!="") and ($GelenAdres!="") and ($GelenIlce!="") and ($GelenSehir!="") and ($GelenTelefonNumarasi!="")) { 

      $AdresGuncellemeSorgusu=$baglan->prepare("UPDATE adresler SET AdSoyad=?,  Adres=?,Ilce=?,Sehir=?,TelefonNumarasi=? WHERE id=? AND UyeId=? ");
      $AdresGuncellemeSorgusu->execute([$GelenAdSoyad,$GelenAdres,$GelenIlce,$GelenSehir,$GelenTelefonNumarasi,$GelenId,$KullaniciId]);
      $guncellemeKontrol=$AdresGuncellemeSorgusu->rowCount();
      if ($guncellemeKontrol>0) {
         header("Location:index.php?sk=64");//tamam
          exit(); 
      }else{
        header("Location:index.php?sk=65");//hata
        exit(); 
      }

       
  }
  else{
    header("Location:index.php?sk=66");//eksik alan
    exit(); 
  }
    
}
else{ 
  header("Location:index.php");
  exit();
}

?>