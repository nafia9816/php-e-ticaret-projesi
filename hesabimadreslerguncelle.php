<?php
if (isset($_SESSION["Kullanici"])) {//kullanıcı girişi varsa bu sayfayı görüntüleyebilsin
    if (isset($_GET["ID"])){//hangi kaydı güncelleyeceğime dair id alıyorum.
        $GelenId=guvenlik($_GET["ID"]);
    }else{
        $GelenId="";
    }

    if ($GelenId!="") {
      $adresSorgusu=$baglan->prepare("SELECT * FROM adresler WHERE id=? AND UyeId=? LIMIT 1");
      $adresSorgusu->execute([$GelenId,$KullaniciId]);
      $adres_kayit_sayisi=$adresSorgusu->rowCount(); //kayıt varmı
      $adres_kayitlari=$adresSorgusu->fetch(PDO::FETCH_ASSOC);
      if ($adres_kayit_sayisi>0) {   
?>
<div id="TamSayfaCerceveAlani">
    <div id="TamSayfaCerceveSinirlamaAlani">
     <div id="CerceveIciAlaniElliSolAlan">
     	<div id="TamSayfadaAltiCiziliBaslikAlani">
         <div id="BaslikMetni">Hesabım & Adreslerim</div>
         <div id="AltBaslikMetni">Aşağıdan adres bilgilerini güncelleyebilirsiniz.</div>
        </div>

        <form action="index.php?sk=63&ID=<?php echo $GelenId; ?>" method="POST">
            <div class="FormBaslikMetni">İsim Soyisim(* zorunlu)</div>
            <div class="FormSatirAlani"><input type="text" name="AdSoyad" class="FormTextInputAlani" value="<?php echo $adres_kayitlari["AdSoyad"] ?>">
            </div>

            <div class="FormBaslikMetni"> Açık Adres(* zorunlu)</div>
            <div class="FormSatirAlani"><input type="text" name="Adres" class="FormTextInputAlani" value="<?php echo $adres_kayitlari["Adres"] ?>">
            </div>

            <div class="FormBaslikMetni">İlçe(* zorunlu)</div>
            <div class="FormSatirAlani"><input type="text" name="Ilce" class="FormTextInputAlani" value="<?php echo $adres_kayitlari["Ilce"] ?>" tabindex="3">
            </div>

            <div class="FormBaslikMetni">Şehir (* zorunlu) </div>
            <div class="FormSatirAlani"><input type="text" name="Sehir" class="FormTextInputAlani" value="<?php echo $adres_kayitlari["Sehir"] ?>">
            </div>
            
            <div class="FormBaslikMetni">Telefon Numarası</div>
            <div class="FormSatirAlani"><input type="text" name="TelefonNumarasi" maxlength="11" value="<?php echo $adres_kayitlari["TelefonNumarasi"] ?>" class="FormTextInputAlani" tabindex="3">
            </div>
            
            <div class="ButonKapsamaAlani">
            	<input type="submit" value="Güncelle" class="FormTuruncuButonu">
            </div>
        </form>
    </div> <!-- sol alan bitişi -->
    <div id="CerceveIciAlaniElliSagAlan">
     	<div id="TamSayfadaAltiCiziliBaslikAlani">
           <div id="BaslikMetni">REKLAM</div>
           <div id="AltBaslikMetni">NACOFF.com da En Çok Satılan Kupa!</div>
        </div>
        <div class="ReklamKapsamaAlani">
                <div class ="ReklamResimleri">
                   <a href="index.php?sk=83&ID=23"> <img src="img/urunler/kupa/fe174317f50790679951a318e.jpg" border="0"> </a>
                </div>
        </div>
    </div> <!-- sağ alan bitşi -->



    </div>
 </div>

<?php
  }else{
    header("Location:index.php?sk=65");//guncelle hata
    exit();
  }


 }else{//gelen id nin boş doluluğunu kontrol eder
    header("Location:index.php?sk=65");//guncelle hata
    exit();
 }
}else{
    header("Location:index.php");//kullanıcı yoksa index e atıcak bu sayfaya girmek istediğimde
    exit();
}

?>





































