<?php
 if (isset($_SESSION["Yonetici"])) {
?>
<div id="UrunGuncelleTamSayfaCerceveAlani">
  <div id="UrunGuncelleTamSayfaCerceveSinirlamaAlani">
    <div id="TamSayfadaYuzlukAlan">
      <div class="UrunlerBaslik">BANNER EKLE</div>
      <form action="index.php?SKD=0&SKI=35" method="POST" enctype="multipart/form-data">              
        <div class="UrunlerFormSatirAlani">
          <div class="UrunlerFormBaslikMetni">Banner Adı: </div>
          <input type="text" name="BannerAdi" class="UrunlerFormTextInputAlani">
        </div>
        <div class="UrunlerFormSatirAlani">
          <div class="UrunlerFormBaslikMetni">Banner Alanı: </div>
          <select name="BannerAlani" class="UrunlerFormSelectAlani">
                  <option value="">Lütfen Seçiniz..</option>
                  <option value="Menu Altı">Menu Altı</option>
                  <option value="Ana Sayfa">Ana Sayfa</option>
                  <option value="urunDetay">urunDetay</option>
           </select> 
        </div>
        <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">ÜrünResmi3: </div>
              <input type="file" name="BannerResmi" class="UrunlerFormTextInputAlani" style="padding-top: 5px;">
        </div>
        <div class="ButonKapsamaAlani">
                <input type="submit" value="Kaydet" class="FormYesilButonu">
        </div>
      </form>
    </div><!--  yuzluk alan \-->
  </div>
</div>
<?php
}else{
  header("Location:index.php?SKD=1");
  exit();
}

?>
