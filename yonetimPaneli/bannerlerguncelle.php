<?php
 if (isset($_SESSION["Yonetici"])) {
  if (isset($_GET["ID"])) {
     $GelenID=guvenlik($_GET["ID"]);
   }else{
     $GelenID="";
   }
  
   $banner_sorgu=$baglan->prepare("SELECT * FROM bannerler WHERE id=? LIMIT 1");
   $banner_sorgu->execute([$GelenID]);
   $banner_sayi=$banner_sorgu->rowCount();
   $banner_bilgisi=$banner_sorgu->fetch(PDO::FETCH_ASSOC);
   if ($banner_sayi>0){
?>
 <div id="UrunGuncelleTamSayfaCerceveAlani">
    <div id="UrunGuncelleTamSayfaCerceveSinirlamaAlani">
      <div id="TamSayfadaYuzlukAlan">
        <div class="UrunlerBaslik">BANNER GÜNCELLE</div>
        <form action="index.php?SKD=0&SKI=39&ID=<?php echo $GelenID; ?>" method="POST" enctype="multipart/form-data">            
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Banner Adı: </div>
              <input type="text" name="BannerAdi" value="<?php echo DonusumleriGeriDondur($banner_bilgisi["BannerAdi"]); ?>" class="UrunlerFormTextInputAlani">
          </div>
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Banner Alanı: </div>
                <select name="BannerAlani" class="UrunlerFormSelectAlani">
                  <option value="">Lütfen Seçiniz..</option>
                  <option value="Menu Altı" <?php if (DonusumleriGeriDondur($banner_bilgisi["BannerAlani"]) =="Menu Altı") {?>selected="selected" <?php
                  } ?> >Menu Altı</option>
                  <option value="Ana Sayfa" <?php if (DonusumleriGeriDondur($banner_bilgisi["BannerAlani"]) =="Ana Sayfa") {?>selected="selected" <?php
                  } ?>>Ana Sayfa</option>
                  <option value="urunDetay" <?php if (DonusumleriGeriDondur($banner_bilgisi["BannerAlani"]) =="urunDetay") {?>selected="selected" <?php
                 } ?>>urunDetay</option>
                </select> 
            </div>
            <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Ürün Resmi: </div>
              <input type="file" name="BannerResmi" class="UrunlerFormTextInputAlani" style="padding-top: 5px;">
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
  header("Location:index.php?SKD=0&SKI=41");//hata
  exit();
}
}else{
  header("Location:index.php?SKD=1");
  exit();
}

?>
