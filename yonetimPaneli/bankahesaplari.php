<?php
 if (isset($_SESSION["Yonetici"])) {
?>
<div id="BankaHesaplariTamSayfaCerceveAlani">
  <div id="BankaHesaplariTamSayfaCerceveSinirlamaAlani">
    <div id="TamSayfadaYuzlukAlan">        
      <div class="HavaleIslemlerBaslik">BANKA HESAP AYARLARI</div>

  <?php
   $hesap_sorgu=$baglan->prepare("SELECT * FROM bankahesaplari ORDER BY bankaAdi ASC");
   $hesap_sorgu->execute();
   $hesap_sayi=$hesap_sorgu->rowCount();
   $hesap_kayitlari=$hesap_sorgu->fetchAll(PDO::FETCH_ASSOC);
   if ($hesap_sayi>0){
    foreach ($hesap_kayitlari as $hesaplar) {
  ?>
  <div class="HaveleIslemlerAlani">
    <div class="BankaResimAlani"><img src="../img/<?php echo DonusumleriGeriDondur($hesaplar["banka_logo"]); ?>" border="0"></div>
    <div class="UrunDetaylari">
      <div class="HavaleDetayAlani">             
        <div class="HavaleIcerikMetni">Banka Adı: <?php echo DonusumleriGeriDondur($hesaplar["bankaAdi"]); ?></div>
      </div>
      <div class="HavaleDetayAlani">
        <div class="HavaleIcerikMetni">Hesap Sahibi: <?php echo DonusumleriGeriDondur($hesaplar["hesapSahibi"]); ?></div>
      </div>
      <div class="HavaleDetayAlani">
        <div class="HavaleIcerikMetni">Şube Ve Konum Bilgileri: <?php echo DonusumleriGeriDondur($hesaplar["subeAdi"]); ?>(<?php echo DonusumleriGeriDondur($hesaplar["subeKodu"]); ?>) - <?php echo DonusumleriGeriDondur($hesaplar["konumSehir"]); ?>/ <?php echo DonusumleriGeriDondur($hesaplar["konumUlke"]);?></div>
      </div>
      <div class="HavaleDetayAlani">
        <div class="HavaleIcerikMetni">Hesap Bilgileri: <?php echo DonusumleriGeriDondur($hesaplar["paraBirimi"]); ?>/ <?php echo DonusumleriGeriDondur($hesaplar["hesapNum"]); ?>/ <?php echo DonusumleriGeriDondur($hesaplar["ibanNum"]); ?> </div>
      </div>
      <div class="HavaleSilIslemleri">
        <div class="HavaleSilMetni">Sil</div>
        <div class="HavaleSilResim">
          <a href="index.php?SKD=0&SKI=18&ID=<?php echo DonusumleriGeriDondur($hesaplar["id"]); ?>"><img src="../img/sil.png" border="0"></a>
        </div>
        <div class="HavaleSilMetni">Güncelle</div>
        <div class="HavaleSilResim"><a href="index.php?SKD=0&SKI=14&ID=<?php echo DonusumleriGeriDondur($hesaplar["id"]); ?>"><img src="../img/adresguncelle.png" border="0"></a>
        </div>
      </div>

    </div><!-- urun deyatları alanı bitişi-->
  </div>    <!-- havale işemler alanı bitişi-->
  <?php
    }//for bitisi    
    }else{ //if ($urunler_sayi>0){
  ?>
   <div class="BilgiAciklamaAlani">Kayıtlı Banka Hesabı Bulunmamaktadır.</div>
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