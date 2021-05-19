<?php
 if (isset($_SESSION["Yonetici"])) {
?>
<div id="UrunGuncelleTamSayfaCerceveAlani">
  <div id="UrunGuncelleTamSayfaCerceveSinirlamaAlani">
    <div id="TamSayfadaYuzlukAlan">
      <div class="UrunlerBaslik">DESTEK İÇERİKLERİ</div>
<?php
   $destekler_sorgu=$baglan->prepare("SELECT * FROM sorular ORDER BY  soru ASC");
   $destekler_sorgu->execute();
   $destekler_sayi=$destekler_sorgu->rowCount();
   $destekler_kayitlari=$destekler_sorgu->fetchAll(PDO::FETCH_ASSOC);
   if ($destekler_sayi>0){
    foreach ($destekler_kayitlari as $destekler) {
?>
      <div class="HaveleIslemlerAlani">
        <div class="MetinDetaylari"><div class="MetinDetayAlani"><?php echo $destekler["soru"]; ?></div></div>
        <div class="MetinDetaylari"><div class="MetinDetayAlani"><?php echo $destekler["cevap"]; ?></div></div>
        <div class="HavaleSilIslemleri">
          <div class="HavaleSilMetni">Sil</div>
          <div class="HavaleSilResim">
            <a href="index.php?SKD=0&SKI=54&ID=<?php echo DonusumleriGeriDondur($destekler["id"]); ?>"><img src="../img/sil.png" border="0"></a>
          </div>
          <div class="HavaleSilMetni">Güncelle</div>
          <div class="HavaleSilResim">
              <a href="index.php?SKD=0&SKI=50&ID=<?php echo DonusumleriGeriDondur($destekler["id"]); ?>"><img src="../img/adresguncelle.png" border="0"></a>
          </div>
        </div>
      </div>
  <?php
          }//for döngüsü
        }else{
  ?>
  <div class="BilgiAciklamaAlani">Kayıtlı havale bildirimi kaydı bulunmamaktadır.</div>
  <?php
    }        
  ?>

  </div> 
</div>
</div>

<?php
}else{
    header("Location:index.php");//kullanıcı yoksa index e atıcak bu sayfaya girmek istediğimde
    exit();
}
?>
