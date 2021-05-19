<?php
if (isset($_SESSION["Kullanici"])) {//kullanıcı girişi varsa bu sayfayı görüntüleyebilsin

  $sayfalamaSolSagButonSayisi=2; //3. sayfa acıkken 1 ve 2. sayfa bide 4 ve 5 . sayfa yanlarında gözüksün
  $sayfaBasinaKayitSayisi=5;//bir sayfada kac kayıt gösterilsin
  $sayfalamayaBaslanacakKayitSayisi=($sayfalama * $sayfaBasinaKayitSayisi)-$sayfaBasinaKayitSayisi;
  
  $toplamKayitSorgusu=$baglan->prepare("SELECT * FROM favoriler WHERE UyeId=? ORDER BY  id DESC");
  $toplamKayitSorgusu->execute([$KullaniciId]);
  $toplam_kayit_sayisi=$toplamKayitSorgusu->rowCount(); //kayıt varmı
  $favori_kayitlari=$toplamKayitSorgusu->fetch(PDO::FETCH_ASSOC);


  $bulunanSayfaSayisi=ceil($toplam_kayit_sayisi/$sayfaBasinaKayitSayisi); //urunler 6,5 sayfada gösterilirse toplam 7 sayfada gösterilmesi için

?>
<div id="TamSayfaCerceveAlani">
  <div id="TamSayfaCerceveSinirlamaAlani">
    <div id="TamSayfadaYuzlukAlan">
      
      <div id="HesaplarMenuAlani"> <!--BankaHesaplariAlani  -->
        <div id="HesaplarMenuDengelemeAlani">
          <div class="HesaplarMenuSinirlamaAlani">
            <div class="HesaplarMenuTumMenulerAlani">
              <div class="HesaplarMenuTumMenulerMetni"><a href="index.php?sk=50" target="_top">Üyelik Bilgilerim</a></div>
            </div>
          </div>

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
              <div class="HesaplarMenuTumMenulerMetni"><a href="index.php?sk=58">Adreslerim</a></div>
            </div>
          </div>

          <div class="HesaplarMenuSinirlamaAlani">
            <div class="HesaplarMenuTumMenulerAlani">
              <div class="HesaplarMenuTumMenulerMetni"><a href="index.php?sk=59">Favorilerim</a></div>
            </div>
          </div>
      </div>
    </div><!-- menü alanı snu -->

    <div class="HesabımSiparislerAlani">
      <div class="HesabımSiparislerBaslikAlani">HESABIM&Favoriler</div>
      <div class="HesabımSiparislerMetni">Favorilere eklediğiniz tüm ürünleri bualandan görüntüleyebilirsiniz!</div>
    </div>
    <?php
      $favorilerSorgusu=$baglan->prepare("SELECT * FROM favoriler WHERE UyeId=? ORDER BY  id DESC  LIMIT $sayfalamayaBaslanacakKayitSayisi,$sayfaBasinaKayitSayisi");
      $favorilerSorgusu->execute([$KullaniciId]);
      $favori_kayit_sayisi=$favorilerSorgusu->rowCount(); //kayıt varmı
      $favori_kayitlari=$favorilerSorgusu->fetchAll(PDO::FETCH_ASSOC);

      if ($favori_kayit_sayisi>0) {
        foreach ($favori_kayitlari as $satirlar) {
          $urunlerSorgusu=$baglan->prepare("SELECT * FROM urunler WHERE id=? LIMIT 1");
          $urunlerSorgusu->execute([$satirlar["UrunId"]]);
          $urun_kaydi=$urunlerSorgusu->fetch(PDO::FETCH_ASSOC);

          $urununAdi=$urun_kaydi["UrunAdi"];
          $urununTuru=$urun_kaydi["UrunTuru"];
          $urununFiyati=$urun_kaydi["UrunFiyati"];
          $urununParaBirim=$urun_kaydi["ParaBirimi"];
          $urununResmi=$urun_kaydi["UrunResmiBir"];
            
          if ($urununTuru == "fincan") {
                $resimKlasoru="fincan";
          }elseif($urununTuru == "kupa"){
                $resimKlasoru="kupa";
          }elseif($urununTuru == "kahveyanibardak"){
                $resimKlasoru="kahveyanibardak";
          }elseif($urununTuru == "sunumluk"){
                $resimKlasoru="sunumluk";
          }
    ?>
    <div class="HesabimFavoriDetayAlani"> 
      <div class="HesabimFavoriResimAlani">
        <a href="index.php?sk=83&ID=<?php echo DonusumleriGeriDondur($urun_kaydi["id"]); ?>"> 
          <img src="img/urunler/<?php echo $resimKlasoru; ?>/<?php echo DonusumleriGeriDondur($urununResmi); ?>" border="0"></a>
      </div>

      <div class="HesabimFavoriSilAlani">
        <a href="index.php?sk=81&ID=<?php echo DonusumleriGeriDondur($satirlar["id"]); ?>">
          <img src="img/siladres.png" border="0">
        </a>
      </div>

      <div class="HesabimFavoriUrunAdiAlani">
        <a href="index.php?sk=83&ID=<?php echo DonusumleriGeriDondur($urun_kaydi["id"]); ?>">
          <?php echo DonusumleriGeriDondur($urununAdi); ?>
        </a>
      </div>
      <div class="HesabimFavoriFiyatAlani">
        <?php echo fiyatBicimlendir(DonusumleriGeriDondur($urununFiyati)); ?>  <?php echo DonusumleriGeriDondur($urununParaBirim); ?></div>

    </div><!-- detay alanı sonu -->
    <?php
      } //for \
      if ($bulunanSayfaSayisi>1) { //sayfalama olaca
    ?>
    <div class="SayfalamaAlaniKapsayicisi">
      <div class="sayfalamaAlaniIciMetinAlaniKapsayicisi">
          Toplam <?php echo $bulunanSayfaSayisi; ?> sayfada, <?php echo $toplam_kayit_sayisi; ?> adet kayıt bulunmaktadır.
      </div>
      <div class="sayfalamaAlaniIciNumaraAlaniKapsayicisi">
      <?php 
        if ($sayfalama>1) {
          echo "<span class='Sayfalamapasif'><a href='index.php?sk=59&SYF=1'> << </a> </span>";
          $sayfalamaIcınSayfalamaDegeriniBirGeriAl=$sayfalama-1;
          echo "<span class='Sayfalamapasif'><a href='index.php?sk=59&SYF=" . $sayfalamaIcınSayfalamaDegeriniBirGeriAl . "'> < </a> </span>";
        }
        for ($i=$sayfalama-$sayfalamaSolSagButonSayisi; $i<=$sayfalama+$sayfalamaSolSagButonSayisi;$i++) { 
          if (($i>0) and ($i<=$bulunanSayfaSayisi)) {
            if ($sayfalama==$i) {
              echo "<span class='Sayfalamaaktif'>" .$i. "</span>";
            }else{
              echo "<span class='Sayfalamapasif'><a href='index.php?sk=59&SYF=" . $i . "'> ". $i. "</a></span>";
            }
          }
        }
        if ($sayfalama!=$bulunanSayfaSayisi) {
          $sayfalamaIcınSayfalamaDegeriniBirIleriAl=$sayfalama+1;
          echo "<span class='Sayfalamapasif'> <a href='index.php?sk=59&SYF=" . $sayfalamaIcınSayfalamaDegeriniBirIleriAl . "'> > </a> </span>";
          echo "<span class='Sayfalamapasif'><a href='index.php?sk=59&SYF=" . $bulunanSayfaSayisi . "'> >> </a></span>";
        }

     ?>
        </div>
      </div>
      <?php 
        }
        }else{
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