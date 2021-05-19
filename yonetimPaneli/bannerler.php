<?php
 if (isset($_SESSION["Yonetici"])) {
?>
<div id="BankaHesaplariTamSayfaCerceveAlani">
  <div id="BankaHesaplariTamSayfaCerceveSinirlamaAlani">
    <div id="TamSayfadaYuzlukAlan">        
      <div class="HavaleIslemlerBaslik">BANNERLER</div>
<?php
   $bannerler_sorgu=$baglan->prepare("SELECT * FROM bannerler ORDER BY id DESC");
   $bannerler_sorgu->execute();
   $bannerler_sayi=$bannerler_sorgu->rowCount();
   $bannerler_kayitlari=$bannerler_sorgu->fetchAll(PDO::FETCH_ASSOC);
   if ($bannerler_sayi>0){
    foreach ($bannerler_kayitlari as $bannerler) {
  ?>
<div class="HaveleIslemlerAlani">
  <div class="BannerResimAlani">
    <img src="../img/<?php echo DonusumleriGeriDondur($bannerler["BannerResmi"]); ?>" border="0">
  </div>
  <div class="BannerDetaylari">
    <div class="HavaleDetayAlani">             
        <div class="HavaleIcerikMetni">Banner Adı: <?php echo DonusumleriGeriDondur($bannerler["BannerAdi"]); ?></div>
    </div>
    <div class="HavaleDetayAlani">
        <div class="HavaleIcerikMetni">Yer Aldığı Sayfa: <?php echo DonusumleriGeriDondur($bannerler["BannerAlani"]); ?></div>
    </div>
    <div class="HavaleDetayAlani">
        <div class="HavaleIcerikMetni">Hit:<?php echo DonusumleriGeriDondur($bannerler["GosterimSayisi"]); ?></div>
    </div>
  </div>
  <div class="HavaleSilIslemleri">
        <div class="HavaleSilMetni">Sil</div>
        <div class="HavaleSilResim">
           <a href="index.php?SKD=0&SKI=42&ID=<?php echo DonusumleriGeriDondur($bannerler["id"]); ?>"><img src="../img/sil.png" border="0"></a>
        </div>
        <div class="HavaleSilMetni">Güncelle</div>
        <div class="HavaleSilResim">
          <a href="index.php?SKD=0&SKI=38&ID=<?php echo DonusumleriGeriDondur($bannerler["id"]); ?>"><img src="../img/adresguncelle.png" border="0"></a>
        </div>
  </div>
</div> <!-- havale işlemleri alanı bitişi--> 
<?php
  }//for bitisi    
}else{ //if ($urunler_sayi>0){
?>
<div class="BilgiAciklamaAlani">Kayıtlı banner bulunmamaktadır.</div>
<?php
    }        
?>
  </div> <!-- yüzlük alan kapaması -->
</div>
</div>
<?php
}else{
  header("Location:index.php");//kullanıcı yoksa index e atıcak bu sayfaya girmek istediğimde
  exit();
}
?>