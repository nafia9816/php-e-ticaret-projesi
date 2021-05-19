<?php
 if (isset($_SESSION["Yonetici"])) {
?>
<div id="UrunGuncelleTamSayfaCerceveAlani">
  <div id="UrunGuncelleTamSayfaCerceveSinirlamaAlani">
    <div id="TamSayfadaYuzlukAlan">
      <div class="UrunlerBaslik">BANKA HESABI EKLE</div>
      <form action="index.php?SKD=0&SKI=11" method="POST" enctype="multipart/form-data">
        <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Bankanın Logosu: </div>
              <input type="file" name="banka_logo" class="UrunlerFormTextInputAlani" style="padding-top: 4px;">
        </div>
        <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Bankanın Adı: </div>
              <input type="text" name="bankaAdi" class="UrunlerFormTextInputAlani">
        </div>
        <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Şube Adı: </div>
              <input type="text" name="subeAdi" class="UrunlerFormTextInputAlani">
        </div>
        <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Şube Kodu: </div>
              <input type="text" name="subeKodu" class="UrunlerFormTextInputAlani">
        </div>
        <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Bankanın Bulunduğu Şehir: </div>                            
              <input type="text" name="konumSehir" class="UrunlerFormTextInputAlani">
        </div>
        <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Bankanın Bulunduğu Ülke: </div>
              <input type="text" name="konumUlke" class="UrunlerFormTextInputAlani">
        </div>
        <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Hesabın Para Birimi: </div>
              <input type="text" name="paraBirimi" class="UrunlerFormTextInputAlani">
        </div>
        <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Hesabın Sahibi: </div>
              <input type="text" name="hesapSahibi" class="UrunlerFormTextInputAlani">
        </div>
        <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Hesabın Hesap Numarası: </div>
              <input type="text" name="hesapNum" class="UrunlerFormTextInputAlani">
        </div>
        <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Hesabın IBAN Bilgisi: </div>
              <input type="text" name="ibanNum" class="UrunlerFormTextInputAlani">
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

