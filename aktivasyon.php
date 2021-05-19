<?php  
   require_once("ayarlar/ayarlar.php");
   require_once("ayarlar/fonksiyonlar.php");   
   if (isset($_GET["AktivasyonKodu"])) {
       $GelenAktivasyonKodu=guvenlik($_GET["AktivasyonKodu"]);
   }else{
       $GelenAktivasyonKodu="";
   }
   if (isset($_GET["Email"])) {
       $GelenEmail=guvenlik($_GET["Email"]);
   }else{
       $GelenEmail="";
   }
//mutlaka dol olması gereken yerler
   if (($GelenAktivasyonKodu!="") and ($GelenEmail!="")) {
      
            $aktiSorgusu=$baglan->prepare("SELECT * FROM uyeler WHERE EmailAdres= ? AND AktivasyonKodu= ? AND Durumu=?"); 
            $aktiSorgusu->execute([$GelenEmail,$GelenAktivasyonKodu,0]);
            $kontrolSayisi=$aktiSorgusu->rowCount();
            if ($kontrolSayisi>0) { 
             	$UyeGuncellemeSorgusu=$baglan->prepare("UPDATE uyeler SET Durumu=1");
             	$UyeGuncellemeSorgusu->execute();
             	$kontrol=$UyeGuncellemeSorgusu->rowCount();
             	if ($kontrol>0) {
             		header("Location:index.php?sk=30");
             		exit();
             	}else{
                header("Location:" .$SiteLinki); //site anasayfaya atar
             		exit();
             	}
              
            }else{
             	header("Location:" .$SiteLinki);
             	exit();
            }
}else{ 
      header("Location:" .$SiteLinki);
      exit();
}

$baglan=null;

?>