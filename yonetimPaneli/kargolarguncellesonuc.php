<?php
namespace Verot\Upload;
if (isset($_SESSION["Yonetici"])) {
  
  if (isset($_GET["ID"])) {
     $GelenID=guvenlik($_GET["ID"]);
   }else{
     $GelenID="";
   }

   $gelenFirmaLogosu=$_FILES["FirmaLogosu"];   
   if (isset($_POST["FirmaAdi"])) {
   	 $GelenFirmaAdi=guvenlik($_POST["FirmaAdi"]);
   }else{
   	 $GelenFirmaAdi="";
   }
  
   if(($GelenFirmaAdi!="")){
      
      $kargo_guncelle=$baglan->prepare("UPDATE kargofirmalari SET FirmaAdi=? WHERE id=? LIMIT 1");
   	  $kargo_guncelle->execute([$GelenFirmaAdi,$GelenID]);
      $kargo_kontrol=$kargo_guncelle->rowCount();

      if(($gelenFirmaLogosu["name"]!="") and ($gelenFirmaLogosu["type"]!="") and ($gelenFirmaLogosu["tmp_name"]!="")  and ($gelenFirmaLogosu["error"]==0) and ($gelenFirmaLogosu["size"]>0)){
          $kargoResmi_sorgusu=$baglan->prepare("SELECT * FROM kargofirmalari WHERE id=? LIMIT 1");
          $kargoResmi_sorgusu->execute([$GelenID]);
          $resim_kontrol=$kargoResmi_sorgusu->rowCount();
          $resim_bilgidi=$kargoResmi_sorgusu->fetch();//İÇİNİ VEROTTE HATA VERİYO DİYE SİLDİM

          $silinecek_dosya_yolu="../img/" . $resim_bilgidi["FirmaLogosu"];
          unlink($silinecek_dosya_yolu);//logoyu da silebilmk için yani silecegim banka hesabının logodunuda silmk içim

          $resimIcinDosyaAdi=resimAdiOlustur();
          $gelenResminUzantisi=substr($gelenFirmaLogosu["name"],-4);//.uzantıyı veriyo mesela .png
          if (($gelenResminUzantisi=="jpeg") or ($gelenResminUzantisi=="jfif")) {
            //diğer ekle guncelesonuclar da and i or yap
             $gelenResminUzantisi=".".$gelenResminUzantisi;
          }
          $resimIcinyeniDosyaAdi=$resimIcinDosyaAdi.$gelenResminUzantisi;
          $kargoLogosuYukle=new Upload($gelenFirmaLogosu,"tr-TR");
            if ($kargoLogosuYukle->uploaded) {
                 $kargoLogosuYukle->mime_magic_check =true;//geeln resmin mime turunu aşagıda belirrtiğim ture check ediyo. ben image turunde dedim pdf gelirse hata verir
                  $kargoLogosuYukle->allowed = array("image/*");//butun resim uzantılarını kaubl eder
                  $kargoLogosuYukle->file_new_name_body = $resimIcinDosyaAdi;
                  $kargoLogosuYukle->file_overwrite= true;//dosya varsa ustune yaz
                  //$kargoLogosuYukle->image_convert= "png";//dosya her halikarda png olsun
                  $kargoLogosuYukle->image_quality= 100;//kalitesi yuzde 100 oslun ölçülerini koruy yani
                  $kargoLogosuYukle->image_background_color= "#FFFFFF";
                  $kargoLogosuYukle->image_x= 144;
                  $kargoLogosuYukle->image_y= 70;
                  $kargoLogosuYukle->image_ratio = true;//resmi genişletme bozulmasın yani diğerlerinede ekle
                                   
                  $kargoLogosuYukle->process($verot_icin_klasorYolu);

                  if ($kargoLogosuYukle->processed) {//resim yukleme olduysa
                      $kargo_resmiguncelle=$baglan->prepare("UPDATE kargofirmalari SET FirmaLogosu=? WHERE id=? LIMIT 1");
                      $kargo_resmiguncelle->execute([$resimIcinyeniDosyaAdi,$GelenID]);
                      $kargo_resmikontrol=$kargo_resmiguncelle->rowCount();
                      if ($kargo_resmikontrol<1) {
                        header("Location:index.php?SKD=0&SKI=29");
                        exit();
                      }
                     $kargoLogosuYukle->clean();                  
                  }else {
                   header("Location:index.php?SKD=0&SKI=29");
                   exit();//resim yujleme basarusız hata sayfasına gider
                  }
         }//resim yukleme sonu 
      }// resim için boşlıuk doluluk kontrolu sonu
      if(($kargo_resmikontrol>0) or ($kargo_kontrol>0)){
              header("Location:index.php?SKD=0&SKI=28");
              exit();

      }else{
              header("Location:index.php?SKD=0&SKI=29");
              exit();//resim yujleme basarusız hata sayfasına gider
      }
  
    }else{//firma adı boşlıuk doluluk kontrolu sonu
         header("Location:index.php?SKD=0&SKI=29");//ekle hata
         exit();
    }
 
}else{
  header("Location:index.php?SKD=1");
  exit();
}

?>