<?php
 if (isset($_SESSION["Yonetici"])) {
 	//dashboardımızda görünmesini istediğimiz istatitikleti burada çekiiruk

 	$bekleyenSiparis_sorgusu=$baglan->prepare("SELECT DISTINCT 	SiparisNumarasi FROM siparisler WHERE OnayDurumu=? AND KargoDurumu=?");
 	$bekleyenSiparis_sorgusu->execute([0,0]);
 	$bekleyenSiparisSayisi=$bekleyenSiparis_sorgusu->rowCount();

  $tamamlananSiparis_sorgusu=$baglan->prepare("SELECT DISTINCT 	SiparisNumarasi FROM siparisler WHERE OnayDurumu=? AND KargoDurumu=?");
 	$tamamlananSiparis_sorgusu->execute([1,1]);
 	$tamamlananSiparisSayisi=$tamamlananSiparis_sorgusu->rowCount();

 	$tumSiparis_sorgusu=$baglan->prepare("SELECT DISTINCT 	SiparisNumarasi FROM siparisler WHERE OnayDurumu=? AND KargoDurumu=?");
 	$tumSiparis_sorgusu->execute([0,0]);
 	$tumSiparisSayisi=$tumSiparis_sorgusu->rowCount();

 	$havale_sorgusu=$baglan->prepare("SELECT * FROM havalebildirimleri");
 	$havale_sorgusu->execute();
 	$havaleSayisi=$havale_sorgusu->rowCount();

 	$banka_sorgusu=$baglan->prepare("SELECT * FROM bankahesaplari");
 	$banka_sorgusu->execute();
 	$bankaSayisi=$banka_sorgusu->rowCount();

 	$menu_sorgusu=$baglan->prepare("SELECT * FROM menuler");
 	$menu_sorgusu->execute();
 	$menuSayisi=$menu_sorgusu->rowCount();

 	$urun_sorgusu=$baglan->prepare("SELECT * FROM urunler");
 	$urun_sorgusu->execute();
 	$urunSayisi=$urun_sorgusu->rowCount();

 	$uyeler_sorgusu=$baglan->prepare("SELECT * FROM uyeler");
 	$uyeler_sorgusu->execute();
 	$uyelerSayisi=$uyeler_sorgusu->rowCount();

 	$yoneticiler_sorgusu=$baglan->prepare("SELECT * FROM yoneticiler");
 	$yoneticiler_sorgusu->execute();
 	$yoneticilerSayisi=$yoneticiler_sorgusu->rowCount();

 	$kargo_sorgusu=$baglan->prepare("SELECT * FROM kargofirmalari");
 	$kargo_sorgusu->execute();
 	$kargoSayisi=$kargo_sorgusu->rowCount();

 	$banner_sorgusu=$baglan->prepare("SELECT * FROM bannerler");
 	$banner_sorgusu->execute();
 	$bannerSayisi=$banner_sorgusu->rowCount();

 	$yorum_sorgusu=$baglan->prepare("SELECT * FROM yorumlar");
 	$yorum_sorgusu->execute();
 	$yorumSayisi=$yorum_sorgusu->rowCount();

 	$destek_sorgusu=$baglan->prepare("SELECT * FROM sorular");
 	$destek_sorgusu->execute();
 	$destekSayisi=$destek_sorgusu->rowCount();
?>
<div id="PanoAlani">
  <div class="PanoDengelemeAlani"></div>

    <div class="PanoSinirlamaAlani">
      <table class="PanoTabloları" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr><td align="left" valign="top" class="BaslikMetniSutunu">&#10059; BEKLEYEN SİPARİŞLER &#10059;</td></tr>
          <tr><td align="left" valign="top" class="IcerikMetniSutunu">&#10140; <?php echo $bekleyenSiparisSayisi ?></td></tr>
        </tbody>
      </table>
    </div>

    <div class="PanoSinirlamaAlani">
      <table class="PanoTabloları" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr><td align="left" valign="top" class="BaslikMetniSutunu">&#10059; TAMAMLANAN SİPARİŞLER &#10059;</td></tr>
          <tr><td align="left" valign="top" class="IcerikMetniSutunu">&#10140; <?php echo $tamamlananSiparisSayisi; ?></td></tr>
        </tbody>
      </table>
    </div>
    
    <div class="PanoSinirlamaAlani">
      <table class="PanoTabloları" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr><td align="left" valign="top" class="BaslikMetniSutunu">&#10059; TÜM SİPARİŞLER &#10059;</td></tr>
          <tr><td align="left" valign="top" class="IcerikMetniSutunu">&#10140; <?php echo $tumSiparisSayisi; ?></td></tr>       
        </tbody>
      </table>
    </div>
    
    <div class="PanoSinirlamaAlani">
      <table class="PanoTabloları" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr><td align="left" valign="top" class="BaslikMetniSutunu">&#10059; HAVALE BİLDİRİMLERİ &#10059;</td></tr>
          <tr><td align="left" valign="top" class="IcerikMetniSutunu">&#10140; <?php echo $havaleSayisi; ?></td> </tr>       
        </tbody>
      </table>
    </div>

    <div class="PanoSinirlamaAlani">
      <table class="PanoTabloları" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr><td align="left" valign="top" class="BaslikMetniSutunu">&#10059; BANKA HESAPLARI &#10059;</td></tr>
          <tr><td align="left" valign="top" class="IcerikMetniSutunu">&#10140; <?php  echo $bankaSayisi; ?></td></tr>       
        </tbody>
      </table>
    </div>

    <div class="PanoSinirlamaAlani">
      <table class="PanoTabloları" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr><td align="left" valign="top" class="BaslikMetniSutunu">&#10059; MENÜ SAYISI &#10059;</td></tr>
          <tr><td align="left" valign="top" class="IcerikMetniSutunu">&#10140; <?php echo $menuSayisi; ?></td></tr>       
         </tbody>
      </table>
    </div>

    <div class="PanoSinirlamaAlani">
      <table class="PanoTabloları" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr><td align="left" valign="top" class="BaslikMetniSutunu">&#10059; ÜRÜNLER &#10059;</td></tr>
          <tr><td align="left" valign="top" class="IcerikMetniSutunu">&#10140; <?php echo $urunSayisi; ?></td></tr>       
        </tbody>
      </table>
    </div>

    <div class="PanoSinirlamaAlani">
      <table class="PanoTabloları" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr><td align="left" valign="top" class="BaslikMetniSutunu">&#10059; ÜYELER &#10059;</td></tr>
          <tr><td align="left" valign="top" class="IcerikMetniSutunu">&#10140; <?php echo $uyelerSayisi; ?></td></tr>       
        </tbody>
      </table>
    </div>
    
    <div class="PanoSinirlamaAlani">
      <table class="PanoTabloları" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr><td align="left" valign="top" class="BaslikMetniSutunu">&#10059; YÖNETİCİLER &#10059;</td></tr>
          <tr><td align="left" valign="top" class="IcerikMetniSutunu">&#10140; <?php echo $yoneticilerSayisi; ?></td></tr>       
        </tbody>
      </table>
    </div>

    <div class="PanoSinirlamaAlani">
      <table class="PanoTabloları" width="100%" border="0" cellspacing="0" cellpadding="0">
          <tbody>
            <tr><td align="left" valign="top" class="BaslikMetniSutunu">&#10059; KARGO FİRMALARI &#10059;</td></tr>
            <tr><td align="left" valign="top" class="IcerikMetniSutunu">&#10140; <?php echo $kargoSayisi; ?></td></tr>       
          </tbody>
      </table>
    </div>
    
    <div class="PanoSinirlamaAlani">
        <table class="PanoTabloları" width="100%" border="0" cellspacing="0" cellpadding="0">
          <tbody>
            <tr><td align="left" valign="top" class="BaslikMetniSutunu">&#10059; BANNERLER &#10059;</td></tr>
            <tr><td align="left" valign="top" class="IcerikMetniSutunu">&#10140; <?php echo $bannerSayisi; ?></td></tr>       
          </tbody>
        </table>
    </div>
    
    <div class="PanoSinirlamaAlani">
        <table class="PanoTabloları" width="100%" border="0" cellspacing="0" cellpadding="0">
          <tbody>
            <tr><td align="left" valign="top" class="BaslikMetniSutunu">&#10059; YORUMLAR &#10059;</td></tr>
            <tr><td align="left" valign="top" class="IcerikMetniSutunu">&#10140; <?php echo $yorumSayisi; ?></td></tr>       
          </tbody>
        </table>
    </div>
    
    <div class="PanoSinirlamaAlani">
      <table class="PanoTabloları" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr><td align="left" valign="top" class="BaslikMetniSutunu">&#10059; DESTEK İÇERİKLERİ &#10059;</td></tr>
          <tr><td align="left" valign="top" class="IcerikMetniSutunu">&#10140; <?php echo $destekSayisi; ?></td></tr>       
        </tbody>
      </table>
    </div>

</div>
         



























<?php
}else{
  header("Location:index.php?SKD=1");
  exit();
}

?>