<?php
if (isset($_SESSION["Yonetici"])) {
   if (isset($_GET["ID"])) {//arama çubuğundan geldiği için get le aldık.
   	 $Gelenid=guvenlik($_GET["ID"]);
   }else{
   	 $Gelenid="";
   }

   if(($Gelenid!="")){
      //bankayı sildiğimde o bankaya ait havale bildirimi varsa silmesin diye bu kontrol yaparız.
      $havale_bildirim_sorgusu=$baglan->prepare("SELECT * FROM havalebildirimleri WHERE BankaId=?");
      $havale_bildirim_sorgusu->execute([$Gelenid]);
      $havale_sayi=$havale_bildirim_sorgusu->rowCount();
      
      if ($havale_sayi>0) {
         header("Location:index.php?SKD=0&SKI=20");//bankayı sil hata ya gitsin cunku bu banka kaydıyla ilgili havale bildirimi var
         exit();
      }else{
         $hesap_sorgusu=$baglan->prepare("SELECT * FROM bankahesaplari WHERE id=?");
         $hesap_sorgusu->execute([$Gelenid]);
         $hesap_sayi=$hesap_sorgusu->rowCount();
         $hesap_kaydi=$hesap_sorgusu->fetch(PDO::FETCH_ASSOC);

         $silinecek_dosya_yolu="../img/" . $hesap_kaydi["banka_logo"];
      
         $hesap_Silme_sorgusu=$baglan->prepare("DELETE FROM bankahesaplari WHERE id=? LIMIT 1");
         $hesap_Silme_sorgusu->execute([$Gelenid]);
         $hesapSil_sayi=$hesap_Silme_sorgusu->rowCount();
         if ($hesapSil_sayi>0) {//hesap siliniyorsa resmide silinsin
            unlink($silinecek_dosya_yolu);//logoyu da silebilmk için yani silecegim banka hesabının logodunuda silmk içim

            header("Location:index.php?SKD=0&SKI=19");
            exit();//sil tamam
         }else{
             header("Location:index.php?SKD=0&SKI=20");
              exit();//sil hata
         }
      }
   }else{
      header("Location:index.php?SKD=0&SKI=20");
      exit();
   }
}else{
   header("Location:index.php?SKD=0&SKI=1");
   exit();
}

?>