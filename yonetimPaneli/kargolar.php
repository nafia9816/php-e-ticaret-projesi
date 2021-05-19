<?php
 if (isset($_SESSION["Yonetici"])) {
?>
<div id="BankaHesaplariTamSayfaCerceveAlani">
  <div id="BankaHesaplariTamSayfaCerceveSinirlamaAlani">
    <div id="TamSayfadaYuzlukAlan">        
       <div class="HavaleIslemlerBaslik">ANLAŞMALI KARGO FİRMALARI</div>
<?php
   $kargolar_sorgu=$baglan->prepare("SELECT * FROM kargofirmalari ORDER BY FirmaAdi ASC");
   $kargolar_sorgu->execute();
   $kargolar_sayi=$kargolar_sorgu->rowCount();
   $kargolar_kayitlari=$kargolar_sorgu->fetchAll(PDO::FETCH_ASSOC);
   if ($kargolar_sayi>0){
    foreach ($kargolar_kayitlari as $kargolar) {
?>
<div class="HaveleIslemlerAlani">
  <div class="KargoResimAlani"><img src="../img/<?php echo DonusumleriGeriDondur($kargolar["FirmaLogosu"]); ?>" border="0"></div>
  <div class="KargoIcerikMetni"><?php echo DonusumleriGeriDondur($kargolar["FirmaAdi"]); ?></div>
  <div class="HavaleSilIslemleri">
    <div class="HavaleSilMetni">Sil</div>
    <div class="HavaleSilResim">
      <a href="index.php?SKD=0&SKI=30&ID=<?php echo DonusumleriGeriDondur($kargolar["id"]); ?>"><img src="../img/sil.png" border="0"></a>
    </div>
    <div class="HavaleSilMetni">Güncelle</div>
      <div class="HavaleSilResim">
        <a href="index.php?SKD=0&SKI=26&ID=<?php echo DonusumleriGeriDondur($kargolar["id"]); ?>"><img src="../img/adresguncelle.png" border="0"></a>
      </div>
        
  </div>
</div>    
<?php
    }//for bitisi    
  }else{ //if ($urunler_sayi>0){
?>
<div class="BilgiAciklamaAlani">Kayıtlı kargo firması bulunmamaktadır.</div>
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