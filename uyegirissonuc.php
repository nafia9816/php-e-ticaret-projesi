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
  $md5liSifre=md5($GelenSifre); //site haclenirse kimsenin şifresi görünmesin

//mutlaka dol olması gereken yerler
   if (($GelenSifre!="") and ($GelenMailAdresi!="")) {

      $kontrolSorgusu=$baglan->prepare("SELECT * FROM uyeler WHERE EmailAdres= ? AND  Sifre=? AND SilinmeDurumu=?"); 
      $kontrolSorgusu->execute([$GelenMailAdresi,$md5liSifre,0]);
      $kontrolSayisi=$kontrolSorgusu->rowCount();
      $kullaniciKaydi=$kontrolSorgusu->fetch(PDO::FETCH_ASSOC);

      if ($kontrolSayisi>0) {         
        if ($kullaniciKaydi["Durumu"] ==1 ) { //kullanıcıya aktivasyon işlemini yapmış demek
          $_SESSION["Kullanici"] =$GelenMailAdresi; //kullanıcı giri şyaptığı için sessionu hemen başlatıyoruz.
          if ($_SESSION["Kullanici"] == $GelenMailAdresi) {
             header("Location:index.php?sk=50");//hesabım uyekik bilgilerm
             exit();
          }else{
           header("Location:index.php?sk=33");//uyegırissonuchata
           exit();
          }
        }else{ //AKTİVASYONU YOKSA TEKRARDAN AKTİ. MAİLİ YOLLICAZ
          $MailIcerigiHazirla="Merhaba Sayın " .$kullaniciKaydi["IsimSoyisim"] . "<br> <br>" . " Sitemize yapmış olduğunuz üyelik kaydını tamamlamak için lütfen 
                  <a href='" . $siteLinki . "/aktivasyon.php?AktivasyonKodu=" . $kullaniciKaydı["AktivasyonKodu"] ."&Email=" .$kullaniciKaydı["EmailAdres"] . "'>BURAYA</a> 
                  tıklayınız. <br><br> Saygılarımızla, İyi Çalışışmalar. ". $adi;
           //kullanıcıya aktivasyon kodu gondercez.tekra eğer yoksa bunun iin phpmailerı dahil edicem saygfay
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
                       $mail->addAddress(DonusumleriGeriDondur($kullaniciKaydı["EmailAdres"]), DonusumleriGeriDondur($kullaniciKaydı["IsimSoyisim"]));
                       $mail->addReplyTo(DonusumleriGeriDondur($email),DonusumleriGeriDondur($adi));
                       $mail->isHTML(true); 
                       $mail->Subject = DonusumleriGeriDondur($adi)."Yeni Üyelik Aktivasyonu";
                       $mail ->MsgHTML($MailIcerigiHazirla);    
                       $mail->send();//maili gönderir


                       header("Location:index.php?sk=36");//aktıvasyonunuz aktif edin  sayfasına yolladık
                       exit(); 
                     }catch(Exception $e){
                       header("Location:index.php?sk=33");//uyegirishata
                       exit(); 
                     }
        }
    }else{
        header("Location:index.php?sk=34");
        exit(); 
    }

    }else{ 
      	header("Location:index.php?sk=35");
      	exit();
    }

?>