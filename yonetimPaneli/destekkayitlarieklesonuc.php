<?php
namespace Verot\upload;
if (isset($_SESSION["Yonetici"])) {

   if (isset($_POST["soru"])) {
     $Gelensoru=guvenlik($_POST["soru"]);
   }else{
     $Gelensoru="";
   }  
   if (isset($_POST["cevap"])) {
   	 $Gelencevap=guvenlik($_POST["cevap"]);
   }else{
   	 $Gelencevap="";
   }
   
   if(($Gelensoru!="") and ($Gelencevap!="")){
      
      $destek_ekle=$baglan->prepare("INSERT INTO sorular  (soru,cevap) values(?,?)");
   	  $destek_ekle->execute([$Gelensoru,$Gelencevap]);
      $destek_kontrol=$destek_ekle->rowCount();
      if($destek_kontrol>0){
        header("Location:index.php?SKD=0&SKI=48");//tmm
          exit();//

      }else {
          header("Location:index.php?SKD=0&SKI=49");
          exit();//
      }     
    }else{
         header("Location:index.php?SKD=0&SKI=49");//ekle hata
         exit();
    }

              



}else{
  header("Location:index.php?SKD=1");
  exit();
}

?>