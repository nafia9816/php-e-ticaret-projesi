<?php
 if (isset($_SESSION["Yonetici"])) {
?>
 <div id="UrunGuncelleTamSayfaCerceveAlani">
     <div id="UrunGuncelleTamSayfaCerceveSinirlamaAlani">
      <div id="TamSayfadaYuzlukAlan">
        <div class="UrunlerBaslik">SİTE AYARLARI</div>
   <!--  buradaki değişkenler ayarlar.php de yonetin tablosundan bilgileri çekip atadığım değişkenler-->                
        <form action="index.php?SKD=0&SKI=2" method="POST" enctype="multipart/form-data">
          <div class="UrunlerFormSatirAlani">
          <div class="UrunlerFormBaslikMetni">Sitenin Logosu: </div>
            <input type="file" name="sitelogo" class="UrunlerFormTextInputAlani" style="padding-top: 4px;">
          </div> 

          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Sitenin Adı: </div>
              <input type="text" name="siteAdi" value="<?php echo DonusumleriGeriDondur($adi); ?>" class="UrunlerFormTextInputAlani">
          </div>  

          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Sitenin Başlığı: </div>
              <input type="text" name="siteBaslik" value="<?php echo DonusumleriGeriDondur($baslik); ?>" class="UrunlerFormTextInputAlani">
          </div>

          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Site Açıklaması: </div>
              <textarea name="siteAciklama"  class="textAreaAlanlari"><?php echo DonusumleriGeriDondur($aciklama); ?></textarea>
          </div>
              
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Sitenin Anahtar Kelimeleri: </div>                            
                <input type="text" name="siteAnahtar" value="<?php echo DonusumleriGeriDondur($keywordss); ?>" class="UrunlerFormTextInputAlani">
          </div>
                           
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Copyright Metni: </div>
              <input type="text" name="sitecopy" value="<?php echo DonusumleriGeriDondur($copyMetni); ?>" class="UrunlerFormTextInputAlani">
          </div>

          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Sitenin Linki: </div>
              <input type="text" name="sitelink" value="<?php echo DonusumleriGeriDondur($SiteLinki); ?>" class="UrunlerFormTextInputAlani">
          </div>

          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Sitenin Maili: </div>
              <input type="text" name="sitemail" value="<?php echo DonusumleriGeriDondur($email); ?>" class="UrunlerFormTextInputAlani">
          </div>

          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Sitenin Şifresi: </div>
              <input type="text" name="sitesifre" value="<?php echo DonusumleriGeriDondur($sifre); ?>" class="UrunlerFormTextInputAlani">
          </div>

          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Sitenin Host Adresi: </div>
              <input type="text" name="sitehost" value="<?php echo DonusumleriGeriDondur($hostAdresi); ?>" class="UrunlerFormTextInputAlani">
          </div>

          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Sitenin Facebook Adresi: </div>
              <input type="text" name="siteface" value="<?php echo DonusumleriGeriDondur($face); ?>" class="UrunlerFormTextInputAlani">
          </div>

          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Sitenin Twitter Adresi: </div>
              <input type="text" name="sitetwit" value="<?php echo DonusumleriGeriDondur($twit); ?>" class="UrunlerFormTextInputAlani">
          </div>

          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Sitenin Linkedin Adresi: </div>
              <input type="text" name="sitelinkedin" value="<?php echo DonusumleriGeriDondur($linkedin); ?>" class="UrunlerFormTextInputAlani">
          </div>

          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Sitenin Instagram Adresi: </div>
              <input type="text" name="siteinstagram" value="<?php echo DonusumleriGeriDondur($instagram); ?>" class="UrunlerFormTextInputAlani">
          </div>

          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Sitenin Pinterest Adresi: </div>
              <input type="text" name="sitepinterest" value="<?php echo DonusumleriGeriDondur($pinterest); ?>" class="UrunlerFormTextInputAlani">
          </div>

          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Sitenin Youtube Adresi: </div>
              <input type="text" name="siteyoutube" value="<?php echo DonusumleriGeriDondur($youtube); ?>" class="UrunlerFormTextInputAlani">
          </div>

          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Dolar Kuru: </div>
              <input type="text" name="sitedolarKuru" value="<?php echo DonusumleriGeriDondur($dolarKuru); ?>" class="UrunlerFormTextInputAlani">
          </div>

          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Euro Kuru: </div>
              <input type="text" name="siteEuroKuru" value="<?php echo DonusumleriGeriDondur($EuroKuru); ?>" class="UrunlerFormTextInputAlani">
          </div>

          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Ücretsiz Kargo Barajı: </div>
              <input type="text" name="sitekargobaraj" value="<?php echo DonusumleriGeriDondur($ucretsizKargo); ?>" class="UrunlerFormTextInputAlani">
          </div>

          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Sanal POS Client Id: </div>
              <input type="text" name="siteClientID" value="<?php echo DonusumleriGeriDondur($ClientID); ?>" class="UrunlerFormTextInputAlani">
          </div>

          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Sanal POS StoreKey: </div>
              <input type="text" name="siteStoreKey" value="<?php echo DonusumleriGeriDondur($StoreKey); ?>" class="UrunlerFormTextInputAlani">
          </div>

          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Sanal POS API Adı: </div>
              <input type="text" name="siteApiKulanicisi" value="<?php echo DonusumleriGeriDondur($ApiKulanicisi); ?>" class="UrunlerFormTextInputAlani">
          </div>

          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Sanal POS API Şifresi: </div>
              <input type="text" name="siteApiSifre" value="<?php echo DonusumleriGeriDondur($ApiSifre); ?>" class="UrunlerFormTextInputAlani">
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
