 <!--bu dosyada sitenin her sayfasında kullanacağımız şeyleri tanımlarız-->
<?php
   
  try{
  	$baglan=new PDO("mysql:host=localhost;dbname=eti̇caret;charset=utf8","root","");  	
  }catch(PDOException $hata){
  	echo "bağlantı hatası: ".$hata->getMessage();//  bu alanı kaptın çünkü site hata yaparsa kullanıcılar hata değerini görmesin
  	die();
  }

  $ayarSorgusu=$baglan->prepare("SELECT * FROM ayarlar LIMIT 1");// neden limit 1: bu tabloda tek satır olması gerek. 2. satır yanlışlıkla eklenirse hiç bir zaman o 2. kayda geçmesin
  $ayarSorgusu->execute();
  $ayar_kayit_sayisi=$ayarSorgusu->rowCount(); //kayıt varmı
  $ayar_kayitlari=$ayarSorgusu->fetch(PDO::FETCH_ASSOC); //bir tane kaydımız var onu ayar_kayitlari dizisine çektim veritabanından

  if ($ayar_kayit_sayisi>0) {
  	$adi=$ayar_kayitlari["SiteAdi"];
  	$baslik=$ayar_kayitlari["SiteTitle"];
    $SiteLinki=$ayar_kayitlari["SiteLinki"];
  	$aciklama=$ayar_kayitlari["SiteDescription"];
  	$keywordss=$ayar_kayitlari["SiteKeywords"];
  	$copyMetni=$ayar_kayitlari["SiteCopyRightMetni"];
  	$logo=$ayar_kayitlari["SiteLogo"];
  	$email=$ayar_kayitlari["SiteMail"];
  	$sifre=$ayar_kayitlari["SiteMailSifre"];
    $hostAdresi=$ayar_kayitlari["SiteHostAdresi"]; 
    $face=$ayar_kayitlari["sosyal_link_face"];
    $twit=$ayar_kayitlari["sosyal_link_twit"];
    $linkedin=$ayar_kayitlari["sosyal_link_linked"];
    $instagram=$ayar_kayitlari["sosyal_link_ins"];
    $pinterest=$ayar_kayitlari["sosyal_link_pint"];
    $youtube=$ayar_kayitlari["sosyal_link_you"];
    $dolarKuru=$ayar_kayitlari["UsdKuru"];
    $EuroKuru=$ayar_kayitlari["EuroKuru"];
    $ucretsizKargo=$ayar_kayitlari["UcretsizKargoBaraji"];
    $ClientID=$ayar_kayitlari["ClientID"];
    $StoreKey=$ayar_kayitlari["StoreKey"];
    $ApiKulanicisi=$ayar_kayitlari["ApiKullanicisi"];
    $ApiSifre=$ayar_kayitlari["ApiSifresi"];
  }else{
  //	echo "hata var"; //hata olsada kullanıcıya gösterilmesin
  	die();
  }


//sozlesmelervemetinler  tablosundan verileri çekmek için
  $metinlerSorgusu=$baglan->prepare("SELECT * FROM sozlesmelervemetinler LIMIT 1");
  $metinlerSorgusu->execute();

  $metinler_kayit_sayisi=$metinlerSorgusu->rowCount(); //kayıt varmı

  $metinler_kayitlari=$metinlerSorgusu->fetch(PDO::FETCH_ASSOC); 

  if ($metinler_kayit_sayisi>0) {
    $hakkimizdaM=$metinler_kayitlari["hakkimizdaMetni"];
    $uyelikSozM=$metinler_kayitlari["uyelikSozMetni"];
    $kullanımKosullariM=$metinler_kayitlari["kullanımKosullariMetni"];
    $gizlilikSozM=$metinler_kayitlari["gizlilikSozMetni"];
    $mesafeliSatisM=$metinler_kayitlari["mesafeliSatisMetni"];
    $teslimatM=$metinler_kayitlari["teslimatMetni"];
    $iptalIadeDegisimM=$metinler_kayitlari["iptalIadeDegisimMetni"];

  }else{
  //  echo "hata var"; //hata olsada kullanıcıya gösterilmesin
    die();
  }

