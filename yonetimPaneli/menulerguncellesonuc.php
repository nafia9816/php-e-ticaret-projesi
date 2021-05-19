<?php
if (isset($_SESSION["Yonetici"])) {

  if (isset($_GET["ID"])) {
     $GelenID=guvenlik($_GET["ID"]);
  }else{
     $GelenID="";
  }   
  if (isset($_POST["MenuAdi"])) {
     $GelenMenuAdi=guvenlik($_POST["MenuAdi"]);
  }else{
     $GelenMenuAdi="";
  }

   if(($GelenID!="") and ($GelenMenuAdi!="")){
      $menu_guncelle=$baglan->prepare("UPDATE menuler SET MenuAdi=? WHERE id=? LIMIT 1");
      $menu_guncelle->execute([$GelenMenuAdi,$GelenID]);
      $menu_kontrol=$menu_guncelle->rowCount();
      if ($menu_kontrol>0) {
        header("Location:index.php?SKD=0&SKI=64");
        exit();
      }else{
         header("Location:index.php?SKD=0&SKI=65");//ekle hata
         exit();
      }

   }else{
         header("Location:index.php?SKD=0&SKI=65");//ekle hata
         exit();
   }

}else{
  header("Location:index.php?SKD=1");
  exit();
}

?>