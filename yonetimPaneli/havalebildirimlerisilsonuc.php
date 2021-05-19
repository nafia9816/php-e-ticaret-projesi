<?php
 if (isset($_SESSION["Yonetici"])) {
   if (isset($_GET["ID"])) {//arama çubuğundan geldiği için get le aldık.
   	 $Gelenid=guvenlik($_GET["ID"]);
   }else{
   	 $Gelenid="";
   }

   if(($Gelenid!="")){
      
      $bildirim_Silme_sorgusu=$baglan->prepare("DELETE FROM havalebildirimleri WHERE id=? LIMIT 1");
      $bildirim_Silme_sorgusu->execute([$Gelenid]);
      $bildirimSil_sayi=$bildirim_Silme_sorgusu->rowCount();
      if ($bildirimSil_sayi>0) {
         unlink($silinecek_dosya_yolu);//logoyu da silebilmk için yani silecegim banka hesabının logodunuda silmk içim
         header("Location:index.php?SKD=0&SKI=117");
         exit();
      }else{
         header("Location:index.php?SKD=0&SKI=118");
         exit();
      }
      }else{
      header("Location:index.php?SKD=0&SKI=118");
      exit();
      }
}else{
   header("Location:index.php?SKD=0&SKI=1");
   exit();
}






?>