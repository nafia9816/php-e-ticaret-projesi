<?php
 if (isset($_SESSION["Yonetici"])) {
?>

<div id="UrunGuncelleTamSayfaCerceveAlani">
  <div id="UrunGuncelleTamSayfaCerceveSinirlamaAlani">
    <div id="TamSayfadaYuzlukAlan">
      <div class="UrunlerBaslik">MENÜ EKLE</div>
      <form action="index.php?SKD=0&SKI=59" method="POST">
          <div class="UrunlerFormSatirAlani">
            <div class="UrunlerFormBaslikMetni">Menü Adı: </div>
            <input type="text" name="MenuAdi" class="UrunlerFormTextInputAlani">
          </div>
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Menü İçin Ürün Türü </div>            
              <select name="UrunTuru" class="FormSelectAlani">
               <option value="">Lütfen Seçiniz..</option>
               <option value="fincan">Fincan</option>
               <option value="kupa">Kupa</option>
               <option value="kahveyanibardak">Kahve Yanı Bardak</option>
               <option value="sunumluk">Sunumluk</option>
             </select>
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
