<?php
 if (isset($_SESSION["Yonetici"])) {
  
  if (isset($_GET["ID"])) {
     $GelenID=guvenlik($_GET["ID"]);
   }else{
     $GelenID="";
   }
  
   $menu_sorgu=$baglan->prepare("SELECT * FROM menuler WHERE id=? LIMIT 1");
   $menu_sorgu->execute([$GelenID]);
   $menu_sayi=$menu_sorgu->rowCount();
   $menu_bilgisi=$menu_sorgu->fetch(PDO::FETCH_ASSOC);
   if ($menu_sayi>0){
?>

<div id="UrunGuncelleTamSayfaCerceveAlani">
  <div id="UrunGuncelleTamSayfaCerceveSinirlamaAlani">
    <div id="TamSayfadaYuzlukAlan">
      <div class="UrunlerBaslik">MENÜ GÜNCELLE</div>
      <form action="index.php?SKD=0&SKI=63&ID=<?php echo $GelenID; ?>" method="POST">
        <div class="UrunlerFormSatirAlani">
           <div class="UrunlerFormBaslikMetni">Menü Adı: </div>
           <input type="text" name="MenuAdi" value="<?php echo DonusumleriGeriDondur($menu_bilgisi["MenuAdi"]); ?>" class="UrunlerFormTextInputAlani">
        </div>
        <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Menü İçin Ürün Türü: </div>
              <div class="UrunlerFormBaslikMetni"><?php echo DonusumleriGeriDondur($menu_bilgisi["UrunTuru"]); ?></div>
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
  header("Location:index.php?SKD=0&SKI=65");
  exit();
}

}else{
    header("Location:index.php");//kullanıcı yoksa index e atıcak bu sayfaya girmek istediğimde
    exit();
}

?>