//kullanıcı sorgusu yapıyoruz. 
  if (isset($_SESSION["Kullanici"])) {  //kullanıcı varsa/girş yapmışsa
   
   $kullaniciSorgusu=$baglan->prepare("SELECT * FROM uyeler WHERE EmailAdres= ?  LIMIT 1");
   //siteye giren kullanıcı ya emaili üzerinden bir oturum/sesion başlattım. oturum değeri emaile eşit olacak ve bu sayede de yakalamış olacak
   $kullaniciSorgusu->execute([$_SESSION["Kullanici"]]);
   $kullanici_kayit_sayisi=$kullaniciSorgusu->rowCount(); //kayıt varmı
   $kullanici_kayitlari=$kullaniciSorgusu->fetch(PDO::FETCH_ASSOC); 

  if ($kullanici_kayit_sayisi>0) { //veritabanından bilgileri çektik.
    $KullaniciId=$kullanici_kayitlari["id"];
    $KullaniciEmail=$kullanici_kayitlari["EmailAdres"];
    $KullaniciSifre=$kullanici_kayitlari["Sifre"]; 
    $KullaniciIsimSoyisim=$kullanici_kayitlari["IsimSoyisim"];
    $KullaniciNumara=$kullanici_kayitlari["TelefonNumara"];
    $KullaniciCinsiyet=$kullanici_kayitlari["Cinsiyet"];
    $KullaniciDurumu=$kullanici_kayitlari["Durumu"];
    $KullaniciKayitTarihi=$kullanici_kayitlari["KayitTarihi"];
    $KullaniciKayitIpAdresi=$kullanici_kayitlari["KayitIpAdresi"];
    $AktivasyonKodu=$kullanici_kayitlari["AktivasyonKodu"];
    $gelenEmailHaberDurumu=$kullanici_kayitlari["EmailIleHaberAl"];
    $gelenSMSHaberDurumu=$kullanici_kayitlari["smsIleHaberAl"];

  }else{
  //  echo "hata var"; //hata olsada kullanıcıya gösterilmesin
    die();
  }
  }

  //yonetici sorgusu yapıyoruz. 
  if (isset($_SESSION["Yonetici"])) {  //kullanıcı varsa/girş yapmışsa  
   $Yonetici_Sorgusu=$baglan->prepare("SELECT * FROM yoneticiler WHERE KullaniciAdi= ?   LIMIT 1");
   //siteye giren yonetic ya emaili üzerinden bir oturum/sesion başlattım. oturum değeri emaile eşit olacak ve bu sayede de yakalamış olacak
   $Yonetici_Sorgusu->execute([$_SESSION["Yonetici"]]);
   $yonetici_kayit_sayisi=$Yonetici_Sorgusu->rowCount(); //kayıt varmı
   $yonetici_kayitlari=$Yonetici_Sorgusu->fetch(PDO::FETCH_ASSOC); 

   if ($yonetici_kayit_sayisi>0) { //veritabanından bilgileri çektik.
    $YoneticiId=$yonetici_kayitlari["id"];
    $YoneticiKullaniciAdi=$yonetici_kayitlari["KullaniciAdi"];
    $YoneticiSifre=$yonetici_kayitlari["Sifre"]; 
    $YoneticiIsimSoyisim=$yonetici_kayitlari["IsimSoyisim"];
    $YoneticiTelefonNumarasi=$yonetici_kayitlari["TelefonNumarasi"];
    $YoneticiEmailAdres=$yonetici_kayitlari["EmailAdres"];
    

  }else{
  //  echo "hata var"; //hata olsada kullanıcıya gösterilmesin
    die();
  }
}
















?>