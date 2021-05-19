<?php
if (isset($_SESSION["Kullanici"])) {//kullanıcı girişi varsa bu sayfayı görüntüleyebilsin

 $sayfalamaSolSagButonSayisi=2; //3. sayfa acıkken 1 ve 2. sayfa bide 4 ve 5 . sayfa yanlarında gözüksün
 $sayfaBasinaKayitSayisi=2;//bir sayfada kac kayıt gösterilsin
 $sayfalamayaBaslanacakKayitSayisi=($sayfalama * $sayfaBasinaKayitSayisi)-$sayfaBasinaKayitSayisi;//$sayfalama index.php den den geliyo. orada sayfa kodlarını çekmiştik bu değişkenle.

 $toplamKayitSorgusu=$baglan->prepare("SELECT * FROM adresler WHERE UyeId=?");
 $toplamKayitSorgusu->execute([$KullaniciId]);
 $toplam_kayit_sayisi=$toplamKayitSorgusu->rowCount(); //kayıt varmı
 $siparis_kayitlari=$toplamKayitSorgusu->fetch(PDO::FETCH_ASSOC);
 $bulunanSayfaSayisi=ceil($toplam_kayit_sayisi/$sayfaBasinaKayitSayisi); //urunler 6,5 sayfada gösterilirse toplam 7 sayfada gösterilmesi için
?>
<div id="TamSayfaCerceveAlani">
  <div id="TamSayfaCerceveSinirlamaAlani">
    <div id="TamSayfadaYuzlukAlan">

      <div id="HesaplarMenuAlani"> 
        <div id="HesaplarMenuDengelemeAlani">
          <div class="HesaplarMenuSinirlamaAlani">
            <div class="HesaplarMenuTumMenulerAlani">
              <div class="HesaplarMenuTumMenulerMetni"><a href="index.php?sk=50" target="_top">Üyelik Bilgilerim</a></div></div>
          </div>
          <div class="HesaplarMenuSinirlamaAlani">
            <div class="HesaplarMenuTumMenulerAlani"><div class="HesaplarMenuTumMenulerMetni"><a href="index.php?sk=61" >Siparişler</a></div></div>
          </div>
          <div class="HesaplarMenuSinirlamaAlani">
            <div class="HesaplarMenuTumMenulerAlani"><div class="HesaplarMenuTumMenulerMetni"><a href="index.php?sk=60">Yorumlar</a>
            </div></div>
          </div>
          <div class="HesaplarMenuSinirlamaAlani">
            <div class="HesaplarMenuTumMenulerAlani">
              <div class="HesaplarMenuTumMenulerMetni">
               <a href="index.php?sk=58">Adreslerim</a>
              </div>
            </div>
          </div>
          <div class="HesaplarMenuSinirlamaAlani">
            <div class="HesaplarMenuTumMenulerAlani">
              <div class="HesaplarMenuTumMenulerMetni">
               <a href="index.php?sk=59">Favorilerim</a>
              </div>
            </div>
          </div>
        
                
      </div> <!-- dengeleme sonu-->
    </div><!-- menuler alanı sonu-->
    <div class="HesabımSiparislerAlani">
      <div class="AdresBilgisiSecimiBaslik"><span class="solalan">HESABIM&Adresler</span> <span class="sagalan"> <a href="index.php?sk=70" target="_top" style="text-decoration: none;">+ Adres Ekle</a></span>
      </div>
      
      <div class="HesabımSiparislerMetni">Tüm adreslerinizi bu alandan görüntüleyebilir ve güncelleyebilirsiniz.</div>
    </div>
    <?php
        $adreslerSorgusu=$baglan->prepare("SELECT * FROM adresler WHERE UyeId=?  ORDER BY id DESC LIMIT $sayfalamayaBaslanacakKayitSayisi,$sayfaBasinaKayitSayisi");//order bu dan sonrasını mutlaka burada yazmak lazm en ustteki sorgusa yazınca sayfalama çalışmıyor.
        $adreslerSorgusu->execute([$KullaniciId]);
        $adres_kayit_sayisi=$adreslerSorgusu->rowCount(); //kayıt varmı
        $adres_kayitlari=$adreslerSorgusu->fetchAll(PDO::FETCH_ASSOC);
        if ($adres_kayit_sayisi>0) {
          foreach ($adres_kayitlari as $satirlar) {
    ?>

    <div class="HesabimAdreslerDetayAlani">
      <div class="HesabimAdresDetaylari">
          &#10148;
          <?php echo  $satirlar["AdSoyad"];?>    | <?php echo $satirlar["TelefonNumarasi"]; ?>
          <br>
          <?php echo $satirlar["Adres"]; ?>  <?php echo $satirlar["Ilce"]; ?> / <?php echo $satirlar["Sehir"]; ?> 
      </div>
      <div class="HesabimAdresGuncelleSilİslemleri">
        <div class="HesabimAdresSilGuncelleMetni">
          <a href="index.php?sk=62&ID=<?php echo $satirlar["id"]; ?>"> Güncelle</a>
        </div>
        <div class="HesabimAdresSilGuncelleResimleri">
          <a href="index.php?sk=62&ID=<?php echo $satirlar["id"]; ?>"><img src="img/adresguncelle.png" border="0"></a>
        </div>
        <div class="HesabimAdresSilGuncelleMetni"><a href="index.php?sk=67&ID=<?php echo $satirlar["id"]; ?>">Sil</a></div>
          <div class="HesabimAdresSilGuncelleResimleri">
            <a href="index.php?sk=67&ID=<?php echo $satirlar["id"]; ?>"><img src="img/siladres.png" border="0"></a>
          </div>

      </div>
    </div> <!-- detay alanı kapaması -->
    <?php
      } //for each kapması
      /*başka bir kısımda sayfalama yaparken bu kodların aynısını kullanabiliriz sadece sk olan kısmı değiştiririz. mesela yorumlar 61 ise ve yorumlar sayfasında kullanıyorsam sayfalamayı sk=61 yaparım. yoksa sayfalama yanlış çalışır.*/
      if ($bulunanSayfaSayisi>1) { //sayfalama olacaksa
    ?>
    <div class="SayfalamaAlaniKapsayicisi">
      <div class="sayfalamaAlaniIciMetinAlaniKapsayicisi">
          Toplam <?php echo $bulunanSayfaSayisi; ?> sayfada, <?php echo $toplam_kayit_sayisi; ?> adet kayıt bulunmaktadır.
      </div>
      <div class="sayfalamaAlaniIciNumaraAlaniKapsayicisi">
      <?php 
        if ($sayfalama>1) {
          echo "<span class='Sayfalamapasif'><a href='index.php?sk=58&SYF=1'> << </a> </span>";
          $sayfalamaIcınSayfalamaDegeriniBirGeriAl=$sayfalama-1;
          echo "<span class='Sayfalamapasif'><a href='index.php?sk=58&SYF=" . $sayfalamaIcınSayfalamaDegeriniBirGeriAl . "'> < </a> </span>";
        }
        for ($i=$sayfalama-$sayfalamaSolSagButonSayisi; $i<=$sayfalama+$sayfalamaSolSagButonSayisi;$i++) { 
            if (($i>0) and ($i<=$bulunanSayfaSayisi)) {
              if ($sayfalama==$i) {
                echo "<span class='Sayfalamaaktif'>" .$i. "</span>";
              }else{
                echo "<span class='Sayfalamapasif'><a href='index.php?sk=58&SYF=" . $i . "'> ". $i. "</a></span>";
              }
            }
        }
        if ($sayfalama!=$bulunanSayfaSayisi) {
          $sayfalamaIcınSayfalamaDegeriniBirIleriAl=$sayfalama+1;
          echo "<span class='Sayfalamapasif'> <a href='index.php?sk=58&SYF=" . $sayfalamaIcınSayfalamaDegeriniBirIleriAl . "'> > </a> </span>";
          echo "<span class='Sayfalamapasif'><a href='index.php?sk=58&SYF=" . $bulunanSayfaSayisi . "'> >> </a></span>";
        }
      ?>
      </div> <!-- <div class="sayfalamaAlaniIciNumaraAlaniKapsayicisi"> \ -->
    </div><!-- <div class="SayfalamaAlaniKapsayicisi">-->
    <?php 
      }  //if ($bulunanSayfaSayisi>1) { kapaması
      }else{ //if ($adres_kayit_sayisi>0) { kapaması
    ?>
    <div class="BilgiAciklamaAlani">Kayıtlı adresiniz bulunmamaktadır. </div>
    <?php
      }
    ?>

    </div> <!-- yüzlük alan kapaması -->
  </div>
</div>

<?php
}else{
  header("Location:index.php");//kullanıcı yoksa index e atıcak bu sayfaya girmek istediğimde
  exit();
}
?>