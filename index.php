<?php
  
  session_start();  ob_start(); //siteye giren kullanıcıyı tanıyabilmek için

  require_once("ayarlar/ayarlar.php");
  require_once("ayarlar/fonksiyonlar.php");
  require_once("ayarlar/sitesayfalari.php");


  if (isset($_REQUEST["sk"])) {
    $sayfakoduDegeri=sayiliIcerikleriFiltrele($_REQUEST["sk"]);
  }else{
    $sayfakoduDegeri=0;
  }

  if (isset($_REQUEST["SYF"])) {
     $sayfalama=sayiliIcerikleriFiltrele($_REQUEST["SYF"]);
  }else{
    $sayfalama=1;
  }


?>

<!DOCTYPE html>
<html lang="tr-TR">
<head>
	<meta charset="utf-8">
	<title><?php echo $baslik; ?></title><!-- kısa kullanımı da yazabiliriz ama bazı browser lar kısa yazım şekillerine kapalı oluyor. bunun önüne geçmek için-->
  <link rel="icon" type="image/jpg" href="img/favicon.png"> <!--favicon ekledik-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <!-- sayfa arşivlenemez içindeki linkler takip edilebilir(arama motoru site içindeki url leri takip etsin) ve indexlennebilir -->
  <meta name="robots" content="index, follow,noarchive">
  <meta name="revisit-after" content="7 Days"><!-- sayfamı botlar 7 günde bir ziyaret etsin çünkü yönetici bu sayfayı 7 günde bir güncelliyor.
mesela diyebilirizki ben siteyi her gün güncelliyormuş gibi yapayım kullanıcı da her gün ziyaret etsin güncelleme,yenilik varmı diye ama bu zararlı olur çünkü eğerki hergun sitede değişiklik,güncelleme olmuyorsa bu - bir durum kullanıcı - puan verebilir bunu farkederse -->
  <meta name="rating" content="general"><!-- sayfam tüm kitleller hitap edilebilir.-->

  <meta name="reply-to" content="tasdemirnafia98@gmail.com">
  <!-- site sahibine bu adresten erişebilirsiniz.-->
  <meta name="author" content="Nafia Taşdemir-NACOFF"><!-- YAZAR-->
  <meta name="generator" content="Sublime Text"><!-- isteyi yazarken kullanılan editor -->


	<meta name="description" content="<?php echo DonusumleriGeriDondur($aciklama); ?>">
	<meta name="keywords" content="<?php echo DonusumleriGeriDondur($keywordss); ?>">

	<script type="text/javascript" src="frameworks/jquery/jquery-3.5.1.min.js" language="javascript"></script>
  <!-- jquery.js=  min.js in sıkıştırılmış halidir.-->

	<script type="text/javascript" src="ayarlar/fonksiyonlar.js" language="javascript"></script>

	<link rel="stylesheet" type="text/css" href="ayarlar/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


