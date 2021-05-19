<?php

   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;

   require 'frameworks/PHPMailer/src/Exception.php';
   require 'frameworks/PHPMailer/src/PHPMailer.php';
   require 'frameworks/PHPMailer/src/SMTP.php';

   



   if (isset($_POST["IsimSoyisim"])) {
   	 $GelenIsimSoyisim=guvenlik($_POST["IsimSoyisim"]);
   }else{
   	 $GelenIsimSoyisim="";
   }

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
 
  

   if (isset($_POST["mesaj"])) {
   	 $GelenMesaj=guvenlik($_POST["mesaj"]);
   }else{
   	 $GelenMesaj="";
   }


//mutlaka dol olması gereken yerler
if (($GelenIsimSoyisim!="") and ($GelenMailAdresi!="") and ($GelenTelefonNum!="") and ($GelenMesaj!="")) {
      
      $mail = new PHPMailer(true);

      try {

          $mail->SMTPDebug =0;// olası hatalarda çıktıları verir. 0 : detaylı vermez   2 : detaylı verir.

          $mail->isSMTP();        // maili smtp ile mi gönder dedik.

          $mail->Host       = 'smtp.gmail.com';  //kullandığımız mail sunucusunun adresi 
    /*
    kendi domainimizden/sunucumuzdan gönderiyorsak "mail.domainadı"" yazarız mesela "mail.extraegitin.net" gibi yani kendi sunucumuzun uzantısı ile göndereceksek bu şekilde yazarız.

    ya da mesela yaho yada başka bir şey kullanıyorsak onun smtp adresini yazarız bunu  da netten buluruz. biz gmail kullancaz.
    O yüzdende gmailn smtp adresi olan 'smtp.gmail.com' i yazdık.
    */

           $mail->SMTPAuth   = true; 

           $mail->CharSet="UTF-8"; //türkçe karakterde pp yasamammak için

           $mail->Username   = DonusumleriGeriDondur($email);      // SMTP username
           $mail->Password   = DonusumleriGeriDondur($sifre);                   // SMTP password/db deki veriyi ayarlar.php ye cektık oradanda aldıık burada kullandık.
           $mail->SMTPSecure = 'tls';         
           $mail->Port       = 587;  
    /* 
    smtp nin tls sınımı kullancan yoksa ssl ininmi? 
    ssl kullancaksan 465 yazarsın port numarasına. tüm bunları bize hosting/sunucu firması veriyor
    */

    /*
      Bazı sunucu firmaları bu smtp sınıfını kullanırken smtp doğrulaması soruyor. (ben localhostta yaptığım için bunu yazmasamda hata vermedi) Bu doğrulamayı da aşağıdaki dizi sayesinde yaparız.
    */
         $mail->SMTPOptions = array(
                               'ssl' => array(
                               'verify_peer' => false,
                               'verify_peer_name' =>false,
                               'allow_self_signed' => true
                               
                                     )
                          );



    //kullanıcı bizim formumuz aracılığıyla bize mail gönderecek. ona göre burayı düzenlicem.
    //gönderici ayarları(kime göndercem)

    $mail->setFrom(DonusumleriGeriDondur($email),DonusumleriGeriDondur($adi));//kimden  ve hangi kullanıcı adıyla gönderiliyor (sitenin mail adresi ve sitenin adı)  bizim sitemizden iletişim formu doldurulup mesajı bize atacaklar

    $mail->addAddress(DonusumleriGeriDondur($email), DonusumleriGeriDondur($adi));//kime hangi adla gitsin (bizim siteden doldurulan form yine bize gelecek)
    /*
    $mail->addAddress('ellen@example.com');
    birden fazla kişye göndereceksen alt alta addadress şeklnde eklenir
    */

    $mail->addReplyTo($GelenMailAdresi, $GelenIsimSoyisim);
    //gelen maile tıkladığınızda yanıtla diyince kime göndereceğiniz olan mail adresidir. yani size kim mail attıysa ona:) 
    //genelde gönderen kişiye geri cevap veririsniz ama bn buraya farklı bir mail de yazabilirim. Mesela şikayet maili geldiyse 3.numaralı çalışanın mailine gitsin gibi zamanlarda kullanılır. :)
    //iletişim formunu dolduran kişiye sitemiz dönüt verir.alıcı formu doldurandır.


    // Content-Mesajın İçeriği
    $mail->isHTML(true); //gönderim türümüz burda belirtilir. gönderimin html içerebilir demiş oldum.
    $mail->Subject = DonusumleriGeriDondur($adi) . "İletişim formu mesajı";//mailin konusu
    $mail ->MsgHTML($GelenMesaj); //body de kullanılabilir
    
  /*  
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients'; 
    // burasıda mailin gövdesi/içeriği . fakat sunucu html maili i okuyamıyorsa  bunun sayesinde düz metin halinde maili okuyabilsinv diye bu kısım yazılır
    */
  
    $mail->send();//maili gönderir

   

    header("Location:index.php?sk=18");
    exit();
    
   }catch (Exception $e) {

      header("Location:index.php?sk=19");
      exit();
   }
}
else{
      	header("Location:index.php?sk=20");
      	exit();
}



   
   
   
   



?>