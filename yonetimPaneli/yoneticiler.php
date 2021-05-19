<?php
 if (isset($_SESSION["Yonetici"])) {
?>
<div id="UyelerTamSayfaCerceveAlani">
  <div id="UyelerTamSayfaCerceveSinirlamaAlani">
    <div id="TamSayfadaYuzlukAlan">        
      <div class="UyelerBaslik">YÖNETİCİLER</div>
        
 <?php
   $yoneticiler_sorgu=$baglan->prepare("SELECT * FROM yoneticiler ORDER BY IsimSoyisim ASC"); 
   $yoneticiler_sorgu->execute();
   $yoneticiler_sayi=$yoneticiler_sorgu->rowCount();
   $yoneticiler_kayitlari=$yoneticiler_sorgu->fetchAll(PDO::FETCH_ASSOC);
   if ($yoneticiler_sayi>0){
    foreach ($yoneticiler_kayitlari as $yoneticiler) {

  ?>
<div class="YonetimIslemlerAlani">
  <div class="SiparisDetayAlaniSag">
    <div class="UyeDetayBaslikMetni"> Kullanıcı Adı:</div>
               <div class="UyeDetayIcerikMetni"><?php echo $yoneticiler["KullaniciAdi"]; ?></div>
    </div>
    <div class="SiparisDetayAlaniSag">
               <div class="UyeDetayBaslikMetni">Adı Soyadı:</div>
               <div class="UyeDetayIcerikMetni"><?php echo $yoneticiler["IsimSoyisim"]; ?></div>
    </div>
    <div class="SiparisDetayAlaniSol">
               <div class="UyeDetayBaslikMetni"> E-mail Adresi:</div>
               <div class="UyeDetayIcerikMetni"><?php echo $yoneticiler["EmailAdres"]; ?></div>
    </div>
    <div class="SiparisDetayAlaniSol">
               <div class="UyeDetayBaslikMetni"> Telefon Numarası:</div>
               <div class="UyeDetayIcerikMetni"><?php echo $yoneticiler["TelefonNumarasi"]; ?></div>
    </div>
    <div class="HavaleSilIslemleri">
        <div class="HavaleSilMetni">Sil</div>
        <div class="HavaleSilResim">
            <a href="index.php?SKD=0&SKI=78&ID=<?php echo DonusumleriGeriDondur($yoneticiler["id"]); ?>"><img src="../img/sil.png" border="0"></a>
        </div>          
    <div class="HavaleSilMetni">Güncelle</div>
        <div class="HavaleSilResim">
            <a href="index.php?SKD=0&SKI=74&ID=<?php echo DonusumleriGeriDondur($yoneticiler["id"]); ?>"><img src="../img/adresguncelle.png" border="0"></a>
        </div>
    </div>  
</div>    <!-- yönetici işlemler alanı bitişi-->
<?php 
  }//for bitisi 
    }else{ //if ($urunler_sayi>0){
?>
<div class="BilgiAciklamaAlani">Kayıtlı yönetici bulunmamaktadır.</div>
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