<?php
if (isset($_SESSION["Kullanici"])) {//kullanıcı girişi varsa bu sayfayı görüntüleyebilsin
?>
<div id="TamSayfaCerceveAlani">
 <div id="TamSayfaCerceveSinirlamaAlani">
    <div id="TamSayfadaYuzlukAlan">
        <div id="HesaplarMenuAlani">
          <div id="HesaplarMenuDengelemeAlani">

            <div class="HesaplarMenuSinirlamaAlani">
                   <div class="HesaplarMenuTumMenulerAlani">
                    <div class="HesaplarMenuTumMenulerMetni"><a href="index.php?sk=61" >Siparişler</a></div>
                   </div>
            </div>
            <div class="HesaplarMenuSinirlamaAlani">
                    <div class="HesaplarMenuTumMenulerAlani">
                       <div class="HesaplarMenuTumMenulerMetni"><a href="index.php?sk=60">Yorumlar</a></div>
                    </div>
            </div>
            <div class="HesaplarMenuSinirlamaAlani">
                    <div class="HesaplarMenuTumMenulerAlani">
                      <div class="HesaplarMenuTumMenulerMetni">
                        <a href="index.php?sk=50" target="_top">Üyelik Bilgilerim</a></div>
                    </div>
            </div>
            <div class="HesaplarMenuSinirlamaAlani">
                    <div class="HesaplarMenuTumMenulerAlani">
                        <div class="HesaplarMenuTumMenulerMetni"><a href="index.php?sk=58">Adreslerim</a></div>
                    </div>
            </div>
            <div class="HesaplarMenuSinirlamaAlani">
                   <div class="HesaplarMenuTumMenulerAlani">
                      <div class="HesaplarMenuTumMenulerMetni"><a href="index.php?sk=59">Favorilerim</a></div>
                  </div>
            </div>
   
            </div>
        </div> <!-- hesaplar menu alanı kapaması-->
      </div> <!-- yüzlük alan kapaması -->
        
     <div id="CerceveIciAlaniElliSolAlan">
     		<div id="TamSayfadaAltiCiziliBaslikAlani">
                 <div id="BaslikMetni">HESABIM&Üyelik Bilgilerim</div>
                 <div id="AltBaslikMetni">Aşağıdan hesabınıza ait bilgileri görebilirsiniz.</div>
            </div>           
          <div class="HesabimUyelikBilgilerDetayAlani">

            <div class="HesabımUyelikBilgiBaslikMetni">E-mail Adresi</div>
            <div class="HesabımUyelikBilgiIcerikMetni"><?php echo $KullaniciEmail; ?><!-- bu değişkenler ayarlar.php de kulanıcı giriş yaptığı anda veritbanından çekilen bilgileri atadığım değişkenler -->
            </div>

            <div class="HesabımUyelikBilgiBaslikMetni">İsim Soyisim</div>
            <div class="HesabımUyelikBilgiIcerikMetni"><?php echo $KullaniciIsimSoyisim; ?></div>

            <div class="HesabımUyelikBilgiBaslikMetni">Telefon Numarası</div>
            <div class="HesabımUyelikBilgiIcerikMetni"><?php echo $KullaniciNumara; ?></div>

            <div class="HesabımUyelikBilgiBaslikMetni">Cinsiyet</div>
            <div class="HesabımUyelikBilgiIcerikMetni"><?php echo $KullaniciCinsiyet; ?></div>

            <div class="HesabımUyelikBilgiBaslikMetni">Kayıt Tarihi</div>
            <div class="HesabımUyelikBilgiIcerikMetni"><?php echo tarihBul($KullaniciKayitTarihi); ?></div>

            <div class="HesabımUyelikBilgiBaslikMetni">Kayıt IP Adresi</div>
            <div class="HesabımUyelikBilgiIcerikMetni"><?php echo $KullaniciKayitIpAdresi; ?></div>
            
            <a href="index.php?sk=51" class="FormTuruncuButonu">Bilgilerimi Güncellemek istiyorum.</a>
          </div> <!--<div class="HesabimUyelikBilgilerDetayAlani"> \ -->
    </div><!-- sol alan kapaması -->
    <div id="CerceveIciAlaniElliSagAlan">
     		<div id="TamSayfadaAltiCiziliBaslikAlani">
                 <div id="BaslikMetni">REKLAM</div>
                 <div id="AltBaslikMetni">NACOFF.com reklamları.</div>
            </div>
            <div class="ReklamKapsamaAlani">
            	<div class ="ReklamResimleri">
            		<img src="img/reklam.jpg" border="0">
            	</div>
            </div>
    </div>

</div>
</div>

<?php
}else{
    header("Location:index.php");//kullanıcı yoksa index e atıcak bu sayfaya girmek istediğimde. kötü niyetlilere sert tepki
    exit();
}

?>
