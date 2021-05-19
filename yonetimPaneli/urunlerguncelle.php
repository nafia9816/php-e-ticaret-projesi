<?php
 if (isset($_SESSION["Yonetici"])) {

  if (isset($_GET["ID"])) {
     $GelenID=guvenlik($_GET["ID"]);
   }else{
     $GelenID="";
   }
  
   $urunler_sorgu=$baglan->prepare("SELECT * FROM urunler WHERE id=? LIMIT 1");
   $urunler_sorgu->execute([$GelenID]);
   $urunler_sayi=$urunler_sorgu->rowCount();
   $urunler_bilgisi=$urunler_sorgu->fetch(PDO::FETCH_ASSOC);
   if ($urunler_sayi>0){
?>
<div id="UrunGuncelleTamSayfaCerceveAlani">
  <div id="UrunGuncelleTamSayfaCerceveSinirlamaAlani">
    <div id="TamSayfadaYuzlukAlan">
      <div class="UrunlerBaslik">
        <span class="baslikSagTaraf">ÜRÜNLER</span>  <span class="baslikSolTaraf"><a href="index.php?SKD=0&SKI=94"> yeni ürün ekle</a></span>
      </div>
      <form action="index.php?SKD=0&SKI=99&ID=<?php echo $GelenID; ?>" method="POST" enctype="multipart/form-data">
        <div class="UrunlerFormSatirAlani">
          <div class="UrunlerFormBaslikMetni">Ürün Menüsü: </div>
            <select name="UrunMenusu" class="FormSelectAlani">
                    <?php
                      $menuler_sorgusu=$baglan->prepare("SELECT * FROM menuler WHERE UrunTuru=? ORDER BY UrunTuru ASC, MenuAdi ASC");//burdaki where kadın seçilirse sadece kadın menuleri gelsin diye
                      $menuler_sorgusu->execute([DonusumleriGeriDondur($urunler_bilgisi["UrunTuru"])]);
                      $menu_kontrol=$menuler_sorgusu->rowCount();
                      $menu_kayitlari=$menuler_sorgusu->fetchAll(PDO::FETCH_ASSOC);
                      foreach ($menu_kayitlari as $menu) {
                    ?>
                    <option value="<?php echo DonusumleriGeriDondur($menu["id"]); ?>" <?php if (DonusumleriGeriDondur($urunler_bilgisi["MenuId"]) ==  DonusumleriGeriDondur($menu["id"])) { ?>selected="selected"<?php }?>>(<?php echo DonusumleriGeriDondur($menu["UrunTuru"]); ?>)  <?php echo DonusumleriGeriDondur($menu["MenuAdi"]); ?></option>
                  <?php
                    }
                  ?>
              </select>
          </div>
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Ürünün Adı: </div>
              <input type="text" name="UrunAdi" value="<?php echo DonusumleriGeriDondur($urunler_bilgisi["UrunAdi"]); ?>" class="UrunlerFormTextInputAlani">
          </div>
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Ürünün Fiyatı: </div>
              <input type="text" name="UrunFiyati" value="<?php echo DonusumleriGeriDondur($urunler_bilgisi["UrunFiyati"]); ?>" class="UrunlerFormTextInputAlani">
          </div>
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Para Birimi: </div>
                <select name="ParaBirimi" class="FormSelectAlani">
                    <option value="TRY" <?php if (DonusumleriGeriDondur($urunler_bilgisi["ParaBirimi"]) == "TRY") { ?>selected="selected"<?php }?>>türk Lirası</option>
                    <option value="EUR" <?php if (DonusumleriGeriDondur($urunler_bilgisi["ParaBirimi"]) == "EUR") { ?>selected="selected"<?php }?>>Euro</option>
                    <option value="USD" <?php if (DonusumleriGeriDondur($urunler_bilgisi["ParaBirimi"]) == "USD") { ?>selected="selected"<?php }?>>Amerikan Doları</option>
                </select>
          </div>
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">KDV Oranı: </div>
               <input type="text" name="KDVOrani" value="<?php echo DonusumleriGeriDondur($urunler_bilgisi["KDVOrani"]); ?>" class="UrunlerFormTextInputAlani">
          </div>
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Kargo Ücreti: </div>
              <input type="text" name="KargoUcreti" value="<?php echo DonusumleriGeriDondur($urunler_bilgisi["KargoUcreti"]); ?>" class="UrunlerFormTextInputAlani">
          </div>
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Ürün Açıklaması: </div>
              <textarea name="UrunAciklamasi" class="textAreaAlanlari"><?php echo DonusumleriGeriDondur($urunler_bilgisi["UrunAciklamasi"]); ?></textarea>
          </div>
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">ÜrünResmi1: </div>
              <input type="file" name="UrunResmiBir" style="margin-top: 30px;">
          </div>
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">ÜrünResmi2: </div>
              <input type="file" name="UrunResmiIki" style="margin-top: 30px;">
          </div>
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">ÜrünResmi3: </div>
              <input type="file" name="UrunResmiUc" style="margin-top: 30px;">
          </div>
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">ÜrünResmi4: </div>
              <input type="file" name="UrunResmi4" style="margin-top: 30px;">
          </div>             
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Varyant Başlığı: </div>
              <input type="text" name="VaryantBasligi" class="UrunlerFormTextInputAlani" value="<?php echo DonusumleriGeriDondur($urunler_bilgisi["VaryantBasligi"]); ?>">
          </div>
          <?php
                 $varyantler_sorgu=$baglan->prepare("SELECT * FROM urunvaryantlari WHERE UrunId=?");
                 $varyantler_sorgu->execute([$GelenID]);
                 $varyantler_sayi=$varyantler_sorgu->rowCount();
                 $varyantler_bilgisi=$varyantler_sorgu->fetchAll(PDO::FETCH_ASSOC);

                 $varyantIsimDizisi=array();//boş dixiler oluşturduk.
                 $varyantStokDizisi=array();

                 foreach ($varyantler_bilgisi as $varyant) {
                  $varyantIsimDizisi[]=$varyant["VaryantAdi"];
                  $varyantStokDizisi[]=$varyant["StokAdedi"];
                }
//dizinin anahtarlarını alabilmek için arry_key_exsit fonk . u kullanıdım.
                //ilk varyant zaten zorunlu onu if else ile boş mu dolumu kontrole gerek yok sokmama gerek yok.
                if (array_key_exists(1, $varyantIsimDizisi)) {
                 $ikinciVaryantAdi=DonusumleriGeriDondur($varyantIsimDizisi[1]);
                 $ikinciVaryantStok=DonusumleriGeriDondur($varyantStokDizisi[1]);
                }else{
                     $ikinciVaryantAdi="";
                     $ikinciVaryantStok="";
                }
                if (array_key_exists(2, $varyantIsimDizisi)) {
                   $ucuncuVaryantAdi=DonusumleriGeriDondur($varyantIsimDizisi[2]);
                   $ucuncuVaryantStok=DonusumleriGeriDondur($varyantStokDizisi[2]);
                }else{
                 $ucuncuVaryantAdi="";
                 $ucuncuVaryantStok="";
                }
                if (array_key_exists(3, $varyantIsimDizisi)) {
                     $dorduncuVaryantAdi=DonusumleriGeriDondur($varyantIsimDizisi[3]);
                    $dorduncuVaryantStok=DonusumleriGeriDondur($varyantStokDizisi[3]);
                }else{
                  $dorduncuVaryantAdi="";
                   $dorduncuVaryantStok="";
                }

                 if (array_key_exists(4, $varyantIsimDizisi)) {
                     $besinciVaryantAdi=DonusumleriGeriDondur($varyantIsimDizisi[4]);
                    $besinciVaryantStok=DonusumleriGeriDondur($varyantStokDizisi[4]);
                }else{
                  $besinciVaryantAdi="";
                   $besinciVaryantStok="";
                }
        ?>      
        <div class="UrunlerFormSatirAlani">
          <div class="UrunlerVaryantAlani">
              <div class="UrunlerVaryantFormBaslikMetni">1. Varyant Adı: </div>
              <input type="text" name="VaryantAdi" class="UrunlerVaryantFormTextInputAlani" value="<?php echo DonusumleriGeriDondur($varyantIsimDizisi[0]); ?>"> 

              <div class="UrunlerVaryantFormBaslikMetni">2. Varyant Adı: </div>
              <input type="text" name="VaryantAdi2" class="UrunlerVaryantFormTextInputAlani" value="<?php echo $ikinciVaryantAdi; ?>">

              <div class="UrunlerVaryantFormBaslikMetni">3. Varyant Adı: </div>
              <input type="text" name="VaryantAdi3" value="<?php echo $ucuncuVaryantAdi; ?>" class="UrunlerVaryantFormTextInputAlani">

              <div class="UrunlerVaryantFormBaslikMetni">4. Varyant Adı: </div>
              <input type="text" name="VaryantAdi4" value="<?php echo $dorduncuVaryantAdi; ?>" class="UrunlerVaryantFormTextInputAlani">

              <div class="UrunlerVaryantFormBaslikMetni">5. Varyant Adı: </div>
              <input type="text" name="VaryantAdi5" value="<?php echo $besinciVaryantAdi; ?>" class="UrunlerVaryantFormTextInputAlani">
          </div>

          <div class="UrunlerStokAlani">
              <div class="UrunlerVaryantFormBaslikMetni">1. Varyant Stok Adedi </div>
              <input type="text" name="StokAdedi" value="<?php echo DonusumleriGeriDondur($varyantStokDizisi[0]); ?>"class="UrunlerVaryantFormTextInputAlani">

              <div class="UrunlerVaryantFormBaslikMetni">2. Varyant Stok Adedi </div>
              <input type="text" name="StokAdedi2" class="UrunlerVaryantFormTextInputAlani" value="<?php echo $ikinciVaryantStok; ?>">

              <div class="UrunlerVaryantFormBaslikMetni">3. Varyant Stok Adedi </div>
              <input type="text" name="StokAdedi3" value="<?php echo $ucuncuVaryantStok; ?>"class="UrunlerVaryantFormTextInputAlani">

              <div class="UrunlerVaryantFormBaslikMetni">4. Varyant Stok Adedi </div>
              <input type="text" name="StokAdedi4" value="<?php echo $dorduncuVaryantStok; ?>" class="UrunlerVaryantFormTextInputAlani"> 

              <div class="UrunlerVaryantFormBaslikMetni">5. Varyant Stok Adedi </div>
              <input type="text" name="StokAdedi5" value="<?php echo $besinciVaryantStok; ?>" class="UrunlerVaryantFormTextInputAlani">
          </div><!-- stok lanı bitişi-->
      </div>
      <div class="ButonKapsamaAlani">
                <input type="submit" value="Güncelle" class="FormYesilButonu">
      </div>
      </form>
    </div><!--  yuzluk alan \-->
  </div>
</div>
<?php
}else{
  header("Location:index.php?SKD=0&SKI=101");//guncelle hata
  exit();
}

}else{
    header("Location:index.php");//kullanıcı yoksa index e atıcak bu sayfaya girmek istediğimde
    exit();
}

?>






































