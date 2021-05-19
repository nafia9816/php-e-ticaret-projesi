<?php
 if (isset($_SESSION["Yonetici"])) {
  
  if (isset($_GET["ID"])) {
     $GelenID=guvenlik($_GET["ID"]);
   }else{
     $GelenID="";
   }
  
   $yoneticiler_sorgu=$baglan->prepare("SELECT * FROM yoneticiler WHERE id=? LIMIT 1");
   $yoneticiler_sorgu->execute([$GelenID]);
   $yonetici_sayi=$yoneticiler_sorgu->rowCount();
   $yonetici_bilgisi=$yoneticiler_sorgu->fetch(PDO::FETCH_ASSOC);
   if ($yonetici_sayi>0){
?>
<div id="UrunGuncelleTamSayfaCerceveAlani">
  <div id="UrunGuncelleTamSayfaCerceveSinirlamaAlani">
    <div id="TamSayfadaYuzlukAlan">
      <div class="UrunlerBaslik">
            <span class="baslikSagTaraf">YÖNETİCİ GÜNCELLE</span>  <span class="baslikSolTaraf"><a href="index.php?SKD=0&SKI=94"> yeni yönetici ekle</a></span>
      </div>
      <form action="index.php?SKD=0&SKI=75&ID=<?php echo $GelenID; ?>" method="POST">
        <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Kullanıcı Adı: </div>
              <div class="UrunlerFormBaslikMetni"><?php echo DonusumleriGeriDondur($yonetici_bilgisi["KullaniciAdi"]); ?>
                 <!-- kullanıcı adı hiçbirzaamn değiştirilemez olmalıdır --> </div>
        </div>
        <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Şifre: </div>
              <input type="text" name="Sifre" value="" class="UrunlerFormTextInputAlani">
              
        </div>
        (* Yöneticinin şifresini güncellemek istemiyorsanız lütfen boş geçiniz.)
        <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Adı Soyadı: </div>
               <input type="text" name="IsimSoyisim" value="<?php echo DonusumleriGeriDondur($yonetici_bilgisi["IsimSoyisim"]); ?>" class="UrunlerFormTextInputAlani">
        </div>
        <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">E-mail Adresi: </div>
              <input type="email" name="EmailAdres" value="<?php echo DonusumleriGeriDondur($yonetici_bilgisi["EmailAdres"]); ?>" class="UrunlerFormTextInputAlani">
        </div>
        <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Telefon Numarası: </div>
              <input type="text" name="TelefonNumarasi" value="<?php echo DonusumleriGeriDondur($yonetici_bilgisi["TelefonNumarasi"]); ?>" maxlength="11" class="UrunlerFormTextInputAlani">
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
  header("Location:index.php?SKD=0&SKI=53");//hata
  exit();
}

}else{
    header("Location:index.php");//kullanıcı yoksa index e atıcak bu sayfaya girmek istediğimde
    exit();
}

?>
