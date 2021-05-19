<?php
 if (isset($_SESSION["Yonetici"])) {

?>
<div id="UrunGuncelleTamSayfaCerceveAlani">
  <div id="UrunGuncelleTamSayfaCerceveSinirlamaAlani">
    <div id="TamSayfadaYuzlukAlan">
      <div class="UrunlerBaslik">KARGO FİRMASI EKLE</div>
      <form action="index.php?SKD=0&SKI=23" method="POST" enctype="multipart/form-data">
        <div class="UrunlerFormSatirAlani">
          <div class="UrunlerFormBaslikMetni">Kargo Firmasının Logosu: </div>
          <input type="file" name="FirmaLogosu" class="UrunlerFormTextInputAlani" style="padding-top: 5px;">
        </div>
        <div class="UrunlerFormSatirAlani">
          <div class="UrunlerFormBaslikMetni">Bankanın Adı: </div>
          <input type="text" name="FirmaAdi" class="UrunlerFormTextInputAlani">
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
    header("Location:index.php");//kullanıcı yoksa index e atıcak bu sayfaya girmek istediğimde
    exit();
}

?>

