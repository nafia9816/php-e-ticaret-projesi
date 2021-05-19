<?php
  if (isset($_SESSION["Kullanici"])) {
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
  if (($GelenAdSoyad!="") and ($GelenAdres!="") and ($GelenIlce!="") and ($GelenSehir!="") and ($GelenTelefonNumarasi!="")) { 

        $AdresEklemeSorgusu=$baglan->prepare("INSERT INTO adresler (UyeId,  AdSoyad,  Adres,Ilce,Sehir,TelefonNumarasi) values(?,?,?,?,?,?)");
        $AdresEklemeSorgusu->execute([$KullaniciId,$GelenAdSoyad,$GelenAdres,$GelenIlce,$GelenSehir,$GelenTelefonNumarasi]);
        $eklemeKontrol=$AdresEklemeSorgusu->rowCount();
        if ($eklemeKontrol>0) {
            header("Location:index.php?sk=72");//tamam
            exit(); 
        }else{
              header("Location:index.php?sk=73");//hata
              exit(); 
        }

       
  }
  else{
    header("Location:index.php?sk=74");//eksik alan
    exit(); 
  }
    

}else{ 
  header("Location:index.php");
  exit();
}
 
?>