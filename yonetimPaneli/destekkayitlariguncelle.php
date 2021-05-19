<?php
 if (isset($_SESSION["Yonetici"])) {
  if (isset($_GET["ID"])) {
     $GelenID=guvenlik($_GET["ID"]);
   }else{
     $GelenID="";
   }
  
   $destek_sorgu=$baglan->prepare("SELECT * FROM sorular WHERE id=? LIMIT 1");

   $destek_sorgu->execute([$GelenID]);
   $destek_sayi=$destek_sorgu->rowCount();
   $destek_bilgisi=$destek_sorgu->fetch(PDO::FETCH_ASSOC);
   if ($destek_sayi>0){
?>
 <div id="UrunGuncelleTamSayfaCerceveAlani">
     <div id="UrunGuncelleTamSayfaCerceveSinirlamaAlani">
      <div id="TamSayfadaYuzlukAlan">
        <div class="UrunlerBaslik">DESTEK İÇERİK GÜNCELLE</div>
       
            
        <form action="index.php?SKD=0&SKI=51&ID=<?php echo $GelenID; ?>" method="POST">
              <div class="HavaleDetayAlani">
              <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Soru: </div>
              <input type="text" name="soru" value="<?php echo DonusumleriGeriDondur($destek_bilgisi["soru"]); ?>" class="UrunlerFormTextInputAlani">
              </div>
              
              <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Cevap: </div>
              <textarea name="cevap" class="textAreaAlanlari"><?php echo DonusumleriGeriDondur($destek_bilgisi["cevap"]); ?></textarea>
              </div>

              <div class="ButonKapsamaAlani">
                <input type="submit" value="Güncelle" class="FormYesilButonu">
              </div>
              </div>
            </form>


      </div><!--  yuzluk alan \-->




     </div>
 </div>


<?php
}else{
  header("Location:index.php?SKD=0&SKI=53");
  exit();
}


}else{
    header("Location:index.php");//kullanıcı yoksa index e atıcak bu sayfaya girmek istediğimde
    exit();
}

?>
