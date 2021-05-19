<?php
namespace Verot\upload;
if (isset($_SESSION["Yonetici"])) {
   
   $gelenFirmaLogosu=$_FILES["FirmaLogosu"];
   if (isset($_POST["FirmaAdi"])) {
   	 $GelenFirmaAdi=guvenlik($_POST["FirmaAdi"]);
   }else{
   	 $GelenFirmaAdi="";
   }
   
   if(($gelenFirmaLogosu["name"]!="") and ($gelenFirmaLogosu["type"]!="") and ($gelenFirmaLogosu["tmp_name"]!="")  and ($gelenFirmaLogosu["error"]==0) and ($gelenFirmaLogosu["size"]>0) and ($GelenFirmaAdi!="")){

      $resimIcinDosyaAdi=resimAdiOlustur();
      $gelenResminUzantisi=substr($gelenFirmaLogosu["name"],-4);//.uzantıyı veriyo mesela .png
      if (($gelenResminUzantisi=="jpeg") and ($gelenResminUzantisi=="jfif")) {
        $gelenResminUzantisi= "." . $gelenResminUzantisi;//. jfif yazmıyo o yuzden resim jfif olunca görünmüyor ekranda

      }
      $resimIcinyeniDosyaAdi=$resimIcinDosyaAdi.$gelenResminUzantisi;
     
      $kargo_ekle=$baglan->prepare("INSERT INTO kargofirmalari  (FirmaLogosu,FirmaAdi) values(?,?)");
   	  $kargo_ekle->execute([$resimIcinyeniDosyaAdi,$GelenFirmaAdi]);
      $kargo_kontrol=$kargo_ekle->rowCount();
      if($kargo_kontrol>0){
           //verot sınıfını kullnıyoruz. https://www.verot.net/php_class_upload.htm den aldım aşağıdaki kodu
        $kargoLogosuYukle=new upload($gelenFirmaLogosu,"tr-TR");
        if ($kargoLogosuYukle->uploaded) {
                  $kargoLogosuYukle->mime_magic_check =true;//geeln resmin mime turunu aşagıda belirrtiğim ture check ediyo. ben image turunde dedim pdf gelirse hata verir
                  $kargoLogosuYukle->allowed = array("image/*");//butun resim uzantılarını kaubl eder
                  $kargoLogosuYukle->file_new_name_body = $resimIcinDosyaAdi;
                  $kargoLogosuYukle->file_overwrite= true;//dosya varsa ustune yaz
                  //$kargoLogosuYukle->image_convert= "png";//dosya her halikarda png olsun
                  $kargoLogosuYukle->image_quality= 100;//kalitesi yuzde 100 oslun
                  $kargoLogosuYukle->image_background_color= "#FFFFFF";
                  $kargoLogosuYukle->image_x= 144;
                  $kargoLogosuYukle->image_y= 70;
                                  
                  $kargoLogosuYukle->process($verot_icin_klasorYolu);
                  if ($kargoLogosuYukle->processed) {//resim yukleme olduysa
                     $kargoLogosuYukle->clean();
                     header("Location:index.php?SKD=0&SKI=24");
                     exit();
                  } else {
                   header("Location:index.php?SKD=0&SKI=25");
                   exit();//resim yujleme basarusız hata sayfasına gider
                  }
        } //KARGO eklenemediyse
      }else{
         header("Location:index.php?SKD=0&SKI=25");//ekle hata
         exit();
      }
   }else{//kargo bilgilerinden herhangi biri boş geldiyse
   	 header("Location:index.php?SKD=0&SKI=25");//ekle hata
     exit();
   }

}else{
  header("Location:index.php?SKD=1");
  exit();
}

?>