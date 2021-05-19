<?php
//site çalışırken bize her daim yarayacak fonksiyonları burada tanımlıycam

  //1 - bize site çalışırken her daim ip adresi gerek
  $ipAdresi=$_SERVER["REMOTE_ADDR"];

  // 2 BİZE HER ZAMAN ZAMAN DAMGASI VE TARİH SAAT GEREKLİ
  $zaman_damgasi=time();
  $tarih_saat=date("d.m.y H:i:s", $zaman_damgasi);
  $site_kokDizini=$_SERVER["DOCUMENT_ROOT"]; //SUNUCUDA ÇALIŞMAZ DİYE BU KOMUT DEĞİŞKENE ATADIM
  //bunun cıktısı: C:/xampp/htdocs dir yani root dizinimizin adi

  $resimKlasorYolu="/NACOFF/img/";//siz kendi local hostunuza göre veya internet üzerindeki alanınıza göre değiştiriniz
  $verot_icin_klasorYolu=$site_kokDizini . $resimKlasorYolu;

  function tarihBul($deger){
    $cevir=date("d.m.y H:i:s", $deger);
    $sonuc=$cevir;
    return  $sonuc;
  }

  function UcGunIleriTarihBul(){
    global $zaman_damgasi;
    $birgun=86400;
    $hesapla=$zaman_damgasi+(3* $birgun);
    $cevir=date("d.m.Y",$hesapla);
    $sonuc=$cevir;
    return $sonuc;
  }

  function guvenlik($deger){
  	$bosluk_sil=trim($deger);
  	$taglari_clean=strip_tags($bosluk_sil);
  	$tirnak_etkisiz_yap=htmlspecialchars($taglari_clean, ENT_QUOTES);
  	$sonuc=$tirnak_etkisiz_yap;
  	return $sonuc;
  }

  function RakamHaricTumKarakterleriSil($deger3){
     $islem=preg_replace("/[^0-9]/", "", $deger3);
     $sonuc=$islem;
     return $sonuc;
  }

  function sayiliIcerikleriFiltrele($deger2){
    $i1=trim($deger2);
    $i2=strip_tags($i1);
    $i3=htmlspecialchars($i2);
    $temizle=RakamHaricTumKarakterleriSil($i3);
    $sonuc=$temizle;
    return $sonuc;

  }
  
  function TumBosluklariSil($deger){
    $islem=preg_replace("/\s|&nbsp/", "", $deger);/* ıban da gelecek boslujkları silsin diye \s ve nbsp boşluk demek*/
    return $islem;
  }

  function IbanBicimlendir($deger){
      $boslukSil=trim($deger);/*gelen iban içeriğinin başında ve sonundaki boşlukları sil*/
      $TumBosluklarSil=($boslukSil);/* bunun sayesindede içeriğin aralarında olan boşlukları sildik*/
      $birinciBlok=substr($TumBosluklarSil, 0, 4);/*iban içeriğinde boşlujklardan arınmıs olan içerikten ilk dört karakterini al*/
      $ikinciBlok=substr($TumBosluklarSil, 4, 4);
      $ucuncuBlok=substr($TumBosluklarSil, 8, 4);/*8 den basla 4 tane karakter al*/
      $dorduncuBlok=substr($TumBosluklarSil, 12, 4);
      $besinciBlok=substr($TumBosluklarSil, 16, 4);
      $altinciBlok=substr($TumBosluklarSil, 20, 4);
      $yedinciBlok=substr($TumBosluklarSil, 24, 2);/*toplam 26 karakter*/
      $duzenle=$birinciBlok . " " . $ikinciBlok . " " . $ucuncuBlok . " " . $dorduncuBlok . " " . $besinciBlok . " " . $altinciBlok . " " . $yedinciBlok;
      $sonuc=$duzenle;
      return $sonuc;
  }

//veritabanına bazı değerleri geri döndürürken mesela description gibi onları tekrar  eski haline döndürüp kaydedelim
  function  DonusumleriGeriDondur($deger3){
    $geridondur=htmlspecialchars_decode($deger3, ENT_QUOTES);
    $sonuc=$geridondur;
    return $sonuc;

  }

  function AktivasyonKoduUret(){
    $ilkBesli= rand(10000, 99999);
    $ikinciBesli=rand(10000, 99999);
    $ucuncuBesli=rand(10000, 99999);

    $kod=$ilkBesli . "-" . $ikinciBesli. "-" . $ucuncuBesli;
    $sonuc=$kod;
    return $sonuc;
  }

  function fiyatBicimlendir($deger){
    $bicimlendir=number_format($deger,"2",",",".");
    $sonuc=$bicimlendir;
    return $sonuc;
  }

  function resimAdiOlustur(){
    $sonuc= substr(md5(uniqid(time())), 0,25);
    //milyarlarca farkı resim ismi oluşturabiliirz. 
    return $sonuc;
  }

  function SEO($deger){
    $Icerik=trim($deger);
    $Degisecekler=array("ç","Ç","ğ","Ğ","ı","İ","ö","Ö","ş","Ş","ü","Ü");
    $Degisenler=array("c","c","g","i","o","o","s","s","u","u");
    $Icerik=str_replace($Degisecekler, $Degisenler, $Icerik);
    $Icerik=mb_strtolower($Icerik,"UTF-8");
    $Icerik=preg_replace("/[^a-z0-9.]/", "-", $Icerik);
    $Icerik=preg_replace("/-+/", "-", $Icerik);
    $Icerik=trim($Icerik,"-");
  }

  


?>