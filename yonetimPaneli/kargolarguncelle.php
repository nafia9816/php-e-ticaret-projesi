<?php
 if (isset($_SESSION["Yonetici"])) {

  if (isset($_GET["ID"])) {
     $GelenID=guvenlik($_GET["ID"]);
   }else{
     $GelenID="";
   }  
   $kargo_sorgu=$baglan->prepare("SELECT * FROM kargofirmalari WHERE id=? LIMIT 1");
   $kargo_sorgu->execute([$GelenID]);
   $kargo_sayi=$kargo_sorgu->rowCount();
   $kargo_bilgisi=$kargo_sorgu->fetch(PDO::FETCH_ASSOC);
   if ($kargo_sayi>0){
?>
<div id="UrunGuncelleTamSayfaCerceveAlani">
    <div id="UrunGuncelleTamSayfaCerceveSinirlamaAlani">
      <div id="TamSayfadaYuzlukAlan">
        <div class="UrunlerBaslik">KARGO FİRMASI GÜNCELLE</div>
        <form action="index.php?SKD=0&SKI=27&ID=<?php echo $GelenID; ?>" method="POST" enctype="multipart/form-data">
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Kargo Firmasının Logosu: </div>
              <input type="file" name="FirmaLogosu" class="UrunlerFormTextInputAlani" style="padding-top: 5px;">
          </div>
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Bankanın Adı: </div>
              <input type="text" name="FirmaAdi" value="<?php echo DonusumleriGeriDondur($kargo_bilgisi["FirmaAdi"]); ?>" class="UrunlerFormTextInputAlani">
          </div>
          <div class="ButonKapsamaAlani">
              <input type="submit" value="Güncelle" class="FormYesilButonu">
          </div>
        </form>
      </div><!--  yuzluk alan \-->
    </div>
</div>
<?php
}else{//kargo guncellenemdiyse
  header("Location:index.php?SKD=0&SKI=29");//hata
  exit();
}

}else{
    header("Location:index.php");//kullanıcı yoksa index e atıcak bu sayfaya girmek istediğimde
    exit();
}

?>

