<?php
if (isset($_SESSION["Yonetici"])) {
   if (isset($_GET["ID"])) {//arama çubuğundan geldiği için get le aldık.hangi kargo kaydının guncelesine basarsan onun ıd si gelcek
   	 $Gelenid=guvenlik($_GET["ID"]);
   }else{
   	 $Gelenid="";
   }

   if(($Gelenid!="")){
         $kargo_sorgusu=$baglan->prepare("SELECT * FROM kargofirmalari WHERE id=?");
         $kargo_sorgusu->execute([$Gelenid]);
         $kargo_sayi=$kargo_sorgusu->rowCount();
         $kargo_kaydi=$kargo_sorgusu->fetch(PDO::FETCH_ASSOC);

         $silinecek_dosya_yolu="../img/" . $kargo_kaydi["FirmaLogosu"];

         $kargo_Silme_sorgusu=$baglan->prepare("DELETE FROM kargofirmalari WHERE id=? LIMIT 1");
         $kargo_Silme_sorgusu->execute([$Gelenid]);
         $kargoSil_sayi=$kargo_Silme_sorgusu->rowCount();
         if ($kargoSil_sayi>0) {
            unlink($silinecek_dosya_yolu);//logoyu da silebilmk için yani silecegim banka hesabının logodunuda silmk içim
            header("Location:index.php?SKD=0&SKI=31");
            exit();
         }else{
             header("Location:index.php?SKD=0&SKI=32");
              exit();
         }
      }else{
      header("Location:index.php?SKD=0&SKI=32");
      exit();
      }
}else{
   header("Location:index.php?SKD=0&SKI=1");
   exit();
}






?>