</head>
<body>
  <div id="TumSayfaAlani">
    <header>
      <div id="HeaderAlani">
        <div id="HeaderMesajAlani">
          <img id="headerMesajResmi1" src="img\kargo-bedava1025x93.png" border="0">
          <img id="headerMesajResmi2" src="img\kargo-bedava976x94.png" border="0">
          <img id="headerMesajResmi3" src="img\kargo-bedava734x83.png" border="0">
          <img id="headerMesajResmi4" src="img\kargo-bedava506x83.png" border="0">
          <img id="headerMesajResmi5" src="img\kargo-bedava480x73.png" border="0">
        </div>

        <div id="HeaderMenuAlani">
          <div id="HeaderMenuUstuAlani">
            <div id="HeaderMenuUstuSinirlamaAlani">
              <ul id="HeaderMenuUstuSeceneklerAlani">  
              <?php  //kullnıcı varsa burası banner da görüncek
                if (isset($_SESSION["Kullanici"])) 
                {
               ?>    
                <li class="HeaderMenuUstuSecenekler">
                  <a href="index.php?31"><img src="img/uyegiris.png"></a>
                </li>
                <li class="HeaderMenuUstuSecenekler">
                  <a href="index.php?sk=50"><p>Hesabım</p></a>
                </li>
                <li class="HeaderMenuUstuSecenekler">
                  <a href="index.php?sk=49"><img src="img/uyecikis.png"></a>
                </li>
                <li class="HeaderMenuUstuSecenekler">
                  <a href="index.php?sk=49"><p>Çıkış Yap</p></a>
                </li>
                <li class="HeaderMenuUstuSecenekler">
                  <a href="index.php?sk=93"><img src="img/basket.png"></a>
                </li>
                <li class="HeaderMenuUstuSecenekler">
                  <a href="index.php?sk=93"><p>Alışveriş Sepeti</p></a>
                </li>
                <?php
                }else{
                ?>
                <li class="HeaderMenuUstuSecenekler">
                  <a href="index.php?sk=31"><img src="img/uyegiris.png"></a>
                </li>
                <li class="HeaderMenuUstuSecenekler">
                  <a href="index.php?sk=31"><p>Giriş</p></a>
                </li>
                <li class="HeaderMenuUstuSecenekler">
                  <a href="index.php?sk=22"><img src="img/yeniuye.png"></a>
                </li>
                <li class="HeaderMenuUstuSecenekler">
                  <a href="index.php?sk=22"><p>Yeni Üye Ol</p></a>
                </li>
                <li class="HeaderMenuUstuSecenekler">
                  <img src="img/basket.png">
                </li>
                <li class="HeaderMenuUstuSecenekler">
                  <p id="metin">Alışveriş Sepeti</p>
                </li>
                <?php
                }
                ?>


              </ul>


            </div>
          </div>
          <div id="HeaderMenuSinirlamaAlani">
            <div id="HeaderMenuLogoAlani">
             <a href="index.php"> <img src="img/LOGO.jpeg"></a>
            </div>


            <div id="headerMenuNavAlani">
              <div id="headerMenuNav">
                <ul id="seceneklerAlani">
                  <li class="secenekler"><a href="index.php?sk=0">Anasayfa</a></li>
                  <li class="secenekler"><a href="index.php?sk=84">Fincanlar</a></li>
                  <li class="secenekler"><a href="index.php?sk=85">Kupalar</a></li>
                  <li class="secenekler"><a href="index.php?sk=106">Kahve Yanı Bardaklar</a></li>
                  <li class="secenekler"><a href="index.php?sk=107">Sunumluklar</a></li>
                </ul>
              </div>
            </div>

            <div id="MenuAcilmaAlani">
              <img src="img/menucizgisi.png" border="0">
            </div>

          </div>
        </div>

        <div id="HeaderAcilirMenuButon" style="display: none"><!-- burada menuyu gizledim ki resme basıldığında açılsın diye js dosyasında yazıyorum -->
          <div id="headerAcilirMenu">
            <ul id="headerAcilirMenuUl">
              <li class="AcilirMenuli"><a href="index.php?sk=0">Anasayfa</a></li>
              <li class="AcilirMenuli"><a href="index.php?sk=84">Fincanlar</a></li>
              <li class="AcilirMenuli"><a href="index.php?sk=85">Kupalar</a></li>
              <li class="AcilirMenuli"><a href="index.php?sk=106">Kahve Yanı Bardaklar</a></li>
              <li class="AcilirMenuli"><a href="index.php?sk=107">Sunumluklar</a></li>
            </ul>
          </div>
        </div>

      </div>

      
    </header>


<main>
    <!-- sayfa kodu boş gelirse, 0 gelirse ve hiç safa kodu gelmese index i anasayfa ya yönlendireceğiz. eğer ki sayfa kodu gelirse zaten gelen numaranın ait olduğu sayfa bu alana çekilecek-->
               <?php
                 if((!$sayfakoduDegeri) or ($sayfakoduDegeri=="") or ($sayfakoduDegeri==0)){
                    
                    include($sayfa[0]);
                 }else{
                     include($sayfa[$sayfakoduDegeri]);   
                 }
                ?> 
                
</main>


