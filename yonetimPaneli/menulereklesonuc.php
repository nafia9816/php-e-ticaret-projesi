<?php
namespace Verot\upload;
if (isset($_SESSION["Yonetici"])) {

   if (isset($_POST["MenuAdi"])) {
     $GelenMenuAdi=guvenlik($_POST["MenuAdi"]);
   }else{
     $GelenMenuAdi="";
   }  
   if (isset($_POST["UrunTuru"])) {
   	 $GelenUrunTuru=guvenlik($_POST["UrunTuru"]);
   }else{
   	 $GelenUrunTuru="";
   }
   
   if(($GelenMenuAdi!="") and ($GelenUrunTuru!="")){
      
      $menu_ekle=$baglan->prepare("INSERT INTO menuler  (MenuAdi,UrunTuru) values(?,?)");
   	  $menu_ekle->execute([$GelenMenuAdi,$GelenUrunTuru]);
      $menu_kontrol=$menu_ekle->rowCount();
      if($menu_kontrol>0){
        header("Location:index.php?SKD=0&SKI=60");
          exit();//tmmm
      }else {
          header("Location:index.php?SKD=0&SKI=61");
          exit();//hata
      }
     
    }else{
         header("Location:index.php?SKD=0&SKI=61");//ekle hata
         exit();
    }

}else{
  header("Location:index.php?SKD=1");
  exit();
}

?>