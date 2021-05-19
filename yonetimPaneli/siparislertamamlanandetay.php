<?php
 if (isset($_SESSION["Yonetici"])) {
  if (isset($_GET["SiparisNo"])) {
     $GelenSiparisNo=guvenlik($_GET["SiparisNo"]);//BU SİPARİS NO detaya a bastığımız da gşen url den geliyor. linkte verdik
   }else{
     $GelenSiparisNo="";
   } 

?>
 <div id="BankaHesaplariTamSayfaCerceveAlani">
     <div id="BankaHesaplariTamSayfaCerceveSinirlamaAlani">
        <div id="TamSayfadaYuzlukAlan">       
          <div class="HavaleIslemlerBaslik">SİPARİŞ DETAY</div>       
<?php

  $siparisler_sorgu=$baglan->prepare("SELECT * FROM siparisler WHERE  SiparisNumarasi=?");
  $siparisler_sorgu->execute([$GelenSiparisNo]);
  $siparisler_sayi=$siparisler_sorgu->rowCount();
  $siparisler_kayitlari=$siparisler_sorgu->fetchAll(PDO::FETCH_ASSOC);
  if ($siparisler_sayi>0) {
  $donguSayisi=0;//kullanıcının bilgilerini bir kez yazması için
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
  ?>
  <?php
      if ($donguSayisi==0) {  //siparişi alan kişini bilgilerini sadece birkez yazması için
      ?>
      <tr>
<div class="HaveleIslemlerAlani">
  <div class="HavaleDetayAlani">
    <div class="UrunDetayUstBaslikMetni">&#10148; Müşterinin;</div>
  </div>
  <div class="HavaleDetayAlani">
            <div class="HavaleBaslikMetni"> Adı Soyadı:</div>
            <div class="HavaleIcerikMetni"><?php echo DonusumleriGeriDondur($satirlar["AdresAdSoyad"]); ?></div>
  </div>
  <div class="HavaleDetayAlani">
            <div class="HavaleBaslikMetni">Telefon Numarası:</div>
            <div class="HavaleIcerikMetni"><?php echo DonusumleriGeriDondur($satirlar["AdresTelefon"]); ?></div>
  </div>
  <div class="HavaleDetayAlani">
            <div class="HavaleBaslikMetni">Açık Adres:</div>
            <div class="HavaleIcerikMetni"><?php echo DonusumleriGeriDondur($satirlar["AdresDetay"]); ?></div>
  </div>
  <div class="HavaleDetayAlani">
            <div class="HavaleBaslikMetni">Gönderi Kodu:</div>
            <div class="HavaleIcerikMetni"><?php echo DonusumleriGeriDondur($satirlar["KargoGonderiKodu"]); ?></div>
  </div>
  <?php
           }//dongu sonu
  ?>
  <div class="HavaleDetayAlani">
    <div class="UrunDetayUstBaslikMetni">&#10148; Ürünün;</div>
  </div>
  <div class="TamamlananUrunDetayResimAlani">
    <img src="../img/urunler/<?php echo DonusumleriGeriDondur($satirlar["UrunTuru"]); ?>/<?php echo DonusumleriGeriDondur($satirlar["UrunResmiBir"]); ?>" border="0">
  </div>
  <div class="UrunDetaylari">
    <div class="HavaleDetayAlani">
            <div class="UrunDetayBaslikMetni">Adı:</div>
            <div class="UrunDetayIcerikMetni"><?php echo DonusumleriGeriDondur($satirlar["UrunAdi"]); ?>
              <?php echo DonusumleriGeriDondur($satirlar["VaryantBasligi"]); ?> - <?php echo DonusumleriGeriDondur($satirlar["VaryantSecimi"]); ?>
            </div>
    </div>
    <div class="HavaleDetayAlani">
            <div class="UrunDetayBaslikMetni">Fiyatı: </div>
            <div class="UrunDetayIcerikMetni"><?php echo fiyatBicimlendir(DonusumleriGeriDondur($satirlar["UrunFiyati"])); ?>TL |  Adet: <?php echo fiyatBicimlendir(DonusumleriGeriDondur($satirlar["UrunAdedi"]));?> | Toplam Fiyat: <?php echo DonusumleriGeriDondur($satirlar["ToplamUrunFiyati"]); ?> TL |  Kdv Oranı: %<?php echo DonusumleriGeriDondur($satirlar["KDVOrani"]); ?></div>
    </div>
    <div class="HavaleDetayAlani">
            <div class="UrunDetayBaslikMetni">Ödeme Türü:</div>
            <div class="UrunDetayIcerikMetni"><?php echo DonusumleriGeriDondur($satirlar["OdemeSecimi"]); ?> |  Taksit Sayısı: <?php echo DonusumleriGeriDondur($satirlar["TaksitSecimi"]); ?> |  Kargo Seçimi: <?php echo DonusumleriGeriDondur($satirlar["KargoFirmaSecimi"]); ?> |  Kargo Ücreti: <?php echo DonusumleriGeriDondur($satirlar["KargoUcreti"]); ?>TL</div>
    </div>
  </div>
</div>
<?php
   $donguSayisi++;
  }//foreach birimi
  }//siparis varsa if inin sonu 
  
    else{
                ?>
<div class="BilgiAciklamaAlani">Kayıtlı tamamlanan siparis bulunmamaktadır.</div>
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