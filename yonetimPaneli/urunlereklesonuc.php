<?php
namespace Verot\upload;
if (isset($_SESSION["Yonetici"])) {

   if (isset($_POST["UrunMenusu"])) {
     $GelenUrunMenusu=guvenlik($_POST["UrunMenusu"]);
   }else{
     $GelenUrunMenusu="";
   }
   if (isset($_POST["UrunAdi"])) {
       $GelenUrunAdi=guvenlik($_POST["UrunAdi"]);
   }else{
       $GelenUrunAdi="";
   }
   if (isset($_POST["UrunFiyati"])) {
       $GelenUrunFiyati=guvenlik($_POST["UrunFiyati"]);
   }else{
       $GelenUrunFiyati="";
   }
   if (isset($_POST["ParaBirimi"])) {
       $GelenParaBirimi=guvenlik($_POST["ParaBirimi"]);
   }else{
       $GelenParaBirimi="";
   }
   if (isset($_POST["KDVOrani"])) {
       $GelenKDVOrani=guvenlik($_POST["KDVOrani"]);
   }else{
       $GelenKDVOrani="";
   }
   if (isset($_POST["KargoUcreti"])) {
       $GelenKargoUcreti=guvenlik($_POST["KargoUcreti"]);
   }else{
       $GelenKargoUcreti="";
   }
   if (isset($_POST["UrunAciklamasi"])) {
       $GelenUrunAciklamasi=guvenlik($_POST["UrunAciklamasi"]);
   }else{
       $GelenUrunAciklamasi="";
   }
   if (isset($_POST["VaryantBasligi"])) {
       $GelenVaryantBasligi=guvenlik($_POST["VaryantBasligi"]);
   }else{
       $GelenVaryantBasligi="";
   }
   if (isset($_POST["VaryantAdi"])) {
       $GelenVaryantAdi=guvenlik($_POST["VaryantAdi"]);
   }else{
       $GelenVaryantAdi="";
   }
   if (isset($_POST["StokAdedi"])) {
       $GelenStokAdedi=guvenlik($_POST["StokAdedi"]);
   }else{
       $GelenStokAdedi="";
   }
   if (isset($_POST["VaryantAdi2"])) {
       $GelenVaryantAdi2=guvenlik($_POST["VaryantAdi2"]);
   }else{
       $GelenVaryantAdi2="";
   }
   if (isset($_POST["StokAdedi2"])) {
       $GelenStokAdedi2=guvenlik($_POST["StokAdedi2"]);
   }else{
       $GelenStokAdedi2="";
   }
   if (isset($_POST["VaryantAdi3"])) {
       $GelenVaryantAdi3=guvenlik($_POST["VaryantAdi3"]);
   }else{
       $GelenVaryantAdi3="";
   }
   if (isset($_POST["StokAdedi3"])) {
       $GelenStokAdedi3=guvenlik($_POST["StokAdedi3"]);
   }else{
       $GelenStokAdedi3="";
   }
   if (isset($_POST["VaryantAdi4"])) {
       $GelenVaryantAdi4=guvenlik($_POST["VaryantAdi4"]);
   }else{
       $GelenVaryantAdi4="";
   }
   if (isset($_POST["StokAdedi4"])) {
       $GelenStokAdedi4=guvenlik($_POST["StokAdedi4"]);
   }else{
       $GelenStokAdedi4="";
   }
   if (isset($_POST["VaryantAdi5"])) {
       $GelenVaryantAdi5=guvenlik($_POST["VaryantAdi5"]);
   }else{
       $GelenVaryantAdi5="";
   }
   if (isset($_POST["StokAdedi5"])) {
       $GelenStokAdedi5=guvenlik($_POST["StokAdedi5"]);
   }else{
       $GelenStokAdedi5="";
   }
   
   $gelenUrunResmiBir=$_FILES["UrunResmiBir"];
   $gelenUrunResmiIki=$_FILES["UrunResmiIki"];
   $gelenUrunResmiUc=$_FILES["UrunResmiUc"];
   $gelenUrunResmi4=$_FILES["UrunResmi4"];


  if(($GelenUrunMenusu!="") and ($GelenUrunAdi!="")and ($GelenUrunFiyati!="")and ($GelenParaBirimi!="")and ($GelenKDVOrani!="")and ($GelenKargoUcreti!="")and ($GelenUrunAciklamasi!="")and ($GelenVaryantBasligi!="")and ($GelenVaryantAdi!="")and ($GelenStokAdedi!="")and ($gelenUrunResmiBir["name"]!="") and ($gelenUrunResmiBir["type"]!="") and ($gelenUrunResmiBir["tmp_name"]!="")  and ($gelenUrunResmiBir["error"]==0) and ($gelenUrunResmiBir["size"]>0) ){ //zorunlu olan alanlar

    $menuTuru_Sorgusu=$baglan->prepare("SELECT * FROM menuler WHERE id=? LIMIT 1");
    $menuTuru_Sorgusu->execute([$GelenUrunMenusu]);
    $menuTuruKontrol=$menuTuru_Sorgusu->rowCount();
    $menuTurunKaydi=$menuTuru_Sorgusu->fetch();

    //resmi yukleyeceği klasoru belirelemk için asagıdakileri yazdık.
    if ($menuTurunKaydi["UrunTuru"] =="fincan") {
      $resimKlasoru="urunler/fincan/";
    }elseif($menuTurunKaydi["UrunTuru"] =="kupa"){
        $resimKlasoru="urunler/kupa/";
    
    }elseif($menuTurunKaydi["UrunTuru"] =="kahveyanibardak"){
        $resimKlasoru="urunler/kahveyanibardak/";
    }
    elseif($menuTurunKaydi["UrunTuru"] =="sunumluk"){
        $resimKlasoru="urunler/sunumluk/";
    }

    if ($menuTuruKontrol>0) {

    $resim1DosyaAdi=resimAdiOlustur();
    $gelen1ResminUzantisi=substr($gelenUrunResmiBir["name"],-4);//.uzantıyı veriyo mesela .png
    if (($gelen1ResminUzantisi=="jpeg") or ($gelen1ResminUzantisi=="jfif")) {
        $gelen1ResminUzantisi=".".$gelen1ResminUzantisi;
      }
    $resim1IcinyeniDosyaAdi=$resim1DosyaAdi.$gelen1ResminUzantisi;

    $urun_ekle=$baglan->prepare("INSERT INTO urunler  (MenuId,UrunTuru,UrunAdi,UrunFiyati,ParaBirimi,KDVOrani,UrunAciklamasi,UrunResmiBir,VaryantBasligi,KargoUcreti,Durumu) values(?,?,?,?,?,?,?,?,?,?,?)");
    $urun_ekle->execute([$GelenUrunMenusu,$menuTurunKaydi["UrunTuru"],$GelenUrunAdi,$GelenUrunFiyati,$GelenParaBirimi,$GelenKDVOrani,$GelenUrunAciklamasi,$resim1IcinyeniDosyaAdi,$GelenVaryantBasligi,$GelenKargoUcreti,1]);

    $urun_kontrol=$urun_ekle->rowCount();
    if ($urun_kontrol>0) {
        $sonEklenenUrunIdsi=$baglan->lastInsertId();//eklenecek varyanrt id için

        $resim1Yukle=new upload($gelenUrunResmiBir,"tr-TR");
          if ($resim1Yukle->uploaded) {
                 $resim1Yukle->mime_magic_check =true;
                  $resim1Yukle->allowed = array("image/*");
                  $resim1Yukle->file_new_name_body = $resim1DosyaAdi;
                  $resim1Yukle->file_overwrite= true;
                  $resim1Yukle->image_quality= 100;
                  $resim1Yukle->image_background_color= "#FFFFFF";
                  $resim1Yukle->image_resize = true;
                  $resim1Yukle->image_x= 600;
                  $resim1Yukle->image_y= 800;
                  $resim1Yukle->process($verot_icin_klasorYolu.$resimKlasoru);

                  if ($resim1Yukle->processed) {//resim yukleme olduysa
                     $resim1Yukle->clean();
                  } else {
                   header("Location:index.php?SKD=0&SKI=97");
                   exit();
                  }
        }//yukleme sonu if kpaması

        $Menu_urunSayisi_guncelle=$baglan->prepare("UPDATE menuler SET UrunSayisi=UrunSayisi+1 WHERE id=? LIMIT 1");
        $Menu_urunSayisi_guncelle->execute([$GelenUrunMenusu]);
        $Menu_kontrol=$Menu_urunSayisi_guncelle->rowCount();

        if ($Menu_kontrol>0) {
          $birinciVaryant_ekle=$baglan->prepare("INSERT INTO urunvaryantlari  (UrunId,VaryantAdi,StokAdedi) values(?,?,?)");
          $birinciVaryant_ekle->execute([$sonEklenenUrunIdsi,$GelenVaryantAdi,$GelenStokAdedi]);

          $varyant1_kontrol=$birinciVaryant_ekle->rowCount();
          if ($varyant1_kontrol>0) {

            if (($GelenVaryantAdi2!="") and ($GelenStokAdedi2!="")) {
              $ikinciVaryant_ekle=$baglan->prepare("INSERT INTO urunvaryantlari  (UrunId,VaryantAdi,StokAdedi) values(?,?,?)");
              $ikinciVaryant_ekle->execute([$sonEklenenUrunIdsi,$GelenVaryantAdi2,$GelenStokAdedi2]);
            }
            if (($GelenVaryantAdi3!="") and ($GelenStokAdedi3!="")) {
              $ucuncuVaryant_ekle=$baglan->prepare("INSERT INTO urunvaryantlari  (UrunId,VaryantAdi,StokAdedi) values(?,?,?)");
              $ucuncuVaryant_ekle->execute([$sonEklenenUrunIdsi,$GelenVaryantAdi3,$GelenStokAdedi3]);
            }
            if (($GelenVaryantAdi4!="") and ($GelenStokAdedi4!="")) {
              $dorduncuVaryant_ekle=$baglan->prepare("INSERT INTO urunvaryantlari  (UrunId,VaryantAdi,StokAdedi) values(?,?,?)");
              $dorduncuVaryant_ekle->execute([$sonEklenenUrunIdsi,$GelenVaryantAdi4,$GelenStokAdedi4]);
            }
            if (($GelenVaryantAdi5!="") and ($GelenStokAdedi5!="")) {
              $besinciVaryant_ekle=$baglan->prepare("INSERT INTO urunvaryantlari  (UrunId,VaryantAdi,StokAdedi) values(?,?,?)");
              $besinciVaryant_ekle->execute([$sonEklenenUrunIdsi,$GelenVaryantAdi5,$GelenStokAdedi5]);
            }

            if(($gelenUrunResmiIki["name"]!="") and ($gelenUrunResmiIki["type"]!="") and ($gelenUrunResmiIki["tmp_name"]!="")  and ($gelenUrunResmiIki["error"]==0) and ($gelenUrunResmiIki["size"]>0)){//resim 2 doluysa burada ekletiyoruz

              $resim2DosyaAdi=resimAdiOlustur();
              $gelen2ResminUzantisi=substr($gelenUrunResmiIki["name"],-4);
              if (($gelen2ResminUzantisi=="jpeg") or ($gelen2ResminUzantisi=="jfif")) {
                  $gelen2ResminUzantisi=".".$gelen2ResminUzantisi;
              }
              $resim2IcinyeniDosyaAdi=$resim2DosyaAdi.$gelen2ResminUzantisi;

              $resim2Yukle=new upload($gelenUrunResmiIki,"tr-TR");
            if ($resim2Yukle->uploaded) {
                 $resim2Yukle->mime_magic_check =true;
                  $resim2Yukle->allowed = array("image/*");
                  $resim2Yukle->file_new_name_body = $resim2DosyaAdi;
                  $resim2Yukle->file_overwrite= true;
                  $resim2Yukle->image_quality= 100;
                  $resim2Yukle->image_background_color= "#FFFFFF";
                  $resim2Yukle->image_resize = true;
                  $resim2Yukle->image_x= 600;
                  $resim2Yukle->image_y= 800;
                  $resim2Yukle->process($verot_icin_klasorYolu.$resimKlasoru);

                  if ($resim2Yukle->processed) {//resim yukleme olduysa urun kaydını guncelliyoruz
                    $resim2_guncelle=$baglan->prepare("UPDATE urunler SET UrunResmiIki=? WHERE id=? LIMIT 1");
                    $resim2_guncelle->execute([$resim2IcinyeniDosyaAdi,$sonEklenenUrunIdsi]);
                    $resim2_kontrol=$resim2_guncelle->rowCount();
                    if ($resim2_kontrol<1) { //guncelleme olmadıysa
                      header("Location:index.php?SKD=0&SKI=97");
                      exit();
                    }

                     $resim2Yukle->clean();
                  } else {
                   header("Location:index.php?SKD=0&SKI=97");
                   exit();
                  }
             } //rsim2 yukleme sonu

            } 

            if(($gelenUrunResmiUc["name"]!="") and ($gelenUrunResmiUc["type"]!="") and ($gelenUrunResmiUc["tmp_name"]!="")  and ($gelenUrunResmiUc["error"]==0) and ($gelenUrunResmiUc["size"]>0)){//resim 3 doluysa burada ekletiyoruz

              $resim3DosyaAdi=resimAdiOlustur();
              $gelen3ResminUzantisi=substr($gelenUrunResmiUc["name"],-4);
              if (($gelen3ResminUzantisi=="jpeg") or ($gelen3ResminUzantisi=="jfif")) {
                  $gelen3ResminUzantisi=".".$gelen3ResminUzantisi;
              }
              $resim3IcinyeniDosyaAdi=$resim3DosyaAdi.$gelen3ResminUzantisi;

              $resim3Yukle=new upload($gelenUrunResmiUc,"tr-TR");
            if ($resim3Yukle->uploaded) {
                 $resim3Yukle->mime_magic_check =true;
                  $resim3Yukle->allowed = array("image/*");
                  $resim3Yukle->file_new_name_body = $resim3DosyaAdi;
                  $resim3Yukle->file_overwrite= true;
                  $resim3Yukle->image_quality= 100;
                  $resim3Yukle->image_background_color= "#FFFFFF";
                  $resim3Yukle->image_resize = true;
                  $resim3Yukle->image_x= 600;
                  $resim3Yukle->image_y= 800;
                  $resim3Yukle->process($verot_icin_klasorYolu.$resimKlasoru);

                  if ($resim3Yukle->processed) {//resim yukleme olduysa urun kaydını guncelliyoruz
                    $resim3_guncelle=$baglan->prepare("UPDATE urunler SET UrunResmiUc=? WHERE id=? LIMIT 1");
                    $resim3_guncelle->execute([$resim3IcinyeniDosyaAdi,$sonEklenenUrunIdsi]);
                    $resim3_kontrol=$resim3_guncelle->rowCount();
                    if ($resim3_kontrol<1) { //guncelleme olmadıysa
                      header("Location:index.php?SKD=0&SKI=97");
                      exit();
                    }

                     $resim3Yukle->clean();
                  } else {
                   header("Location:index.php?SKD=0&SKI=97");
                   exit();
                  }
             } //rsim2 yukleme sonu

            } 


            if(($gelenUrunResmi4["name"]!="") and ($gelenUrunResmi4["type"]!="") and ($gelenUrunResmi4["tmp_name"]!="")  and ($gelenUrunResmi4["error"]==0) and ($gelenUrunResmi4["size"]>0)){//resim 2 doluysa burada ekletiyoruz

              $resim4DosyaAdi=resimAdiOlustur();
              $gelen4ResminUzantisi=substr($gelenUrunResmi4["name"],-4);
              if (($gelen4ResminUzantisi=="jpeg") or ($gelen4ResminUzantisi=="jfif")) {
                  $gelen4ResminUzantisi=".".$gelen4ResminUzantisi;
              }
              $resim4IcinyeniDosyaAdi=$resim4DosyaAdi.$gelen4ResminUzantisi;

              $resim4Yukle=new upload($gelenUrunResmi4,"tr-TR");
            if ($resim4Yukle->uploaded) {
                 $resim4Yukle->mime_magic_check =true;
                  $resim4Yukle->allowed = array("image/*");
                  $resim4Yukle->file_new_name_body = $resim4DosyaAdi;
                  $resim4Yukle->file_overwrite= true;
                  $resim4Yukle->image_quality= 100;
                  $resim4Yukle->image_background_color= "#FFFFFF";
                  $resim4Yukle->image_resize = true;
                  $resim4Yukle->image_x= 600;
                  $resim4Yukle->image_y= 800;
                  $resim4Yukle->process($verot_icin_klasorYolu.$resimKlasoru);

                  if ($resim4Yukle->processed) {//resim yukleme olduysa urun kaydını guncelliyoruz
                    $resim4_guncelle=$baglan->prepare("UPDATE urunler SET UrunResmi4=? WHERE id=? LIMIT 1");
                    $resim4_guncelle->execute([$resim4IcinyeniDosyaAdi,$sonEklenenUrunIdsi]);
                    $resim4_kontrol=$resim4_guncelle->rowCount();
                    if ($resim4_kontrol<1) { //guncelleme olmadıysa
                      header("Location:index.php?SKD=0&SKI=97");
                      exit();
                    }

                     $resim4Yukle->clean();
                  } else {
                   header("Location:index.php?SKD=0&SKI=97");
                   exit();
                  }
             } //rsim2 yukleme sonu

            } 

            header("Location:index.php?SKD=0&SKI=96");
            exit();
          
}else{
   header("Location:index.php?SKD=0&SKI=97");//ekle hata
   exit();
}

}else{
   header("Location:index.php?SKD=0&SKI=97");//ekle hata
   exit();
}

}else{
   header("Location:index.php?SKD=0&SKI=97");//ekle hata
   exit();
}

}else{
   header("Location:index.php?SKD=0&SKI=97");//ekle hata
   exit();
}


}else{
   header("Location:index.php?SKD=0&SKI=97");//ekle hata
   exit();
}



}else{
  header("Location:index.php?SKD=1");
  exit();
}

?>