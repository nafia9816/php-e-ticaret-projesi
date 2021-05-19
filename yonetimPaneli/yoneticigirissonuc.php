<?php

if (empty($_SESSION["Yonetici"])) {//yonetici giirişi yoksa bu alanı göster
   if (isset($_POST["YKullanici"])) {
       $GelenYKullanici=guvenlik($_POST["YKullanici"]);
   }else{
       $GelenYKullanici="";
   }

   if (isset($_POST["YSifre"])) {
       $GelenYSifre=guvenlik($_POST["YSifre"]);
   }else{
       $GelenYSifre="";
   }
  
  $md5liSifre=md5($GelenYSifre); //site haclenirse kimsenin şifresi görünmesin

//mutlaka dol olması gereken yerler
if (($GelenYSifre!="") and ($GelenYKullanici!="")) {

      $kontrolSorgusu=$baglan->prepare("SELECT * FROM yoneticiler WHERE KullaniciAdi= ? AND  Sifre=?"); 
      $kontrolSorgusu->execute([$GelenYKullanici,$md5liSifre]);
      $kontrollSayisi=$kontrolSorgusu->rowCount();
      $kullaniciKaydi=$kontrolSorgusu->fetch(PDO::FETCH_ASSOC);

      if ($kontrollSayisi>0) {
        $_SESSION["Yonetici"] =$GelenYKullanici; //yönetici giri şyaptığı için sessionu hemen başlatıyoruz.
      
        header("Location:index.php?SKD=0&SKI=0");//anasayfaya gidecek
        exit();
      }
      else{
        header("Location:index.php?SKD=3");//hata 
        exit(); 
      }


}else{ 
    header("Location:index.php?SKD=1"); //giriş ekranına geri dönsün
    exit();
}

    
}else{ 
  header("Location:index.php?SKD=0");
  exit();
}


   
   
   
   



?>