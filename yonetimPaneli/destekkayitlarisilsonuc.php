<?php
if (isset($_SESSION["Yonetici"])) {
   if (isset($_GET["ID"])) {//arama çubuğundan geldiği için get le aldık.
   	 $Gelenid=guvenlik($_GET["ID"]);
   }else{
   	 $Gelenid="";
   }
   
   if(($Gelenid!="")){      
         $destek_Silme_sorgusu=$baglan->prepare("DELETE FROM sorular WHERE id=? LIMIT 1");
         $destek_Silme_sorgusu->execute([$Gelenid]);
         $destekSil_sayi=$destek_Silme_sorgusu->rowCount();
         if ($destekSil_sayi>0) {
         
            header("Location:index.php?SKD=0&SKI=55");
            exit();
         }else{
             header("Location:index.php?SKD=0&SKI=56");
              exit();
         }
   }else{
      header("Location:index.php?SKD=0&SKI=56");
      exit();
   }
}else{
   header("Location:index.php?SKD=0&SKI=1");
   exit();
}






?>