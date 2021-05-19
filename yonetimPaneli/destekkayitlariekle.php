<?php
 if (isset($_SESSION["Yonetici"])) {
?>
<div id="UrunGuncelleTamSayfaCerceveAlani">
  <div id="UrunGuncelleTamSayfaCerceveSinirlamaAlani">
    <div id="TamSayfadaYuzlukAlan">
      <div class="UrunlerBaslik">DESTEK İÇERİKLERİ</div>
      <form action="index.php?SKD=0&SKI=47" method="POST" enctype="multipart/form-data">
        <div class="HavaleDetayAlani">
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Soru: </div>
              <input type="text" name="soru" class="UrunlerFormTextInputAlani">
          </div>
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Cevap: </div>
              <textarea name="cevap" class="textAreaAlanlari"></textarea>
          </div>
          <div class="ButonKapsamaAlani">
                <input type="submit" value="Kaydet" class="FormYesilButonu">
          </div>
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
