<?php
 if (isset($_SESSION["Yonetici"])) {

  if (isset($_GET["ID"])) {//hangi banka hesabının yanında guncelleye bastıysam o hesaabın ıd siget ile url den gelir.
     $GelenID=guvenlik($_GET["ID"]);
   }else{
     $GelenID="";
   }  
   $hesap_sorgu=$baglan->prepare("SELECT * FROM bankahesaplari WHERE id=? LIMIT 1");
   $hesap_sorgu->execute([$GelenID]);
   $hesap_sayi=$hesap_sorgu->rowCount();
   $hesap_bilgisi=$hesap_sorgu->fetch(PDO::FETCH_ASSOC);
   if ($hesap_sayi>0){
?>
<div id="UrunGuncelleTamSayfaCerceveAlani">
  <div id="UrunGuncelleTamSayfaCerceveSinirlamaAlani">
    <div id="TamSayfadaYuzlukAlan">
      <div class="UrunlerBaslik">BANKA HESABI GÜNCELLEME</div>
      <form action="index.php?SKD=0&SKI=15&ID=<?php echo $GelenID; ?>" method="POST" enctype="multipart/form-data">
        <div class="UrunlerFormSatirAlani">
          <div class="UrunlerFormBaslikMetni">Bankanın Logosu: </div>
                <input type="file" name="banka_logo" class="UrunlerFormTextInputAlani">
          </div>
          <div class="UrunlerFormSatirAlani">
                <div class="UrunlerFormBaslikMetni">Bankanın Adı: </div>
                <input type="text" name="bankaAdi" value="<?php echo DonusumleriGeriDondur($hesap_bilgisi["bankaAdi"]); ?>" class="UrunlerFormTextInputAlani">
          </div>
          <div class="UrunlerFormSatirAlani">
               <div class="UrunlerFormBaslikMetni">Şube Adı: </div>
               <input type="text" name="subeAdi" value="<?php echo DonusumleriGeriDondur($hesap_bilgisi["subeAdi"]); ?>" class="UrunlerFormTextInputAlani">
          </div>
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Şube Kodu: </div>
              <input type="text" name="subeKodu" value="<?php echo DonusumleriGeriDondur($hesap_bilgisi["subeKodu"]); ?>" class="UrunlerFormTextInputAlani">
          </div>
          <div class="UrunlerFormSatirAlani">
                <div class="UrunlerFormBaslikMetni">Bankanın Bulunduğu Şehir: </div>                            
                <input type="text" name="konumSehir" value="<?php echo DonusumleriGeriDondur($hesap_bilgisi["konumSehir"]); ?>" class="UrunlerFormTextInputAlani">
          </div>
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Bankanın Bulunduğu Ülke: </div>
              <input type="text" name="konumUlke" value="<?php echo DonusumleriGeriDondur($hesap_bilgisi["konumUlke"]); ?>" class="UrunlerFormTextInputAlani">
          </div>
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Hesabın Para Birimi: </div>
              <input type="text" name="paraBirimi" value="<?php echo DonusumleriGeriDondur($hesap_bilgisi["paraBirimi"]); ?>" class="UrunlerFormTextInputAlani">
          </div>
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Hesabın Sahibi: </div>
              <input type="text" name="hesapSahibi" value="<?php echo DonusumleriGeriDondur($hesap_bilgisi["hesapSahibi"]); ?>" class="UrunlerFormTextInputAlani">
          </div>
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Hesabın Hesap Numarası: </div>
              <input type="text" name="hesapNum" value="<?php echo DonusumleriGeriDondur($hesap_bilgisi["hesapNum"]); ?>" class="UrunlerFormTextInputAlani">
          </div>
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Hesabın IBAN Bilgisi: </div>
              <input type="text" name="ibanNum" value="<?php echo DonusumleriGeriDondur($hesap_bilgisi["ibanNum"]); ?>" class="UrunlerFormTextInputAlani">
          </div>
          <div class="ButonKapsamaAlani">
                <input type="submit" value="Güncelle" class="FormYesilButonu">
          </div>
        </form>
      </div><!--  yuzluk alan \-->
    </div>
 </div>
<?php

}else{//banka hesabı guncellenmedıse
  header("Location:index.php?SKD=0&SKI=17");//hata
  exit();
}

}else{
    header("Location:index.php");//kullanıcı yoksa index e atıcak bu sayfaya girmek istediğimde
    exit();
}

?>