<footer>
  <div id="footerMenulerAlani"> 
    <div id="footerMenuSinirlamaAlani">
      <div class="footerMenuSutunlarAlani">
        <div class="footerMenuSutunBaslikAlani">KURUMSAL</div>

        <div class="footerMenuSutunMenulerAlani"><a href="index.php?sk=1" target="_top">Hakkımızda</a></div>

        <div class="footerMenuSutunMenulerAlani"><a href="index.php?sk=8">Banka Hesapları</a></div>

        <div class="footerMenuSutunMenulerAlani"><a href="index.php?sk=9">Havale Bildirim Formu</a></div>

   
      </div>


      <div class="footerMenuSutunlarAlani">
        <div class="footerMenuSutunBaslikAlani">ÜYELİK&HİZMETLER</div>

        <?php  //kullnıcı varsa burası banner da görüncek
          if (isset($_SESSION["Kullanici"])) 
          {?>
            <div class="footerMenuSutunMenulerAlani"><a href="index.php?sk=50" target="_top">Hesabım</a></div>

            <div class="footerMenuSutunMenulerAlani"><a href="index.php?sk=49" target="_top">Çıkış Yap</a></div>
        <?php
          }else{ ?>
            <div class="footerMenuSutunMenulerAlani"><a href="index.php?sk=31" target="_top">Giriş Yap</a></div>

            <div class="footerMenuSutunMenulerAlani"><a href="index.php?sk=22" target="_top">Yeni Üye Ol</a></div>
        <?php } ?>
            <div class="footerMenuSutunMenulerAlani"><a href="index.php?sk=21">Sık Sorulan Sorular</a></div>
                 <div class="footerMenuSutunMenulerAlani"><a href="index.php?sk=14">Kargom Nerede?</a></div>

        <div class="footerMenuSutunMenulerAlani"><a href="index.php?sk=16">İletişim</a></div>
      </div>


      <div class="footerMenuSutunlarAlani">
        <div class="footerMenuSutunBaslikAlani">SÖZLEŞMELER</div>
        
        <div class="footerMenuSutunMenulerAlani"><a href="index.php?sk=2"> Üyelik Sözleşmesi</a></div>

        <div class="footerMenuSutunMenulerAlani"><a href="index.php?sk=3">Kullanım Koşulları</a></div>

        <div class="footerMenuSutunMenulerAlani"><a href="index.php?sk=4">Gizlilik Sözleşmesi</a></div>

        <div class="footerMenuSutunMenulerAlani"><a href="index.php?sk=5">Mesafeli Satış Sözleşmesi</a></div>

        <div class="footerMenuSutunMenulerAlani"><a href="index.php?sk=6">Teslimat</a></div>

        <div class="footerMenuSutunMenulerAlani"> <a href="index.php?sk=7">İptal İade ve Değişim</a></div>
      </div>

      <div class="footerMenuSutunlarAlani">
        <div class="footerMenuSutunBaslikAlani">BİZİ TAKİPEDİN</div>
        <div class="footerMenuSutunMenulerAlani"><a href="<?php echo DonusumleriGeriDondur($twit); ?>" target="_blank"><img src="img/twitter.png">Twitter</a></div>

        <div class="footerMenuSutunMenulerAlani"><a href="<?php echo DonusumleriGeriDondur($face); ?>" target="_blank"><img src="img/facebook.png" border="0">Facebook</a></div>

        <div class="footerMenuSutunMenulerAlani"><a href="<?php echo DonusumleriGeriDondur($linkedin); ?>" target="_blank"><img src="img/linkedin.png">Linkedin</a></div>

        <div class="footerMenuSutunMenulerAlani"><a href="<?php echo DonusumleriGeriDondur($pinterest); ?>" target="_blank"><img src="img/pinterest.png" border="0">Pinterest</a></div>

        <div class="footerMenuSutunMenulerAlani"><a href="<?php echo DonusumleriGeriDondur($instagram); ?>" target="_blank"><img src="img/instagram.png" border="0">Instagram</a></div>

        <div class="footerMenuSutunMenulerAlani"><a href="<?php echo DonusumleriGeriDondur($youtube); ?>" target="_blank"><img src="img/youtube.png" border="0">Youtube</a></div>
      </div>
    </div>
  </div>

  <div id="footerAltMetniAlani">
    <div id="footerAltMetniSinirlamaAlani">
      ><?php echo "<b>".DonusumleriGeriDondur($copyMetni)."</b>"; ?>
    </div>
  </div>

  <div id="footerAltLogoAlani">
    <div id="footerAltLogoSinirlamaAlani">
      <div id="rapidSslLogosu"><img src="img/rapidssl.png" border="0"></div>
      <div id="guvenliLogosu"><img src="img/guvenliAlis.jfif" border="0"></div>
      <div id="d3Logosu"><img src="img/3d.png" border="0"></div>
      <div id="aksesLogosu"><img src="img/akses.png" border="0"></div>
      <div id="bonusLogosu"><img src="img/bonus.png" border="0"></div>
      <div id="worldLogosu"><img src="img/world.png" border="0"></div>
      <div id="maximumLogosu"><img src="img/maximum.png" border="0"></div>
      <div id="parafLogosu"><img src="img/paraf.png" border="0"></div>
      <div id="cardFinansLogosu"><img src="img/cardFinans.png" border="0"></div>
      <div id="visaLogosu"><img src="img/visa.png" border="0"></div>
      <div id="masterCardLogosu"><img src="img/martercard.png" border="0"></div>
      <div id="amerikanExpLogosu"><img src="img/americanExp.jfif" border="0"></div>
      <div id="wireCrdLogosu"><img src="img/wireCard.png" border="0"></div>
      <div id="telekomLogosu"><img src="img/turkTelekom.png" border="0"></div>
      <div id="turkcelLogosu"><img src="img/turkcell.png" border="0"></div>
      <div id="vodafoneLogosu"><img src="img/vodafone.png" border="0"></div>
      
    </div>
  </div>
</footer>
</div> 
</body>
</html>

<?php

  $baglan=null;
  ob_end_flush();


?>