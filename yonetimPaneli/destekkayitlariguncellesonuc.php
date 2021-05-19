<?php
if (isset($_SESSION["Yonetici"])) {
  if (isset($_GET["ID"])) {
     $GelenID=guvenlik($_GET["ID"]);
  }else{
     $GelenID="";
  }   
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
  if(($GelenID!="") and ($Gelensoru!="") and ($Gelencevap!="")){
      $destek_guncelle=$baglan->prepare("UPDATE sorular SET soru=?, cevap=? WHERE id=? LIMIT 1");
      $destek_guncelle->execute([$Gelensoru,$Gelencevap,$GelenID]);
      $destek_kontrol=$destek_guncelle->rowCount();
      if ($destek_kontrol>0) {
        header("Location:index.php?SKD=0&SKI=52");
        exit();
      }else{
         header("Location:index.php?SKD=0&SKI=53");//ekle hata
         exit();
      }
   }else{
         header("Location:index.php?SKD=0&SKI=53");//ekle hata
         exit();
   }

}else{
  header("Location:index.php?SKD=1");
  exit();
}

?>