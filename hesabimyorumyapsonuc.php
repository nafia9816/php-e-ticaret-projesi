<?php
  if (isset($_SESSION["Kullanici"])) {
    if (isset($_GET["UrunID"])){//hangi kaydı güncelleyeceğime dair id alıyorum.
       $GelenUrunId=guvenlik($_GET["UrunID"]);
    }else{
       $GelenUrunId="";
    }
    if (isset($_POST["Puan"])) {
       $GelenPuan=guvenlik($_POST["Puan"]);
    }else{
       $GelenPuan="";
    }
    if (isset($_POST["Yorum"])) {
       $GelenYorum=guvenlik($_POST["Yorum"]);
    }else{
       $GelenYorum="";
    }

//mutlaka dol olması gereken yerler
  if (($GelenUrunId!="") and ($GelenPuan!="") and ($GelenYorum!="")) { 

        $YorumKayitSorgusu=$baglan->prepare("INSERT INTO yorumlar (UrunId,UyeId,Puan,YorumMetni,YorumTarihi,  YorumIpAdresi) values (?,?,?,?,?,?)");
        $YorumKayitSorgusu->execute([$GelenUrunId,$KullaniciId,$GelenPuan,$GelenYorum,$zaman_damgasi,$ipAdresi]);   
        $yorumKayitKontrol=$YorumKayitSorgusu->rowCount();

        if ($yorumKayitKontrol>0) {
            $UrunGuncellemeSorgusu=$baglan->prepare("UPDATE urunler SET YorumSayisi=YorumSayisi+1, ToplamYorumPuani=ToplamYorumPuani+ ? WHERE id=? LIMIT 1");
            $UrunGuncellemeSorgusu->execute([$GelenPuan,$GelenUrunId]);
            $urunGuncelleKontrol=$UrunGuncellemeSorgusu->rowCount();
           if ($urunGuncelleKontrol>0) {
             header("Location:index.php?sk=77");//tamam
             exit(); 
           }else{
             header("Location:index.php?sk=78");//hata
              exit();
           }
        }else{
              header("Location:index.php?sk=78");//hata
              exit(); 
        }
  
  }else{//eksik bilgi girildiyse
    header("Location:index.php?sk=79");//eksik alan
    exit(); 
  }


}else{ //KULLANICI YOKSA NASAYFA YAGİTSİN 
  header("Location:index.php");
  exit();
}
 


   
   
   
   



?>