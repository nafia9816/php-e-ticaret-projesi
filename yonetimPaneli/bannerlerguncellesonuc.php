<?php
namespace Verot\Upload;
if (isset($_SESSION["Yonetici"])) {

  if (isset($_GET["ID"])) {
     $GelenID=guvenlik($_GET["ID"]);
   }else{
     $GelenID="";
   }  
   if (isset($_POST["BannerAlani"])) {
     $GelenBannerAlani=guvenlik($_POST["BannerAlani"]);
   }else{
     $GelenBannerAlani="";
   }
   $gelenBannerResmi=$_FILES["BannerResmi"];  
   if (isset($_POST["BannerAdi"])) {
   	 $GelenBannerAdi=guvenlik($_POST["BannerAdi"]);
   }else{
   	 $GelenBannerAdi="";
   }
  
//guncele işleminde anasayfanın banner ı diğer alanlara konamaz her alan için bu şekilde olacak şekilde kodlayacağız.ki boyut sorunları olmasın resim de bozulmasın
   if(($GelenID!="") and ($GelenBannerAdi!="") and ($GelenBannerAlani!="")){

          $bannerResmi_sorgusu=$baglan->prepare("SELECT * FROM bannerler WHERE id=? LIMIT 1");
          $bannerResmi_sorgusu->execute([$GelenID]);
          $resim_kontrol=$bannerResmi_sorgusu->rowCount();
          $resim_bilgidi=$bannerResmi_sorgusu->fetch();//İÇİNİ VEROTTE HATA VERİYO DİYE SİLDİM

          if ($GelenBannerAlani==$resim_bilgidi["BannerAlani"]) { //banner alanı güncellenmeyecekse resim yuklerken boyutunu if-else iile kontrolediyoruz.
             $banner_guncelle=$baglan->prepare("UPDATE bannerler SET BannerAlani=?, BannerAdi=? WHERE id=? LIMIT 1");
             $banner_guncelle->execute([$GelenBannerAlani,$GelenBannerAdi,$GelenID]);
             $banner_kontrol=$banner_guncelle->rowCount();

             if(($gelenBannerResmi["name"]!="") and ($gelenBannerResmi["type"]!="") and ($gelenBannerResmi["tmp_name"]!="")  and ($gelenBannerResmi["error"]==0) and ($gelenBannerResmi["size"]>0)){
      
               $silinecek_dosya_yolu="../img/" . $resim_bilgidi["BannerResmi"];
               unlink($silinecek_dosya_yolu);//logoyu da silebilmk için yani silecegim banka hesabının logodunuda silmk içim

               $resimIcinDosyaAdi=resimAdiOlustur();
               $gelenResminUzantisi=substr($gelenBannerResmi["name"],-4);//.uzantıyı veriyo mesela .png
               if (($gelenResminUzantisi=="jpeg") or ($gelenResminUzantisi=="jfif")) {
                 $gelenResminUzantisi=".".$gelenResminUzantisi;
               }
               $resimIcinyeniDosyaAdi=$resimIcinDosyaAdi.$gelenResminUzantisi;         
               if ($GelenBannerAlani =="Ana Sayfa") {
                   $img_genislik=1035;
                   $img_yukseklik=158;
               }elseif($GelenBannerAlani =="Menu Altı"){
                    $img_genislik=323;
                    $img_yukseklik=156;
               }elseif($GelenBannerAlani =="urunDetay"){
                   $img_genislik=350;
                   $img_yukseklik=351;
               }

               $bannerYukle=new Upload($gelenBannerResmi,"tr-TR");
                if ($bannerYukle->uploaded) {
                   $bannerYukle->mime_magic_check =true;//geeln resmin mime turunu aşagıda belirrtiğim ture check ediyo. ben image turunde dedim pdf gelirse hata verir
                   $bannerYukle->allowed = array("image/*");//butun resim uzantılarını kaubl eder
                   $bannerYukle->file_new_name_body = $resimIcinDosyaAdi;
                   $bannerYukle->file_overwrite= true;//dosya varsa ustune yaz
                   //$bannerYukle->image_convert= "png";//dosya her halikarda png olsun
                   $bannerYukle->image_quality= 100;//kalitesi yuzde 100 oslun ölçülerini koruy yani
                   $bannerYukle->image_background_color= "#FFFFFF";
                   $bannerYukle->image_resize = true;//belirttiğim boyuttan buyuk resim gelirse kırp
                   $bannerYukle->image_y= $img_yukseklik;
                   $bannerYukle->image_x=$img_genislik;

                   $bannerYukle->process($verot_icin_klasorYolu);
                   if ($bannerYukle->processed) {//resim yukleme olduysa
                      $banner_resmiguncelle=$baglan->prepare("UPDATE bannerler SET BannerAlani=?, BannerAdi=?,BannerResmi=?  WHERE id=? LIMIT 1");
                      $banner_resmiguncelle->execute([$GelenBannerAlani,$GelenBannerAdi,$resimIcinyeniDosyaAdi,$GelenID]);
                      $banner_resmikontrol=$banner_resmiguncelle->rowCount();
                      if ($banner_resmikontrol<1) {
                        header("Location:index.php?SKD=0&SKI=41");//hata
                        exit();
                      }
                      $bannerYukle->clean();
                  } else {
                   header("Location:index.php?SKD=0&SKI=41");
                   exit();//resim yujleme basarusız hata sayfasına gider
                  }
                }//resim yukleme sonu 

            }//resmin parametrelerinin doluluk boşluk kontrolü sonu
            if(($banner_resmikontrol>0) or ($banner_kontrol>0)){
              header("Location:index.php?SKD=0&SKI=40");//tamam banner guncellendi
              exit();
            }else{
              header("Location:index.php?SKD=0&SKI=41");
              exit();
            }
          }else{ //banner alanı da güncellenecekse 
            if(($gelenBannerResmi["name"]!="") and ($gelenBannerResmi["type"]!="") and ($gelenBannerResmi["tmp_name"]!="")  and ($gelenBannerResmi["error"]==0) and ($gelenBannerResmi["size"]>0)){//resim gelmişmi bakcak

               $silinecek_dosya_yolu="../img/" . $resim_bilgidi["BannerResmi"];
               unlink($silinecek_dosya_yolu);//logoyu da silebilmk için yani silecegim banka hesabının logodunuda silmk içim
               $resimIcinDosyaAdi=resimAdiOlustur();
               $gelenResminUzantisi=substr($gelenBannerResmi["name"],-4);//.uzantıyı veriyo mesela .png
               if (($gelenResminUzantisi=="jpeg") or ($gelenResminUzantisi=="jfif")) {
                 $gelenResminUzantisi=".".$gelenResminUzantisi;
               }
               $resimIcinyeniDosyaAdi=$resimIcinDosyaAdi.$gelenResminUzantisi;         
               if ($GelenBannerAlani =="Ana Sayfa") {
                   $img_genislik=1035;
                   $img_yukseklik=158;
               }elseif($GelenBannerAlani =="Menu Altı"){
                    $img_genislik=323;
                    $img_yukseklik=156;
               }elseif($GelenBannerAlani =="urunDetay"){
                   $img_genislik=350;
                   $img_yukseklik=351;
               }
               $bannerYukle=new Upload($gelenBannerResmi,"tr-TR");
                if ($bannerYukle->uploaded) {
                   $bannerYukle->mime_magic_check =true;//geeln resmin mime turunu aşagıda belirrtiğim ture check ediyo. ben image turunde dedim pdf gelirse hata verir
                   $bannerYukle->allowed = array("image/*");//butun resim uzantılarını kaubl eder
                   $bannerYukle->file_new_name_body = $resimIcinDosyaAdi;
                   $bannerYukle->file_overwrite= true;//dosya varsa ustune yaz
                   //$bannerYukle->image_convert= "png";//dosya her halikarda png olsun
                   $bannerYukle->image_quality= 100;//kalitesi yuzde 100 oslun ölçülerini koruy yani
                   $bannerYukle->image_background_color= "#FFFFFF";
                   $bannerYukle->image_resize = true;//belirttiğim boyuttan buyuk resim gelirse kırp
                   $bannerYukle->image_y= $img_yukseklik;
                   $bannerYukle->image_x=$img_genislik;                  
                   $bannerYukle->process($verot_icin_klasorYolu);

                   if ($bannerYukle->processed) {//resim yukleme olduysa
                      $banner_resmiguncelle=$baglan->prepare("UPDATE bannerler SET BannerAlani=?, BannerAdi=?,BannerResmi=?  WHERE id=? LIMIT 1");
                      $banner_resmiguncelle->execute([$GelenBannerAlani,$GelenBannerAdi,$resimIcinyeniDosyaAdi,$GelenID]);
                      $banner_resmikontrol=$banner_resmiguncelle->rowCount();

                      header("Location:index.php?SKD=0&SKI=40");
                      exit();
                      if ($banner_resmikontrol<1) {
                        header("Location:index.php?SKD=0&SKI=41");
                        exit();
                      }
                      $bannerYukle->clean();                   
                   } else {
                   header("Location:index.php?SKD=0&SKI=41");
                   exit();//resim yujleme basarusız hata sayfasına gider
                   }
                }//resim yükleme sonu 

            }else{
                     header("Location:index.php?SKD=0&SKI=41");
                   exit();//resim yujleme basarusız hata sayfasına gider
            }
                
          }
        }else{
         header("Location:index.php?SKD=0&SKI=41");//ekle hata
         exit();
        }

}else{
  header("Location:index.php?SKD=1");
  exit();
}

?>