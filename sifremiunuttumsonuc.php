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

   if (isset($_POST["telefonNum"])) {
       $GelenTelefonNum=guvenlik($_POST["telefonNum"]);
   }else{
       $GelenTelefonNum="";
   }

   if (($GelenMailAdresi!="") OR ($GelenTelefonNum=!"")) {
      $kontrolSorgusu=$baglan->prepare("SELECT * FROM uyeler WHERE EmailAdres= ? OR TelefonNumara=? AND SilinmeDurumu=?"); 
      $kontrolSorgusu->execute([$GelenMailAdresi,$GelenTelefonNum,0]);
      $kontrolSayisi=$kontrolSorgusu->rowCount();
      $kullaniciKaydi=$kontrolSorgusu->fetch(PDO::FETCH_ASSOC);

      if ($kontrolSayisi>0) {
        $MailIcerigiHazirla="Merhaba Sayın " .$kullaniciKaydi["IsimSoyisim"] . "<br> <br>" . " Sitemiz üzerinde bulunan hesabımızın şifresini sıfırlamak için lütfen
                  <a href='" . $SiteLinki . "/index.php?sk=43&AktivasyonKodu=" . $kullaniciKaydi["AktivasyonKodu"] ."&Email=" .$kullaniciKaydi["EmailAdres"] . "'>BURAYA</a> 
                  tıklayınız. <br><br> Saygılarımızla, İyi Çalışışmalar. ". $adi;


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
                               'ssl' => [
                               'verify_peer' => false,
                               'verify_peer_name' =>false,
                               'allow_self_signed' => true
                               ],
                        );
                       $mail->setFrom(DonusumleriGeriDondur($email),DonusumleriGeriDondur($adi));
                       $mail->addAddress(DonusumleriGeriDondur($kullaniciKaydi["EmailAdres"]), DonusumleriGeriDondur($kullaniciKaydi["IsimSoyisim"]));
                       $mail->addReplyTo(DonusumleriGeriDondur($email),DonusumleriGeriDondur($adi));
                       $mail->isHTML(true); 
                       $mail->Subject = DonusumleriGeriDondur($adi)."Şifre Sıfırlama";
                       $mail ->MsgHTML($MailIcerigiHazirla);    
                       $mail->send();//maili gönderir


                       header("Location:index.php?sk=39");//tmm
                       exit(); 
                     }catch(Exception $e){
                       header("Location:index.php?sk=40");//hata mail gonderilmedi
                       exit(); 

                     }
      
      }
      else{
         header("Location:index.php?sk=41");//"sifremiunuttumsonucyanlisbilgi.php";
         exit();
      }
   }else{
     header("Location:index.php?sk=42");//sifremiunuttumsonuceksikalan.php";
     exit();
   }
?>