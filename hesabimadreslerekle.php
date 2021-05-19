<?php
if (isset($_SESSION["Kullanici"])) {//kullanıcı girişi varsa bu sayfayı görüntüleyebilsin
?>

<div id="TamSayfaCerceveAlani">
    <div id="TamSayfaCerceveSinirlamaAlani">
     <div id="CerceveIciAlaniElliSolAlan">
     	<div id="TamSayfadaAltiCiziliBaslikAlani">
         <div id="BaslikMetni">Hesabım & Adreslerim</div>
           <div id="AltBaslikMetni">Aşağıdan yeni adres ekleyebilirsiniz.</div>
        </div>
        <form action="index.php?sk=71" method="POST">
            <div class="FormBaslikMetni">İsim Soyisim(* zorunlu)</div>
            <div class="FormSatirAlani"><input type="text" name="AdSoyad" class="FormTextInputAlani"> </div>

            <div class="FormBaslikMetni"> Açık Adres(* zorunlu)</div>
            <div class="FormSatirAlani"><input type="text" name="Adres" class="FormTextInputAlani"> </div>

            <div class="FormBaslikMetni">İlçe(* zorunlu)</div>
            <div class="FormSatirAlani"><input type="text" name="Ilce" class="FormTextInputAlani"> </div>

            <div class="FormBaslikMetni">Şehir (* zorunlu) </div>
            <div class="FormSatirAlani"><input type="text" name="Sehir" class="FormTextInputAlani"> </div>
            
            <div class="FormBaslikMetni">Telefon Numarası</div>
            <div class="FormSatirAlani"><input type="text" name="TelefonNumarasi" maxlength="11" class="FormTextInputAlani"></div>
            
            <div class="ButonKapsamaAlani">
            	<input type="submit" value="Ekle" class="FormYesilButonu">
            </div>

        </form>
    </div> <!-- sol alan kapması -->
    <div id="CerceveIciAlaniElliSagAlan">
     	<div id="TamSayfadaAltiCiziliBaslikAlani">
            <div id="BaslikMetni">REKLAM</div>
            <div id="AltBaslikMetni">NACOFF.com da Çok Satılan Ürün.</div><!-- çok satan ürün vb. gösterebilirsin --></div>
            <div class="ReklamKapsamaAlani">
              <div class ="ReklamResimleri"><a href="index.php?sk=83&ID=5"><img src="img/adreseklereklamalani.jpg" border="0"></a>
              </div>
            </div>
    </div><!-- sağ alan bitişi-->

   </div>
</div>

<?php
}else{
    header("Location:index.php");//kullanıcı yoksa index e atıcak bu sayfaya girmek istediğimde
    exit();
}

?>






































