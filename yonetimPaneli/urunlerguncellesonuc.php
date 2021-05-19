<?php
namespace Verot\upload;
if (isset($_SESSION["Yonetici"])) {

  if (isset($_GET["ID"])) {
     $GelenID=guvenlik($_GET["ID"]);
   }else{
     $GelenID="";
   }
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


   if(($GelenUrunMenusu!="") and ($GelenUrunAdi!="")and ($GelenUrunFiyati!="")and ($GelenParaBirimi!="")and ($GelenKDVOrani!="")and ($GelenKargoUcreti!="")and ($GelenUrunAciklamasi!="")and ($GelenVaryantBasligi!="")and ($GelenVaryantAdi!="")and ($GelenStokAdedi!="")){ //zorunlu olan alanlar

    $urunn_Sorgusu=$baglan->prepare("SELECT * FROM urunler WHERE id=? LIMIT 1");//urun resimlerine ulaşabiilmek için
    $urunn_Sorgusu->execute([$GelenID]);
    $urunKontrol=$urunn_Sorgusu->rowCount();
    $urunBilgisi=$urunn_Sorgusu->fetch();
    if ($urunKontrol>0) {

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
    }elseif($menuTurunKaydi["UrunTuru"] =="sunumluk"){
        $resimKlasoru="urunler/sunumluk/";
    }

    if ($menuTuruKontrol>0) {
      $urun_guncelle=$baglan->prepare("UPDATE urunler SET MenuId=?,UrunAdi=?,UrunFiyati=?,ParaBirimi=?,KDVOrani=?,UrunAciklamasi=?,VaryantBasligi=?,KargoUcreti=? WHERE id=? LIMIT 1");
      $urun_guncelle->execute([$GelenUrunMenusu,$GelenUrunAdi,$GelenUrunFiyati,$GelenParaBirimi,$GelenKDVOrani,$GelenUrunAciklamasi,$GelenVaryantBasligi,$GelenKargoUcreti,$GelenID]);
      $urunG_kontrol=$urun_guncelle->rowCount();
      
      // RESİM 1 KONTOL BAŞI
      if(($gelenUrunResmiBir["name"]!="") and ($gelenUrunResmiBir["type"]!="") and ($gelenUrunResmiBir["tmp_name"]!="")  and ($gelenUrunResmiBir["error"]==0) and ($gelenUrunResmiBir["size"]>0)){//resim 2 doluysa burada ekletiyoruz

              $resim1DosyaAdi=resimAdiOlustur();
              $gelen1ResminUzantisi=substr($gelenUrunResmiBir["name"],-4);
              if (($gelen1ResminUzantisi=="jpeg") or ($gelen1ResminUzantisi=="jfif")) {
                  $gelen1ResminUzantisi=".".$gelen1ResminUzantisi;
              }
              $resim1IcinyeniDosyaAdi=$resim1DosyaAdi.$gelen1ResminUzantisi;
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

                  if ($resim1Yukle->processed) {
                  $silinecek1_dosya_yolu="../img/" . $resimKlasoru.$urunBilgisi["UrunResmiBir"];
                     unlink($silinecek1_dosya_yolu);

                    $resim1_guncelle=$baglan->prepare("UPDATE urunler SET UrunResmiBir=? WHERE id=? LIMIT 1");
                    $resim1_guncelle->execute([$resim1IcinyeniDosyaAdi,$GelenID]);
                    $resim1_kontrol=$resim1_guncelle->rowCount();
                    if ($resim1_kontrol<1) {                     
                     header("Location:index.php?SKD=0&SKI=100");//guncelle tmm
                     exit();
                  }
                  $resim1Yukle->clean();
                  } else {
                   header("Location:index.php?SKD=0&SKI=100");
                   exit();
                  }
             } 
            } // RESİM 1 KONTOL SONU
            // RESİM 2 KONTOL BAŞI
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

                  if ($resim2Yukle->processed) {
                  $silinecek2_dosya_yolu="../img/" . $resimKlasoru.$urunBilgisi["UrunResmiIki"];
                     unlink($silinecek2_dosya_yolu);

                    $resim2_guncelle=$baglan->prepare("UPDATE urunler SET UrunResmiIki=? WHERE id=? LIMIT 1");
                    $resim2_guncelle->execute([$resim2IcinyeniDosyaAdi,$GelenID]);
                    $resim2_kontrol=$resim2_guncelle->rowCount();
                    if ($resim2_kontrol<1) {                      
                     header("Location:index.php?SKD=0&SKI=100");//tmm
                     exit();
                  }
                     $resim2Yukle->clean();
                  } else {
                   header("Location:index.php?SKD=0&SKI=100");
                   exit();
                  }
             } 
            } // RESİM 2 KONTOL SONU
             // RESİM 3 KONTOL BAŞI
             if(($gelenUrunResmiUc["name"]!="") and ($gelenUrunResmiUc["type"]!="") and ($gelenUrunResmiUc["tmp_name"]!="")  and ($gelenUrunResmiUc["error"]==0) and ($gelenUrunResmiUc["size"]>0)){

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

                  if ($resim3Yukle->processed) {
                  $silinecek3_dosya_yolu="../img/" . $resimKlasoru.$urunBilgisi["UrunResmiUc"];
                     unlink($silinecek3_dosya_yolu);

                    $resim3_guncelle=$baglan->prepare("UPDATE urunler SET UrunResmiUc=? WHERE id=? LIMIT 1");
                    $resim3_guncelle->execute([$resim3IcinyeniDosyaAdi,$GelenID]);
                    $resim3_kontrol=$resim3_guncelle->rowCount();
                    if ($resim3_kontrol<1) {                      
                     header("Location:index.php?SKD=0&SKI=100");
                     exit();
                  }
                     $resim3Yukle->clean();
                  } else {
                   header("Location:index.php?SKD=0&SKI=100");
                   exit();
                  }
             } 
            } // RESİM 3 KONTOL SONU
            // RESİM 4 KONTOL BAŞI
             if(($gelenUrunResmi4["name"]!="") and ($gelenUrunResmi4["type"]!="") and ($gelenUrunResmi4["tmp_name"]!="")  and ($gelenUrunResmi4["error"]==0) and ($gelenUrunResmi4["size"]>0)){

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

                  if ($resim4Yukle->processed) {
                  $silinecek4_dosya_yolu="../img/" . $resimKlasoru.$urunBilgisi["UrunResmi4"];
                     unlink($silinecek4_dosya_yolu);

                    $resim4_guncelle=$baglan->prepare("UPDATE urunler SET UrunResmi4=? WHERE id=? LIMIT 1");
                    $resim4_guncelle->execute([$resim4IcinyeniDosyaAdi,$GelenID]);
                    $resim4_kontrol=$resim4_guncelle->rowCount();
                    if ($resim4_kontrol<1) {                     
                     header("Location:index.php?SKD=0&SKI=101");
                     exit();
                  }
                     $resim4Yukle->clean();
                  } else {
                   header("Location:index.php?SKD=0&SKI=101");
                   exit();
                  }
             } 
            } // RESİM 4 KONTOL SONU
            
            $varyantler_sorgu=$baglan->prepare("SELECT * FROM urunvaryantlari WHERE UrunId=?");
            $varyantler_sorgu->execute([$GelenID]);
            $varyantler_sayi=$varyantler_sorgu->rowCount();
            $varyantler_bilgisi=$varyantler_sorgu->fetchAll();

            $varyantIsimDizisi=array();
            $varyantStokDizisi=array();

            foreach ($varyantler_bilgisi as $varyant) {
               $varyantIsimDizisi[]=$varyant["VaryantAdi"];
               $varyantStokDizisi[]=$varyant["StokAdedi"];
              }
