<?php
  
  session_start();  ob_start(); //siteye giren kullanıcıyı tanıyabilmek için

  require_once("../ayarlar/ayarlar.php");//yonetim paneli sayfasından once bi geri gidip ayarlara oyle ulaşcaz
  require_once("../ayarlar/fonksiyonlar.php");
  require_once("../frameworks/Verot/src/class.upload.php");
  require_once("../ayarlar/yonetimsayfalaridis.php");
  require_once("../ayarlar/yonetimsayfalariic.php");

  if (isset($_REQUEST["SKI"])) {
    $icsayfakoduDegeri=sayiliIcerikleriFiltrele($_REQUEST["SKI"]);
  }else{
    $icsayfakoduDegeri=0;
  }

  if (isset($_REQUEST["SKD"])) {
    $dissayfakoduDegeri=sayiliIcerikleriFiltrele($_REQUEST["SKD"]);
  }else{
    $dissayfakoduDegeri=0;
  }

  if (isset($_REQUEST["SYF"])) {
     $sayfalama=sayiliIcerikleriFiltrele($_REQUEST["SYF"]);
  }else{
    $sayfalama=1;
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $baslik; ?></title>
    <link rel="icon" type="image/jpg" href="img/logo.jpg"> <!--favicon ekledik-->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- sayfa arşivlenemez içindeki linkler takip edilebilir ve indexlennebilir -->
    <meta name="robots" content="index, follow,noarchive">
    <meta name="revisit-after" content="7 Days"><!-- sayfamı botlar 7 günde bir ziyaret etsin-->
    <meta name="rating" content="general"><!-- sayfam tüm kitleller hitap edilebilir.--> 
    <meta name="reply-to" content="tasdemirnafia98@gmail.com">
    <!-- site sahibine bu adresten erişebilirsiniz.-->
    <meta name="author" content="Nafia Taşdemir-NACOFF"><!-- YAZAR-->
    <meta name="generator" content="Sublime Text"><!-- isteyi yazarken kullanılan editor -->
    <meta name="description" content="<?php echo DonusumleriGeriDondur($aciklama); ?>">
    <meta name="keywords" content="<?php echo DonusumleriGeriDondur($keywordss); ?>">
    <link rel="icon" type="image/jpg" href="../img/favicon.png">

    <script type="text/javascript" src="../frameworks/jquery/jquery-3.5.1.min.js" language="javascript"></script>
    <script type="text/javascript" src="../ayarlar/fonksiyonlar.js" language="javascript"></script>

    <!-- Bootstrap -->
    <link href="..\frameworks\bootstrap\bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
 
    <!-- Custom Theme Style -->
    <link href="..\frameworks\custom\custom.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../ayarlar/styleyonetim.css"> 
    
  </head>

  <body>   
    <?php
    if (empty($_SESSION["Yonetici"])) { //yonetici varsa yoksa issetle aynı işi yapar. burada giriş yoksa çalışır
        if((!$dissayfakoduDegeri) or ($dissayfakoduDegeri=="") or ($dissayfakoduDegeri==0)){ //dış sayfa kodu değeri yoksa
                    
          include($sayfadis[1]); //yonetici giriş sayfasıne gitsin
        }else{ //yine girş yoksa sayfa değeri neyse onu göster
          include($sayfadis[$dissayfakoduDegeri]);   
        }

  
      }else{ //giriş varsa çalışır.
        if((!$dissayfakoduDegeri) or ($dissayfakoduDegeri=="") or ($dissayfakoduDegeri==0)){ //dış sayfa kodu değeri yoksa
              include($sayfadis[0]); //anasayfaya
        }else{
              include($sayfadis[$dissayfakoduDegeri]);   
        }
      }


         ?>




    
        <footer>
          <div class="pull-right">
            <?php echo $copyMetni; ?>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->

  <!-- jQuery -->
    <script src="..\frameworks\jquery\jquery-3.5.1.min.js"></script><!-- meulere tılaynınca alt menulerini açıyır -->
    <!-- Bootstrap -->
    <script src="..\frameworks\jquery\bootstrap.min.js"></script><!--  sağ tarafta giren yönetivi adına basınca çıkan menu yu cıkarıyor-->
    <!-- Custom Theme Scripts -->
    <script src="..\frameworks\jquery\custom.min.js"></script> <!-- footer yazısıın üste çıkmasını engelliyor -->
  <!-- bu scriptleri yukarı koysum head ın içine menuler vb. çalışmadı-->


  
  </body>

<?php

  $baglan=null;
  ob_end_flush();


?>