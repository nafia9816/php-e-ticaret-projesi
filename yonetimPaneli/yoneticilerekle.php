<?php
 if (isset($_SESSION["Yonetici"])) {
?>
 <div id="UrunGuncelleTamSayfaCerceveAlani">
     <div id="UrunGuncelleTamSayfaCerceveSinirlamaAlani">
      <div id="TamSayfadaYuzlukAlan">
        <div class="UrunlerBaslik">YÖNETİCİ EKLE</div>
        <form action="index.php?SKD=0&SKI=71" method="POST">
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Kullanıcı Adı: </div>
              <input type="text" name="KullaniciAdi" class="UrunlerFormTextInputAlani"> 
          </div>
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Şifre: </div>
              <input type="text" name="Sifre" class="UrunlerFormTextInputAlani">
          </div>
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Adı Soyadı: </div>
               <input type="text" name="IsimSoyisim" class="UrunlerFormTextInputAlani">
          </div>
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">E-mail Adresi: </div>
              <input type="email" name="EmailAdres" class="UrunlerFormTextInputAlani">
          </div>
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Telefon Numarası: </div>
              <input type="text" name="TelefonNumarasi" maxlength="11" class="UrunlerFormTextInputAlani">
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
