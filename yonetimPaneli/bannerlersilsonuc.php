<?php
if (isset($_SESSION["Yonetici"])) {

   if (isset($_GET["ID"])) {//arama çubuğundan geldiği için get le aldık.
   	 $Gelenid=guvenlik($_GET["ID"]);
   }else{
   	 $Gelenid="";
   }
   
   if(($Gelenid!="")){
         $banner_sorgusu=$baglan->prepare("SELECT * FROM bannerler WHERE id=?");
         $banner_sorgusu->execute([$Gelenid]);
         $banner_sayi=$banner_sorgusu->rowCount();
         $banner_kaydi=$banner_sorgusu->fetch(PDO::FETCH_ASSOC);

         $silinecek_dosya_yolu="../img/" . $banner_kaydi["BannerResmi"];
      
         $banner_Silme_sorgusu=$baglan->prepare("DELETE FROM bannerler WHERE id=? LIMIT 1");
         $banner_Silme_sorgusu->execute([$Gelenid]);
         $bannerSil_sayi=$banner_Silme_sorgusu->rowCount();
         if ($bannerSil_sayi>0) {
            unlink($silinecek_dosya_yolu);//logoyu da silebilmk için yani silecegim banka hesabının logodunuda silmk içim
            header("Location:index.php?SKD=0&SKI=43");
            exit();
         }else{
             header("Location:index.php?SKD=0&SKI=44");
              exit();
         }
      }else{
         header("Location:index.php?SKD=0&SKI=44");
          exit();
      }
}else{
   header("Location:index.php?SKD=0&SKI=1");
   exit();
}






?>