//1. varyantı silemeyiz çünkü birinci varyant zorunludu o yuzde silme eklmeme yapmıyoruz sadece guncelleme
              if (array_key_exists(0, $varyantIsimDizisi)) {
                if (($GelenVaryantAdi!="") and ($GelenStokAdedi!="")) {//boss değilse gunncellicez
                  $varyant1_guncelle=$baglan->prepare("UPDATE urunvaryantlari SET VaryantAdi=?, StokAdedi=? WHERE UrunId=? AND VaryantAdi=? LIMIT 1");
                  $varyant1_guncelle->execute([$GelenVaryantAdi,$GelenStokAdedi,$GelenID,$varyantIsimDizisi[0]]); 
                }
              }
              //2. verynt varmı yokmu sordum varsa if in içinde gunceliycez yoksa else in içinde ekliycez
              if (array_key_exists(1, $varyantIsimDizisi)) { 
                if (($GelenVaryantAdi2!="") and ($GelenStokAdedi2!="")) {//boss değilse gunncellicez
                  $varyant2_guncelle=$baglan->prepare("UPDATE urunvaryantlari SET VaryantAdi=?, StokAdedi=? WHERE UrunId=? AND VaryantAdi=? LIMIT 1");
                  $varyant2_guncelle->execute([$GelenVaryantAdi2,$GelenStokAdedi2,$GelenID,$varyantIsimDizisi[1]]);
                  $varyant2_kontrol=$varyant2_guncelle->rowCount();                  
                }
                else{ //gelen varyant ve stok boşsa silicez yani guncelle ye bastım sutunlar bos o sutunları silicemozmn
                  $varyant2_sil=$baglan->prepare("DELETE FROM urunvaryantlari WHERE UrunId=? AND VaryantAdi=? LIMIT 1");
                  $varyant2_sil->execute([$GelenID,$varyantIsimDizisi[1]]);
                  $varyant2sil_kontrol=$varyant2_sil->rowCount();
                  if ($varyant2sil_kontrol<1) {//gunceleme olmadısa
                    header("Location:index.php?SKD=0&SKI=101");
                     exit();
                  }
                }
              }else{ // VARYANT VE STOK BOŞ ekleme yap
                if (($GelenVaryantAdi2!="") and ($GelenStokAdedi2!="")) {
                  $varyant2_ekle=$baglan->prepare("INSERT INTO urunvaryantlari (UrunId,VaryantAdi,StokAdedi) values (?,?,?)");
                  $varyant2_ekle->execute([$GelenID,$GelenVaryantAdi2,$GelenStokAdedi2]);
                  $varyant2ekle_kontrol=$varyant2_ekle->rowCount();
                  if ($varyant2ekle_kontrol<1) {//gunceleme olmadısa                    
                    header("Location:index.php?SKD=0&SKI=101");
                    exit();
                   }
                }
              }
            //3. varyant
             if (array_key_exists(2, $varyantIsimDizisi)) {//3. verynt varmı yokmu sordum varsa if in içinde gunceliycez yoksa else in içinde ekliycez 
                if (($GelenVaryantAdi3!="") and ($GelenStokAdedi3!="")) {//boss değilse gunncellicez
                  $varyant3_guncelle=$baglan->prepare("UPDATE urunvaryantlari SET VaryantAdi=?, StokAdedi=? WHERE UrunId=? AND VaryantAdi=? LIMIT 1");
                  $varyant3_guncelle->execute([$GelenVaryantAdi3,$GelenStokAdedi3,$GelenID,$varyantIsimDizisi[2]]);
                  $varyant3_kontrol=$varyant3_guncelle->rowCount();
                }else{ //gelen varyant ve stok boşsa silicez yani guncelle ye bastım sutunlar bos o sutunları silicemozmn
                  $varyant3_sil=$baglan->prepare("DELETE FROM urunvaryantlari WHERE UrunId=? AND VaryantAdi=? LIMIT 1");
                  $varyant3_sil->execute([$GelenID,$varyantIsimDizisi[2]]);
                  $varyant3sil_kontrol=$varyant3_sil->rowCount();
                  if ($varyant3sil_kontrol<1) {//gunceleme olmadısa
                    header("Location:index.php?SKD=0&SKI=101");
                     exit();
                  }
                }
              }
              else{ // varyn ve stok boş ekleme yap
                if (($GelenVaryantAdi3!="") and ($GelenStokAdedi3!="")) {
                  $varyant3_ekle=$baglan->prepare("INSERT INTO urunvaryantlari (UrunId,VaryantAdi,StokAdedi) values (?,?,?)");
                  $varyant3_ekle->execute([$GelenID,$GelenVaryantAdi3,$GelenStokAdedi3]);
                  $varyant3ekle_kontrol=$varyant3_ekle->rowCount();
                  if ($varyant3ekle_kontrol<1) {//gunceleme olmadısa
                    header("Location:index.php?SKD=0&SKI=101");
                    exit();
                   }
                }
            }
            //4. varyant
            if (array_key_exists(3, $varyantIsimDizisi)) {//4. verynt varmı yokmu sordum varsa if in içinde gunceliycez yoksa else in içinde ekliycez 
                if (($GelenVaryantAdi4!="") and ($GelenStokAdedi4!="")) {//boss değilse gunncellicez
                  $varyant4_guncelle=$baglan->prepare("UPDATE urunvaryantlari SET VaryantAdi=?, StokAdedi=? WHERE UrunId=? AND VaryantAdi=? LIMIT 1");
                  $varyant4_guncelle->execute([$GelenVaryantAdi4,$GelenStokAdedi4,$GelenID,$varyantIsimDizisi[3]]);
                  $varyant4_kontrol=$varyant4_guncelle->rowCount();
                }else{ //gelen varyant ve stok boşsa silicez yani guncelle ye bastım sutunlar bos o sutunları silicemozmn
                  $varyant4_sil=$baglan->prepare("DELETE FROM urunvaryantlari WHERE UrunId=? AND VaryantAdi=? LIMIT 1");
                  $varyant4_sil->execute([$GelenID,$varyantIsimDizisi[3]]);
                  $varyant4sil_kontrol=$varyant4_sil->rowCount();
                  if ($varyant4sil_kontrol<1) {//gunceleme olmadısa
                    header("Location:index.php?SKD=0&SKI=101");
                     exit();
                  }
                }
              }
              else{ //ekleme
                if (($GelenVaryantAdi4!="") and ($GelenStokAdedi4!="")) {
                  $varyant4_ekle=$baglan->prepare("INSERT INTO urunvaryantlari (UrunId,VaryantAdi,StokAdedi) values (?,?,?)");
                  $varyant4_ekle->execute([$GelenID,$GelenVaryantAdi4,$GelenStokAdedi4]);
                  $varyant4ekle_kontrol=$varyant4_ekle->rowCount();
                  if ($varyant4ekle_kontrol<1) {//gunceleme olmadısa
                    header("Location:index.php?SKD=0&SKI=101");
                    exit();
                   }
                }
            }
            //5. varyant
            if (array_key_exists(4, $varyantIsimDizisi)) {//5. verynt varmı yokmu sordum varsa if in içinde gunceliycez yoksa else in içinde ekliycez 
                if (($GelenVaryantAdi5!="") and ($GelenStokAdedi5!="")) {//boss değilse gunncellicez
                  $varyant5_guncelle=$baglan->prepare("UPDATE urunvaryantlari SET VaryantAdi=?, StokAdedi=? WHERE UrunId=? AND VaryantAdi=? LIMIT 1");
                  $varyant5_guncelle->execute([$GelenVaryantAdi5,$GelenStokAdedi5,$GelenID,$varyantIsimDizisi[4]]);
                  $varyant5_kontrol=$varyant5_guncelle->rowCount();
                }else{ //gelen varyant ve stok boşsa silicez yani guncelle ye bastım sutunlar bos o sutunları silicemozmn
                  $varyant5_sil=$baglan->prepare("DELETE FROM urunvaryantlari WHERE UrunId=? AND VaryantAdi=? LIMIT 1");
                  $varyant5_sil->execute([$GelenID,$varyantIsimDizisi[4]]);
                  $varyant5sil_kontrol=$varyant5_sil->rowCount();
                  if ($varyant5sil_kontrol<1) {//gunceleme olmadısa
                    header("Location:index.php?SKD=0&SKI=101");
                     exit();
                  }
                }
              }
              else{ //ekleme
                if (($GelenVaryantAdi5!="") and ($GelenStokAdedi5!="")) {
                  $varyant5_ekle=$baglan->prepare("INSERT INTO urunvaryantlari (UrunId,VaryantAdi,StokAdedi) values (?,?,?)");
                  $varyant5_ekle->execute([$GelenID,$GelenVaryantAdi4,$GelenStokAdedi4]);
                  $varyant5ekle_kontrol=$varyant5_ekle->rowCount();
                  if ($varyant5ekle_kontrol<1) {//gunceleme olmadısa
                    header("Location:index.php?SKD=0&SKI=101");
                    exit();
                   }
                }
            }
            header("Location:index.php?SKD=0&SKI=100");
            exit();

}else{
   header("Location:index.php?SKD=0&SKI=101");//ekle hata
   exit();
}
  
}else{
   header("Location:index.php?SKD=0&SKI=101");//ekle hata
   exit();
}
  
}else{
   header("Location:index.php?SKD=0&SKI=101");//ekle hata
   exit();
}

}else{
  header("Location:index.php?SKD=1");
  exit();
}

?>