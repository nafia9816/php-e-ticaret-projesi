<?php
if (isset($_SESSION["Kullanici"])) {//kullanıcı girişi varsa bu sayfayı görüntüleyebilsin
?>
<div id="TamSayfaCerceveAlani">
     <div id="TamSayfaCerceveSinirlamaAlani">
     	<div id="CerceveIciAlaniElliSolAlan">
     		<div id="TamSayfadaAltiCiziliBaslikAlani">
                 <div id="BaslikMetni">Bilgi Güncelleme</div>
                 <!-- & yerine güzel bir unicode karaketr -->
                 <div id="AltBaslikMetni">Aşağıdan hesabına ait bilgileri güncelleyebilirsin!</div>
            </div>
            <form action="index.php?sk=52" method="POST">
            	<div class="FormBaslikMetni">Email Adresi</div>
            	<div class="FormSatirAlani"><input type="text" name="MailAdresi" value="<?php echo $KullaniciEmail; ?>" class="FormTextInputAlani"></div>

            	<div class="FormBaslikMetni">Şifre</div>
            	<div class="FormSatirAlani"><input type="password" name="Sifre" class="FormTextInputAlani" value="EskiSifre"></div>

            	<div class="FormBaslikMetni">Şifre Tekrar</div>
            	<div class="FormSatirAlani"><input type="password" name="SifreTekrar" value="EskiSifre" class="FormTextInputAlani">
                </div>

            	<div class="FormBaslikMetni">İsim Soyisim </div>
            	<div class="FormSatirAlani"><input type="text" name="IsimSoyisim" value="<?php echo $KullaniciIsimSoyisim ?>" class="FormTextInputAlani"></div>

            	<div class="FormBaslikMetni">Telefon Numarası</div>
            	<div class="FormSatirAlani"><input type="text" name="telefonNum" maxlength="11" value="<?php echo $KullaniciNumara; ?>" class="FormTextInputAlani">
            	</div>
            	
            	<div class="FormBaslikMetni">Cinsiyet</div>
            	<div class="FormSatirAlani">
                  <select name="Cinsiyet" class="FormSelectAlani">
                        <option value="Kadın" <?php if($KullaniciCinsiyet=="Kadın"){ ?> selected="selected" <?php } ?> >Kadın</option>
                        <option value="Erkek"<?php if($KullaniciCinsiyet=="Erkek"){ ?>selected="selected" <?php } ?> >Erkek</option>
                        
                    </select>
            	</div>
       	        <div class="ButonKapsamaAlani">
            		<input type="submit" value="Güncelle" class="FormYesilButonu">
            	</div>
            </form>
        </div> <!-- sol alan bitişi -->
        <div id="CerceveIciAlaniElliSagAlan">
     		<div id="TamSayfadaAltiCiziliBaslikAlani">
                 <div id="BaslikMetni">REKLAM</div>
                 <div id="AltBaslikMetni">NACOFF.com reklamları.</div>
                 <!-- çok satan ürün vb. gösterebilirsin -->
            </div>
            <div class="ReklamKapsamaAlani">
                <div class ="ReklamResimleri"><img src="img/reklam.jpg" border="0"></div>
            </div>
        </div> <!-- sağalan bitisi-->
</div>
</div>

<?php
}else{
    header("Location:index.php");//kullanıcı yoksa index e atıcak bu sayfaya girmek istediğimde
    exit();
}

?>
