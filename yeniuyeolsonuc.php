<?php
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;
   require 'frameworks/PHPMailer/src/Exception.php';
   require 'frameworks/PHPMailer/src/PHPMailer.php';
   require 'frameworks/PHPMailer/src/SMTP.php';

   if (isset($_POST["MailAdresi"])) {
       $GelenMailAdresi=guvenlik($_POST["MailAdresi"]);
   }else{
       $GelenMailAdresi="";
   }
   if (isset($_POST["Sifre"])) {
       $GelenSifre=guvenlik($_POST["Sifre"]);
   }else{
       $GelenSifre="";
   }
   if (isset($_POST["SifreTekrar"])) { //form daki name ler
       $GelenSifreTekrar=guvenlik($_POST["SifreTekrar"]);
   }else{
       $GelenSifreTekrar="";
   }
   if (isset($_POST["IsimSoyisim"])) {
   	 $GelenIsimSoyisim=guvenlik($_POST["IsimSoyisim"]);
   }else{
   	 $GelenIsimSoyisim="";
   }
   if (isset($_POST["telefonNum"])) {
   	 $GelenTelefonNum=guvenlik($_POST["telefonNum"]);
   }else{
   	 $GelenTelefonNum="";
   }
   if (isset($_POST["Cinsiyet"])) {
   	 $GelenCinsiyet=guvenlik($_POST["Cinsiyet"]);
   }else{
   	 $GelenCinsiyet="";
   }
   if (isset($_POST["SozlesmeOnay"])) {
       $GelenSozlesmeOnay=guvenlik($_POST["SozlesmeOnay"]);
   }else{
       $GelenSozlesmeOnay="";
   }

   $AktivasyonKodu=AktivasyonKoduUret(); //bu sayfa her çalıştığında yani kullanıcı formu doldurup butona tıkladığı anda bu sayfaya gelcek ve o anda o kullanıcı için bir kod üretilmiş olacak.
   
   $md5liSifre=md5($GelenSifre); //site haclenirse kimsenin şifresi görünmesin

//mutlaka dol olması gereken yerler
   if (($GelenIsimSoyisim!="") and ($GelenSifre!="") and ($GelenSifreTekrar!="") and ($GelenMailAdresi!="") and ($GelenTelefonNum!="") and ($GelenSozlesmeOnay!="")) {
      
      if ($GelenSozlesmeOnay==0) { //vlaue sine 1 vermiştim. sözleşmeyi onayladıysa buraya 1 gelironaylamadıysa 0 gelir
         header("Location:index.php?sk=29");
         exit();    
      }else{  //sözleşme onay yerini tık yaptıysa
         if ($GelenSifre!=$GelenSifreTekrar) { //şifreler uyşmuyrsa
            header("Location:index.php?sk=28");
            exit(); 
         }else{
             $kontrolSorgusu=$baglan->prepare("SELECT * FROM uyeler WHERE EmailAdres= ?"); //kullanıcının yazdığı email adresi başka bir kullanıcıya aitmi onu kontrol ederiz
             $kontrolSorgusu->execute([$GelenMailAdresi]);
             $kontrolSayisi=$kontrolSorgusu->rowCount();
             if ($kontrolSayisi>0) { //bu maili kullanan biri var tekrarlana alan sayfasına yönlendirdik
                 header("Location:index.php?sk=27");//tekrarlanan
                 exit(); 
             }else{ //artık kontroller bitti artık kullanıcı ya uye olcak ya da uyelik esnasında hata oluşacak
               $UyeEklemeSorgusu=$baglan->prepare("INSERT INTO uyeler (EmailAdres,Sifre, IsimSoyisim, TelefonNumara, Cinsiyet, Durumu, KayitTarihi, KayitIpAdresi, AktivasyonKodu) values(?, ?, ?, ?, ?, ?, ?, ?, ?)"); 
               //durumu değişknei uyenin uye aktivasyonu gerçekleştimi diye
               $UyeEklemeSorgusu->execute([$GelenMailAdresi, $md5liSifre,$GelenIsimSoyisim, $GelenTelefonNum, $GelenCinsiyet, 0, $zaman_damgasi, $ipAdresi, $AktivasyonKodu]);
               $kayitkontrol=$UyeEklemeSorgusu->rowCount();
               if ($kayitkontrol>0) {

                  $MailIcerigiHazirla="Merhaba Sayın " . $GelenIsimSoyisim . "<br> <br> Sitemize yapmış olduğunuz üyelik kaydını tamamlamak için lütfen <a href='" . $SiteLinki . "/aktivasyon.php?AktivasyonKodu=" .$AktivasyonKodu ."&Email=" . $GelenMailAdresi . "'> BURAYA</a> tıklayınız <br> <br> Saygılarımla, İyi Günler " . $adi;
                  
                  //kullanıcıya aktivasyon  maili gondercez. bunun için phpmailerı dahil edicem saygfaya
                   $mail = new PHPMailer(true);
                   try {
                       $mail->SMTPDebug =0;
                       $mail->isSMTP();
                       $mail->Host       = 'smtp.gmail.com';
                       $mail->SMTPAuth   = true; 
                       $mail->CharSet="UTF-8";
                       $mail->Username   = DonusumleriGeriDondur($email); 
                       $mail->Password   = DonusumleriGeriDondur($sifre);
                       $mail->SMTPSecure = 'tls';         
                       $mail->Port       = 587;  
                       $mail->SMTPOptions = array(
                               'ssl' => array(
                               'verify_peer' => false,
                               'verify_peer_name' =>false,
                               'allow_self_signed' => true
                                             )
                                                 );

                       $mail->setFrom(DonusumleriGeriDondur($email), DonusumleriGeriDondur($adi));
                       $mail->addAddress(DonusumleriGeriDondur($GelenMailAdresi), DonusumleriGeriDondur($GelenIsimSoyisim));
                       $mail->addReplyTo(DonusumleriGeriDondur($email),DonusumleriGeriDondur($adi));
                       $mail->isHTML(true); 
                       $mail->Subject = DonusumleriGeriDondur($adi)."Yeni Üyelik Aktivasyonu";
                       $mail ->MsgHTML($MailIcerigiHazirla);    
                       $mail->send();//maili gönderir
                       header("Location:index.php?sk=24");
                       exit(); 
                     }catch(Exception $e){
                       header("Location:index.php?sk=25");
                       exit(); 

                     }

               }else{ //if ($kayitkontrol>0) kapması üue eklenmişmi onu kontrol eden blok
                  header("Location:index.php?sk=25");
                  exit(); 
               }

             }//emaili kullanın else in kapaması
          } // şifreler uyuşmuyorsa kapaması 
        } //if ($GelenSozlesmeOnay==0) kapaması en baş

      

   }else{ //kullanıcı herhangi bir zorunlu alanı doldurmadıysa eksik biligi sayfasına yönlendirilecek
      	header("Location:index.php?sk=26");
      	exit();

   }
?>