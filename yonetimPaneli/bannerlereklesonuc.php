<?php
namespace Verot\upload;
if (isset($_SESSION["Yonetici"])) {

   if (isset($_POST["BannerAdi"])) {
     $GelenBannerAdi=guvenlik($_POST["BannerAdi"]);
   }else{
     $GelenBannerAdi="";
   }
   $gelenBannerResmi=$_FILES["BannerResmi"];  
   if (isset($_POST["BannerAlani"])) {
   	 $GelenBannerAlani=guvenlik($_POST["BannerAlani"]);
   }else{
   	 $GelenBannerAlani="";
   }
   
   if(($gelenBannerResmi["name"]!="") and ($gelenBannerResmi["type"]!="") and ($gelenBannerResmi["tmp_name"]!="")  and ($gelenBannerResmi["error"]==0) and ($gelenBannerResmi["size"]>0) and ($GelenBannerAdi!="") and ($GelenBannerAlani!="")){

      $resimIcinDosyaAdi=resimAdiOlustur();
      $gelenResminUzantisi=substr($gelenBannerResmi["name"],-4);//.uzantıyı veriyo mesela .png
      if (($gelenResminUzantisi=="jpeg") or ($gelenResminUzantisi=="jfif")) {
        $gelenResminUzantisi=".".$gelenResminUzantisi;
      }
      $resimIcinyeniDosyaAdi=$resimIcinDosyaAdi.$gelenResminUzantisi;

      
      $banner_ekle=$baglan->prepare("INSERT INTO bannerler  (BannerAlani,BannerAdi,BannerResmi) values(?,?,?)");
   	  $banner_ekle->execute([$GelenBannerAlani,$GelenBannerAdi,$resimIcinyeniDosyaAdi]);
      $banner_kontrol=$banner_ekle->rowCount();
      if($banner_kontrol>0){
        if ($GelenBannerAlani =="Ana Sayfa") {
          $img_genislik=1440;
          $img_yukseklik=158;
        }elseif($GelenBannerAlani =="Menu Altı"){
            $img_genislik=323;
            $img_yukseklik=156;
        }elseif($GelenBannerAlani =="urunDetay"){
            $img_genislik=300;
            $img_yukseklik=351;
        }
        // anasayfa banner:1065*158
        // menu altı 323*156
         $bannerYukle=new upload($gelenBannerResmi,"tr-TR");
            if ($bannerYukle->uploaded) {
                 $bannerYukle->mime_magic_check =true;//geeln resmin mime turunu aşagıda belirrtiğim ture check ediyo. ben image turunde dedim pdf gelirse hata verir
                  $bannerYukle->allowed = array("image/*");//butun resim uzantılarını kaubl eder
                  $bannerYukle->file_new_name_body = $resimIcinDosyaAdi;
                  $bannerYukle->file_overwrite= true;//dosya varsa ustune yaz
                  //$bannerYukle->image_convert= "png";//dosya her halikarda png olsun
                  $bannerYukle->image_quality= 100;//kalitesi yuzde 100 oslun
                  $bannerYukle->image_background_color= "#FFFFFF";
                  $bannerYukle->image_resize = true;
                  $bannerYukle->image_x=$img_genislik;
                  $bannerYukle->image_y=$img_yukseklik;
                 
                  
                  $bannerYukle->process($verot_icin_klasorYolu);

                  if ($bannerYukle->processed) {//resim yukleme olduysa

                     $bannerYukle->clean();

                     header("Location:index.php?SKD=0&SKI=36");
                     exit();

                  } else {
                   header("Location:index.php?SKD=0&SKI=37");
                   exit();//resim yujleme basarusız hata sayfasına gider
                  }
            } 
      }else{
         header("Location:index.php?SKD=0&SKI=37");//ekle hata
         exit();
      }
   }else{
   	 header("Location:index.php?SKD=0&SKI=37");//ekle hata
     exit();
   }

}else{
  header("Location:index.php?SKD=1");
  exit();
}

?>