<?php
if (isset($_SESSION["Yonetici"])) {

  if (isset($_GET["SiparisNo"])) {
     $GelenSiparisNo=guvenlik($_GET["SiparisNo"]);
   }else{
     $GelenSiparisNo="";
   }
   if (isset($_POST["GonderiKodu"])) {
     $GelenGonderiKodu=guvenlik($_POST["GonderiKodu"]);
   }else{
     $GelenGonderiKodu="";
   }
   if(($GelenSiparisNo!="") and ($GelenGonderiKodu!="")){

        $siparis_guncelle=$baglan->prepare("UPDATE siparisler SET   KargoDurumu=?, OnayDurumu =?, KargoGonderiKodu=? WHERE SiparisNumarasi=?");
        $siparis_guncelle->execute([1,1,$GelenGonderiKodu,$GelenSiparisNo]);
        $siparis_kontrol=$siparis_guncelle->rowCount();

        if ($siparis_kontrol>0) {
           header("Location:index.php?SKD=0&SKI=110");
           exit();
        }else{
           header("Location:index.php?SKD=0&SKI=111");//ekle hata
           exit();
        }
        

      }else{
        header("Location:index.php?SKD=0&SKI=111");//ekle hata
         exit();
      }




}else{
  header("Location:index.php?SKD=1");
  exit();
}

?>