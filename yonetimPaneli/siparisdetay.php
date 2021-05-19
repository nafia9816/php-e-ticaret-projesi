<?php
 if (isset($_SESSION["Yonetici"])) {
  if (isset($_GET["SiparisNo"])) {
     $GelenSiparisNo=guvenlik($_GET["SiparisNo"]);//BU SİPARİS NO detaya a bastığımız da gşen url den geliyor. linkte verdik
   }else{
     $GelenSiparisNo="";
   }
?>
<div id="SiparislerTamSayfaCerceveAlani">
  <div id="SiparislerTamSayfaCerceveSinirlamaAlani">
    <div id="TamSayfadaYuzlukAlan">        
      <div class="SiparislerBaslik">SİPARİŞ DETAY</div>       
  <?php

   $siparisler_sorgu=$baglan->prepare("SELECT * FROM siparisler WHERE  SiparisNumarasi=?");
   $siparisler_sorgu->execute([$GelenSiparisNo]);
   $siparisler_sayi=$siparisler_sorgu->rowCount();
   $siparisler_kayitlari=$siparisler_sorgu->fetchAll(PDO::FETCH_ASSOC);
   if ($siparisler_sayi>0) {
    $donguSayisi=0;
    foreach ($siparisler_kayitlari as $satirlar) {
         
        if ($satirlar["UrunTuru"] == "fincan") {
           $resimKlasoru="fincan";
         }elseif ($satirlar["UrunTuru"] == "kupa") {
           $resimKlasoru="kupa";
         }elseif ($satirlar["UrunTuru"] == "kahveyanibardak") {
           $resimKlasoru="kahveyanibardak";
         }elseif ($satirlar["UrunTuru"] == "sunumluk") {
           $resimKlasoru="sunumluk";
         }
        if ($donguSayisi==0) {  //siparişi alan kişini bilgilerini sadece birkez yazması için
  ?>
  <div class="SiparisDetayIslemlerAlani">
    <div class="SiparisDetayAlani"><div class="UrunDetayUstBaslikMetni">&#10148; Müşterinin;</div></div>
    <div class="SiparisDetayAlani">
            <div class="SiparisDetayBaslikMetni"> Adı Soyadı:</div>
            <div class="SiparisDetayIcerikMetni"><?php echo DonusumleriGeriDondur($satirlar["AdresAdSoyad"]); ?></div>
    </div>
    <div class="SiparisDetayAlani">
            <div class="SiparisDetayBaslikMetni">Telefon Numarası:</div>
            <div class="SiparisDetayIcerikMetni"><?php echo DonusumleriGeriDondur($satirlar["AdresTelefon"]); ?></div>
    </div>
    <div class="SiparisDetayAlani">
            <div class="SiparisDetayBaslikMetni">Açık Adres:</div>
            <div class="SiparisDetayIcerikMetni"><?php echo DonusumleriGeriDondur($satirlar["AdresDetay"]); ?></div>
    </div>
    <?php
        }
    ?>
    <div class="SiparisDetayAlani"><div class="UrunDetayUstBaslikMetni">&#10148; Ürünün;</div></div>
    <div class="TamamlananUrunDetayResimAlani">
            <img src="../img/urunler/<?php echo DonusumleriGeriDondur($satirlar["UrunTuru"]); ?>/<?php echo DonusumleriGeriDondur($satirlar["UrunResmiBir"]); ?>" border="0">
    </div>
    <div class="UrunDetaylari">
      <div class="SiparisDetayAlani">
        <div class="UrunDetayBaslikMetni">Adı:</div>
        <div class="UrunDetayIcerikMetni"><?php echo DonusumleriGeriDondur($satirlar["UrunAdi"]); ?>
          <?php echo DonusumleriGeriDondur($satirlar["VaryantBasligi"]); ?> - <?php echo DonusumleriGeriDondur($satirlar["VaryantSecimi"]); ?>
        </div>
      </div>
      <div class="SiparisDetayAlani">
            <div class="UrunDetayBaslikMetni">Fiyatı: </div>
            <div class="UrunDetayIcerikMetni"><?php echo fiyatBicimlendir(DonusumleriGeriDondur($satirlar["UrunFiyati"])); ?>TL  |  Adet: <?php echo DonusumleriGeriDondur($satirlar["UrunAdedi"]);?> | Toplam Fiyat: <?php echo fiyatBicimlendir(DonusumleriGeriDondur($satirlar["ToplamUrunFiyati"])); ?> TL |  Kdv Oranı: %<?php echo DonusumleriGeriDondur($satirlar["KDVOrani"]); ?></div>
      </div>
      <div class="SiparisDetayAlani">
            <div class="UrunDetayBaslikMetni">Ödeme Türü:</div>
            <div class="UrunDetayIcerikMetni"><?php echo DonusumleriGeriDondur($satirlar["OdemeSecimi"]); ?> | Taksit Sayısı: <?php echo DonusumleriGeriDondur($satirlar["TaksitSecimi"]); ?>  | Kargo Seçimi: <?php echo DonusumleriGeriDondur($satirlar["KargoFirmaSecimi"]); ?> |  Kargo Ücreti: <?php echo DonusumleriGeriDondur($satirlar["KargoUcreti"]); ?>TL</div>
      </div>
    </div><!-- urun detayları sonu-->
  </div><!--sipariş detay işlemleri alanı-->
  <?php
   $donguSayisi++;
   }//foreach birimi
  ?>
<!-- bekleyen siparişlere kargo gönderi kodu vereceğim ve siparişi tamamlanmıs olacak-->
  <form action="index.php?SKD=0&SKI=109&SiparisNo=<?php echo DonusumleriGeriDondur($GelenSiparisNo); ?>" method="POST">
    <div class="UrunDetayFormBaslikMetni">Gönderi Kodu:</div>
      <div class="FormSatirAlani"><input type="text" name="GonderiKodu" class="SiparisDetayGonderikoduInputAlani"></div>
      <div class="ButonKapsamaAlani">
            <input type="submit" value="Gönderi Kodunu İşle ve Siparişi Tamamla" class="FormYesilButonu">
      </div>
  </form>
  <?php
  } 
  else{
  ?>
 <div class="BilgiAciklamaAlani">Kayıtlı bekleyen siparis bulunmamaktadır.</div>
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