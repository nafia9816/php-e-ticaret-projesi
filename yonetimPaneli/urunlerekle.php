<?php
if (isset($_SESSION["Yonetici"])) {
?>

<div id="UrunGuncelleTamSayfaCerceveAlani">
  <div id="UrunGuncelleTamSayfaCerceveSinirlamaAlani">
    <div id="TamSayfadaYuzlukAlan">
      <div class="UrunlerBaslik">ÜRÜN EKLE</div>
      <form action="index.php?SKD=0&SKI=95" method="POST" enctype="multipart/form-data">
          <div class="UrunlerFormSatirAlani">
            <div class="UrunlerFormBaslikMetni">Ürün Menüsü: </div>
              <select name="UrunMenusu" class="FormSelectAlani">
                <option value="">Lütfen Seçiniz..</option>
                <?php //açılır kutu şeklinde menuleri getiriyoruz
                 $menuler_sorgusu=$baglan->prepare("SELECT * FROM menuler ORDER BY UrunTuru ASC, MenuAdi ASC");
                 $menuler_sorgusu->execute([1]);
                 $menu_kontrol=$menuler_sorgusu->rowCount();
                 $menu_kayitlari=$menuler_sorgusu->fetchAll(PDO::FETCH_ASSOC);
                 foreach ($menu_kayitlari as $menu) {
                ?>
                <option value="<?php echo DonusumleriGeriDondur($menu["id"]); ?>">(<?php echo DonusumleriGeriDondur($menu["UrunTuru"]); ?>)  <?php echo DonusumleriGeriDondur($menu["MenuAdi"]); ?></option>
                <?php
                 }
                 ?>
              </select>
          </div>
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Ürünün Adı: </div>
              <input type="text" name="UrunAdi" class="UrunlerFormTextInputAlani">
          </div>
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Ürünün Fiyatı: </div>
              <input type="text" name="UrunFiyati" class="UrunlerFormTextInputAlani">
          </div>
          <div class="UrunlerFormSatirAlani">
            <div class="UrunlerFormBaslikMetni">Para Birimi: </div>
            <select name="ParaBirimi" class="FormSelectAlani">
              <option value="">Lütfen Seçiniz..</option>
              <option value="TRY">türk Lirası</option>
              <option value="EUR">Euro</option>
              <option value="USD">Amerikan Doları</option>
            </select>
          </div>
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">KDV Oranı: </div>
               <input type="text" name="KDVOrani" class="UrunlerFormTextInputAlani">
          </div>
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Kargo Ücreti: </div>
              <input type="text" name="KargoUcreti" class="UrunlerFormTextInputAlani">
          </div>
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Ürün Açıklaması: </div>
              <textarea name="UrunAciklamasi" class="textAreaAlanlari"></textarea>
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
              <input type="text" name="VaryantBasligi" class="UrunlerFormTextInputAlani">
          </div>
          <div class="UrunlerFormSatirAlani">
            <div class="UrunlerVaryantAlani">
              <div class="UrunlerVaryantFormBaslikMetni">1. Varyant Adı: </div>
              <input type="text" name="VaryantAdi" class="UrunlerVaryantFormTextInputAlani"> 

              <div class="UrunlerVaryantFormBaslikMetni">2. Varyant Adı: </div>
              <input type="text" name="VaryantAdi2" class="UrunlerVaryantFormTextInputAlani">

              <div class="UrunlerVaryantFormBaslikMetni">3. Varyant Adı: </div>
              <input type="text" name="VaryantAdi3" class="UrunlerVaryantFormTextInputAlani">

              <div class="UrunlerVaryantFormBaslikMetni">4. Varyant Adı: </div>
              <input type="text" name="VaryantAdi4" class="UrunlerVaryantFormTextInputAlani">

              <div class="UrunlerVaryantFormBaslikMetni">5. Varyant Adı: </div>
              <input type="text" name="VaryantAdi5" class="UrunlerVaryantFormTextInputAlani">
            </div>
            <div class="UrunlerStokAlani">
              <div class="UrunlerVaryantFormBaslikMetni">1. Varyant Stok Adedi </div>
              <input type="text" name="StokAdedi" class="UrunlerVaryantFormTextInputAlani">

              <div class="UrunlerVaryantFormBaslikMetni">2. Varyant Stok Adedi </div>
              <input type="text" name="StokAdedi2" class="UrunlerVaryantFormTextInputAlani">

              <div class="UrunlerVaryantFormBaslikMetni">3. Varyant Stok Adedi </div>
              <input type="text" name="StokAdedi3" class="UrunlerVaryantFormTextInputAlani">

              <div class="UrunlerVaryantFormBaslikMetni">4. Varyant Stok Adedi </div>
              <input type="text" name="StokAdedi4" class="UrunlerVaryantFormTextInputAlani">

              <div class="UrunlerVaryantFormBaslikMetni">5. Varyant Stok Adedi </div>
              <input type="text" name="StokAdedi5" class="UrunlerVaryantFormTextInputAlani">
            </div>
          </div><!-- urunler form satır alanı bitişi-->
          <div class="ButonKapsamaAlani">
              <input type="submit" value="Kaydet" class="FormYesilButonu">
          </div>
        </form>
      </div><!--  yuzluk alan \-->
     </div>
 </div>
<?php
}else{
    header("Location:index.php");//kullanıcı yoksa index e atıcak bu sayfaya girmek istediğimde
    exit();
}

?>






































