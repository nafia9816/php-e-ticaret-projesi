<?php
namespace Verot\Upload;
if (isset($_SESSION["Yonetici"])) {
  if (isset($_GET["ID"])) {
     $GelenID=guvenlik($_GET["ID"]);
   }else{
     $GelenID="";
   }
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

   if(($GelenbankaAdi!="") and ($GelensubeAdi!="") and ($GelensubeKodu!="") and ($GelenkonumSehir!="") and ($GelenkonumUlke!="") and ($GelenparaBirimi!="") and ($GelenhesapSahibi!="") and ($GelenhesapNum!="") and ($GelenibanNum!="")){
    
      $hesap_guncelle=$baglan->prepare("UPDATE bankahesaplari SET bankaAdi=?,konumSehir=?,konumUlke=?,subeAdi=?,subeKodu=?,paraBirimi=?,hesapSahibi=?,hesapNum=?,ibanNum=? WHERE id=? LIMIT 1");
   	  $hesap_guncelle->execute([$GelenbankaAdi,$GelenkonumSehir,$GelenkonumUlke,$GelensubeAdi,$GelensubeKodu,$GelenparaBirimi,$GelenhesapSahibi,$GelenhesapNum,$GelenibanNum,$GelenID]);
      $hesap_kontrol=$hesap_guncelle->rowCount();

      if(($gelenbankaLogo["name"]!="") and ($gelenbankaLogo["type"]!="") and ($gelenbankaLogo["tmp_name"]!="")  and ($gelenbankaLogo["error"]==0) and ($gelenbankaLogo["size"]>0)){//kullanıcı resmide değiştimek isterse diye bunu ayrı yapıyoruz
          $bankaResmi_sorgusu=$baglan->prepare("SELECT * FROM bankahesaplari WHERE id=?");
          $bankaResmi_sorgusu->execute([$GelenID]);
          $resim_kontrol=$bankaResmi_sorgusu->rowCount();
          $resim_bilgidi=$bankaResmi_sorgusu->fetch();//İÇİNİ VEROTTE HATA VERİYO DİYE SİLDİM

          $silinecek_dosya_yolu="../img/" . $resim_bilgidi["banka_logo"];
          unlink($silinecek_dosya_yolu);//logoyu da silebilmk için yani silecegim banka hesabının logodunuda silmk içim

          $resimIcinDosyaAdi=resimAdiOlustur();
          $gelenResminUzantisi=substr($gelenbankaLogo["name"],-4);//.uzantıyı veriyo mesela .png
          if (($gelenResminUzantisi=="jpeg") or ($gelenResminUzantisi=="jfif")) {
             $gelenResminUzantisi=".".$gelenResminUzantisi;
          }
          $resimIcinyeniDosyaAdi=$resimIcinDosyaAdi.$gelenResminUzantisi;
          $bankaLogosuYukle=new Upload($gelenbankaLogo,"tr-TR");
            if ($bankaLogosuYukle->uploaded) {
                 $bankaLogosuYukle->mime_magic_check =true;//geeln resmin mime turunu aşagıda belirrtiğim ture check ediyo. ben image turunde dedim pdf gelirse hata verir
                  $bankaLogosuYukle->allowed = array("image/*");//butun resim uzantılarını kaubl eder
                  $bankaLogosuYukle->file_new_name_body = $resimIcinDosyaAdi;
                  $bankaLogosuYukle->file_overwrite= true;//dosya varsa ustune yaz
                  //$bankaLogosuYukle->image_convert= "png";//dosya her halikarda png olsun
                  $bankaLogosuYukle->image_quality= 100;//kalitesi yuzde 100 oslun
                  $bankaLogosuYukle->image_background_color= "#FFFFFF";
                  $bankaLogosuYukle->image_resize = true;//belirttiğim boyuttan buyuk resim gelirse kırp
                  $bankaLogosuYukle->image_y= 30;
                                   
                  $bankaLogosuYukle->process($verot_icin_klasorYolu);
                  if ($bankaLogosuYukle->processed) {//resim yukleme olduysa
                      $hesap_resmiguncelle=$baglan->prepare("UPDATE bankahesaplari SET banka_logo=? WHERE id=? LIMIT 1");
                      $hesap_resmiguncelle->execute([$resimIcinyeniDosyaAdi,$GelenID]);
                      $hesap_resmikontrol=$hesap_resmiguncelle->rowCount();
                      if ($hesap_resmikontrol<1) {
                        header("Location:index.php?SKD=0&SKI=17");
                        exit();
                      }
                      $bankaLogosuYukle->clean();
                  } else {
                   header("Location:index.php?SKD=0&SKI=17");
                   exit();//resim yujleme basarusız hata sayfasına gider
                  }
         }//resim yukleme sonu 
      }//resim kontrol ettiğim if in sonu
      if(($hesap_resmikontrol>0) or ($hesap_kontrol>0)){
              header("Location:index.php?SKD=0&SKI=16");
              exit();

      } else {
              header("Location:index.php?SKD=0&SKI=17");
              exit();//resim yujleme basarusız hata sayfasına gider
      }

  }else{
         header("Location:index.php?SKD=0&SKI=17");//ekle hata
         exit();
  }
}else{
  header("Location:index.php?SKD=1");
  exit();
}

?>