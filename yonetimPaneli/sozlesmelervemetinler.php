<?php
 if (isset($_SESSION["Yonetici"])) {
?>
 <div id="UrunGuncelleTamSayfaCerceveAlani">
     <div id="UrunGuncelleTamSayfaCerceveSinirlamaAlani">
      <div id="TamSayfadaYuzlukAlan">
        <div class="UrunlerBaslik">SÖZLEŞME VE METİNLER</div>
   <!--  buradaki değişkenler ayarlar.php de sözlesmevemetinler tablosundan bilgileri çekip atadığım değişkenler-->                
        <form action="index.php?SKD=0&SKI=6" method="POST" enctype="multipart/form-data">
          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Hakkımızda Metni: </div>
              <textarea name="hakkimizdaMetni"  class="textAreaAlanlari"><?php echo DonusumleriGeriDondur($hakkimizdaM); ?> </textarea>
          </div>

          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Üyelik Sözleşmesi Metni: </div>
              <textarea name="uyelikSozMetni"  class="textAreaAlanlari"><?php echo DonusumleriGeriDondur($uyelikSozM); ?> </textarea>
          </div>

          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Kullanım Koşulları Metni: </div>
              <textarea name="kullanımKosullariMetni"  class="textAreaAlanlari"><?php echo DonusumleriGeriDondur($kullanımKosullariM); ?> </textarea>
          </div>

          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Gizlilik Sözleşmesi Metni: </div>
              <textarea name="gizlilikSozMetni"  class="textAreaAlanlari"><?php echo DonusumleriGeriDondur($gizlilikSozM); ?> </textarea>
          </div>

          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Mesafeli Satış Sözleşmesi Metni: </div>
              <textarea name="mesafeliSatisMetni"  class="textAreaAlanlari"><?php echo DonusumleriGeriDondur($mesafeliSatisM); ?> </textarea>
          </div> 

          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">Teslimat Metni: </div>
              <textarea name="teslimatMetni"  class="textAreaAlanlari"><?php echo DonusumleriGeriDondur($teslimatM); ?> </textarea>
          </div>         

          <div class="UrunlerFormSatirAlani">
              <div class="UrunlerFormBaslikMetni">İptal İade Metni: </div>
              <textarea name="iptalIadeDegisimMetni"  class="textAreaAlanlari"><?php echo DonusumleriGeriDondur($iptalIadeDegisimM); ?> </textarea>
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
