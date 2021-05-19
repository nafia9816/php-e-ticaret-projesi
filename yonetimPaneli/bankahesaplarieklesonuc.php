<?php
namespace Verot\upload;
if (isset($_SESSION["Yonetici"])) {

   $gelenbankaLogo=$_FILES["banka_logo"];   
   if (isset($_POST["bankaAdi"])) {
   	 $GelenbankaAdi=guvenlik($_POST["bankaAdi"]);
   }else{
   	 $GelenbankaAdi="";
   }
   if (isset($_POST["subeAdi"])) {
       $GelensubeAdi=guvenlik($_POST["subeAdi"]);
   }else{
       $GelensubeAdi="";
   }
   if (isset($_POST["subeKodu"])) {
       $GelensubeKodu=guvenlik($_POST["subeKodu"]);
   }else{
       $GelensubeKodu="";
   }
   if (isset($_POST["konumSehir"])) {
       $GelenkonumSehir=guvenlik($_POST["konumSehir"]);
   }else{
       $GelenkonumSehir="";
   }
   if (isset($_POST["konumUlke"])) {
       $GelenkonumUlke=guvenlik($_POST["konumUlke"]);
   }else{
       $GelenkonumUlke="";
   }
   if (isset($_POST["paraBirimi"])) {
       $GelenparaBirimi=guvenlik($_POST["paraBirimi"]);
   }else{
       $GelenparaBirimi="";
   }
   if (isset($_POST["hesapSahibi"])) {
       $GelenhesapSahibi=guvenlik($_POST["hesapSahibi"]);
   }else{
       $GelenhesapSahibi="";
   }
   if (isset($_POST["hesapNum"])) {
       $GelenhesapNum=guvenlik($_POST["hesapNum"]);
   }else{
       $GelenhesapNum="";
   }
   if (isset($_POST["ibanNum"])) {
       $GelenibanNum=guvenlik($_POST["ibanNum"]);
   }else{
       $GelenibanNum="";
   }


   if(($gelenbankaLogo["name"]!="") and ($gelenbankaLogo["type"]!="") and ($gelenbankaLogo["tmp_name"]!="")  and ($gelenbankaLogo["error"]==0) and ($gelenbankaLogo["size"]>0) and ($GelenbankaAdi!="") and ($GelensubeAdi!="") and ($GelensubeKodu!="") and ($GelenkonumSehir!="") and ($GelenkonumUlke!="") and ($GelenparaBirimi!="") and ($GelenhesapSahibi!="") and ($GelenhesapNum!="") and ($GelenibanNum!="")){

      $resimIcinDosyaAdi=resimAdiOlustur();//fonksiyonlar.php de bu fonk u oluşturdum.
      $gelenResminUzantisi=substr($gelenbankaLogo["name"],-4);//.uzantıyı veriyo mesela .png
      if (($gelenResminUzantisi=="jpeg") or ($gelenResminUzantisi=="jfif")) {
        $gelenResminUzantisi="." . $gelenResminUzantisi;
      }
      $resimIcinyeniDosyaAdi=$resimIcinDosyaAdi.$gelenResminUzantisi;
     
      $hesap_ekle=$baglan->prepare("INSERT INTO bankahesaplari  (banka_logo,bankaAdi,konumSehir,konumUlke,subeAdi,subeKodu,paraBirimi,hesapSahibi,hesapNum,ibanNum) values(?,?,?,?,?,?,?,?,?,?)");
   	  $hesap_ekle->execute([$resimIcinyeniDosyaAdi,$GelenbankaAdi,$GelenkonumSehir,$GelenkonumUlke,$GelensubeAdi,$GelensubeKodu,$GelenparaBirimi,$GelenhesapSahibi,$GelenhesapNum,$GelenibanNum]);
      $hesap_kontrol=$hesap_ekle->rowCount();
      if($hesap_kontrol>0){
           //verot sınıfını kullnıyoruz. https://www.verot.net/php_class_upload.htm den aldım aşağıdaki kodu
         $bankaLogosuYukle=new upload($gelenbankaLogo,"tr-TR");
        if ($bankaLogosuYukle->uploaded) {
                  $bankaLogosuYukle->mime_magic_check =true;//geeln resmin mime turunu aşagıda belirrtiğim ture check ediyo. ben image turunde dedim pdf gelirse hata verir
                  $bankaLogosuYukle->allowed = array("image/*");//butun resim uzantılarını kaubl eder
                  $bankaLogosuYukle->file_new_name_body = $resimIcinDosyaAdi;
                  $bankaLogosuYukle->file_overwrite= true;//dosya varsa ustune yaz
                  //$bankaLogosuYukle->image_convert= "png";//dosya her halikarda png olsun
                  $bankaLogosuYukle->image_quality= 100;//kalitesi yuzde 100 oslun
                  $bankaLogosuYukle->image_background_color= "#FFFFFF";
                  $bankaLogosuYukle->image_ratio = true;//belirttiğim boyuttan buyuk resim gelirse kırp
                  $bankaLogosuYukle->image_y= 30;
                                  
                  $bankaLogosuYukle->process($verot_icin_klasorYolu);
                  if ($bankaLogosuYukle->processed) {//resim yukleme olduysa
                     $bankaLogosuYukle->clean();
                     header("Location:index.php?SKD=0&SKI=12");
                     exit();
                  } else {
                   header("Location:index.php?SKD=0&SKI=13");
                   exit();//resim yujleme basarusız hata sayfasına gider
                  }   
             } 
      }else{//banka hesabı elnemediyse
         header("Location:index.php?SKD=0&SKI=13");//ekle hata
         exit();
      }

  }else{//formdan gelen verilerin boşluk doluluk kontrol
   	 header("Location:index.php?SKD=0&SKI=13");//ekle hata
     exit();
  }

}else{
  header("Location:index.php?SKD=1");
  exit();
}

?>